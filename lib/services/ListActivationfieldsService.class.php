<?php
class form_ListActivationfieldsService extends BaseService
{
	/**
	 * @var form_ListActivationfieldsService
	 */
	private static $instance;
	
	/**
	 * @return form_ListActivationfieldsService
	 */
	public static function getInstance()
	{
		if (is_null(self::$instance))
		{
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	/**
	 * @return array<list_Item>
	 */
	public final function getItems()
	{
		$request = change_Controller::getInstance()->getContext()->getRequest();
		$form = null;
		$conditionOn = null;
		try
		{
			$conditionOnId = intval($request->getParameter('documentId', 0));
			if ($conditionOnId > 0)
			{
				$conditionOn = DocumentHelper::getDocumentInstance($conditionOnId);
				$form = $conditionOn->getForm();
			}
			else 
			{
				$parent = DocumentHelper::getDocumentInstance(intval($request->getParameter('parentId', 0)));
				if ($parent instanceof form_persistentdocument_baseform)
				{
					$form = $parent;
				}
				else if ($parent instanceof form_persistentdocument_group)
				{
					$form = $parent->getForm();
				}
			}
		}
		catch (Exception $e)
		{
			Framework::exception($e);
		}
		if (!($form instanceof form_persistentdocument_baseform))
		{
			return array();	
		}
		
		$results = array();
		$excludeIds = $this->getExcludeIds($conditionOn);
		foreach ($form->getDocumentService()->getValidActivationFields($form, $excludeIds) as $field)
		{
			$results[] = new list_Item($field->getLabel(), $field->getId());
		}		
		return $results;
	}
	
	/**
	 * @return String
	 */
	public final function getDefaultId()
	{
		return null;
	}
	
	/**
	 * @param f_peristentdocument_PersistentDocument $conditionOn
	 * @return integer[]
	 */
	private function getExcludeIds($conditionOn)
	{
		$excludeIds = array();
		if ($conditionOn instanceof form_persistentdocument_field)
		{
			$excludeIds = array($conditionOn->getId());
		}
		else if ($conditionOn instanceof form_persistentdocument_group)
		{
			$query = form_FieldService::getInstance()->createQuery();
			$query->add(Restrictions::descendentOf($conditionOn->getId()));
			$query->setProjection(Projections::property('id'));
			$excludeIds = $query->findColumn('id');
		}
		return $excludeIds;
	}
}