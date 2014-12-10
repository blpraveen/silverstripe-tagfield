<?php 

class Tag extends DataObject {
	static $db = array(
		'Title' => 'Varchar(200)',
		'Slug' =>  'Varchar(200)',
		'PageType' => 'Varchar(200)',
	);

	static $belongs_many_many = array(
		'SiteTree' => 'SiteTree'
	);

	static $summary_fields = array(
		'Title' => 'Title',
		'Slug' => 'Slug',
		'PageType' => 'Page Type',
	);

	public function Link($tagname) {
		$PageTag = PageTag::get()->first();
		return Controller::join_links(
			$PageTag->URLSegment,
			$tagname
		);
	}   	

	public function onBeforeWrite() {
		parent::onBeforeWrite();
		$filter = URLSegmentFilter::create();
		$t = $filter->filter($this->Title);
		$existingTag = DataObject::get_one('Tag', "Slug = '$t' and ID != {$this->ID}");
		if(!$existingTag) {			
			$this->Slug = $t;				
		} else {
			throw new ValidationException("Tag Already exists $this->Title ", E_USER_WARNING);
			return false;
		}

	}	
	public function getCMSFields()
	{

		$candidates =Config::inst()->get('TagSiteTreeExtension', 'allowed_tag_pages');
		foreach($candidates as $candidate) {
			// If a classname is prefixed by "*", such as "*Page", then only that
			// class is allowed - no subclasses. Otherwise, the class and all its subclasses are allowed.
			if(substr($candidate,0,1) == '*') {
				$allowedChildren[] = substr($candidate,1);
			} else {
				$subclasses = ClassInfo::subclassesFor($candidate);
				foreach($subclasses as $subclass) {
					if($subclass != "SiteTree_root") $allowedChildren[] = $subclass;
				}
			}
		}
		$classes = $allowedChildren;
		$currentClass = null;
		$result = array();
		
		$result = array();
		foreach($classes as $class) {
			$instance = singleton($class);
			if((($instance instanceof HiddenClass) || !$instance->canShowTags())) continue;

			$pageTypeName = $instance->i18n_singular_name();

			$currentClass = $class;
			$result[$class] = $pageTypeName;

			if(i18n::get_lang_from_locale(i18n::get_locale()) != 'en') {
				$result[$class] = $result[$class] .  " ({$class})";
			}
		}
		
		// sort alphabetically, and put current on top
		asort($result);
		if($currentClass) {
			$currentPageTypeName = $result[$currentClass];
			unset($result[$currentClass]);
			$result = array_reverse($result);
			$result[$currentClass] = $currentPageTypeName;
			$result = array_reverse($result);
		}
		
		$fields = new FieldList();
		
		$fields->push(new TextField('Title'));
		$fields->push($DropDown = new DropdownField('PageType', 'Page Type', $result));
		$DropDown->setDescription("By adding pagetype all the news pages created will have default tag set.");	
		$DropDown->setEmptyString("Select Page Type");
		
		return $fields;
	}
}

?>
