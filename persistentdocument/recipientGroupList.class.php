<?php
class form_persistentdocument_recipientGroupList extends form_persistentdocument_recipientGroupListbase
{
	public function getItems()
	{
		$form = $this->getForm();
		$formService = form_ListRecipientgrouplistService::getInstance();
		$formService->setParentForm($form);
		return $formService->getItems();
	}
}
