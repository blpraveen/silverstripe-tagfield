<?php
 
class TagSiteConfigExtension extends DataExtension {
      	private static $db =  array(
				'SendSupportFormsTo' => 'Varchar(100)',
				'SendOutOfDateTo' => 'Varchar(100)',
				'SendOutOfDateFrom' => 'Varchar(100)',
				'IntranetAdminEmail' => 'Varchar(100)',
				'IntranetEmail' => 'Varchar(100)',
				'LatestTweet' => 'HTMLText',
				'CompAcademyLogoPosition' => 'Enum("left,right")',
				'LastTweetCache' => 'SS_DateTime'
			);
	private static $has_one = array(
				'DefaultTag' => 'Tag',		
			);	


	public function updateCMSFields(FieldList $fields) {
		//Tag
		if($Tags = Tag::get())
		{
			$fields->addFieldToTab('Root.Tags', new DropdownField('DefaultTagID', 'Default Tags', $Tags->map()));			
		}
		$tagridField = GridFieldConfig::create()->addComponents(
			new GridFieldToolbarHeader(),
			new GridFieldAddNewButton('toolbar-header-right'),
			new GridFieldSortableHeader(),
			new GridFieldDataColumns(),
			new GridFieldPaginator(10),
			new GridFieldEditButton(),
			new GridFieldDeleteAction(),
			new GridFieldDetailForm()
		);
		$tagridField = new GridField("Tags", "Tag list:", Tag::get(), $tagridField);	    		
		/*$manager = new DataObjectManager( 
			$this->owner, 
			'Locations', 
			'Location'          
		);*/ 

		$fields->addFieldToTab("Root.Tags", $tagridField); 
	
   	}
	
}
