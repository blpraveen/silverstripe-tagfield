<?php
/**
 * Extension of SiteTree to include TagFields.
 */
class TagSiteTreeExtension extends SiteTreeExtension {

	static $db = array(
		'ShowTags'  => 'Boolean',
	);



	static $defaults = array(
		'ShowTags'   => false
	);

	static $many_many = array(
		'Tags' => 'Tag'
	);

  private static $allowed_tag_pages = array(
		'Page' => 'Page',
	);

	function canShowTags() {
		return true;
	}

	public function updateCMSFields(FieldList $fields)
	{

			$fields->addFieldToTab("Root.Main",$tagField =  new STagField('Tags', 'Add Page Tags', null, 'SiteTree') );
			$tagField->setSeparator(',');

	}

	public function updateSettingsFields(FieldList $fields) {
	    $fields->addFieldToTab("Root.Settings", $ShowTag = new FieldGroup( new CheckboxField("ShowTags", "Show a Tag on this page", array("0"=>"yes", "1"=>"no"))));
	    $ShowTag->setTitle($this->owner->fieldLabel('Show Tags'));
	}
	public function onAfterWrite() {
		 parent::onAfterWrite(); 
		if($this->owner->Version = 1) { 

			$Tags = DataObject::get('Tag', "PageType = '{$this->owner->ClassName}'");
			if($Tags) {
				foreach($Tags as $Tag) {
					$this->owner->Tags()->add($Tag); 
				}
			}
		} 
	}
}
