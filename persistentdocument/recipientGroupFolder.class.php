<?php
/**
 * Class where to put your custom methods for document form_persistentdocument_recipientGroupFolder
 * @package modules.form.persistentdocument
 */
class form_persistentdocument_recipientGroupFolder extends form_persistentdocument_recipientGroupFolderbase 
{
	/**
	 * Return the localized value for a rootfolder
	 * @return string
	 */
	public function getLabel()
	{
		return f_Locale::translateUI('&modules.form.document.recipientgroupfolder.Document-name;');
	}
	
	/**
	 * @param string $moduleName
	 * @param string $treeType
	 * @param array<string, string> $nodeAttributes
	 */
//	protected function addTreeAttributes($moduleName, $treeType, &$nodeAttributes)
//	{
//	}
	
	/**
	 * @param string $actionType
	 * @param array $formProperties
	 */
//	public function addFormProperties($propertiesNames, &$formProperties)
//	{	
//	}
}