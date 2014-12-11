<?php 

Class TagPage extends Page {
	
	
}
class TagPage_Controller extends Page_Controller
{
	static $allowed_actions = array(
		'index',
		'specificTags',
	);
	public static $url_handlers = array(
		'$Slug!' => 'specificTags',
		'' => 'index'
	);
	
	function index() {	

		$result = Tag::get()->sort('Title','ASC');
		$tag_items = array();
		$tag_others = new ArrayList();
		//get all the tags and aggregate tags w.r.t to alpha keys 
		if($result) {
			foreach($result as $tagobj) {
				if (preg_match('/^[a-zA-Z]/', $tagobj->Title)) {
					$key = strtoupper(substr($tagobj->Title, 0, 1));
					if(!isset($tag_items[$key])) {
						$tag_items[$key] = new ArrayList();	
					}
					$tag_items[$key]->push($tagobj);

				} else {
					$tag_others->push($tagobj);
				}

			} 
		}
		//merge alpha if the items is less than 10
		if($tag_items) {
			$prevtag = '';
			foreach($tag_items as $key => $tag) {
				if(!empty($prevtag)) {
					$tag_items[$prevtag . '-' . $key] = $tag_items[$prevtag];
					foreach($tag as $tagitem) {
						$tag_items[$prevtag . '-' . $key]->push($tagitem);
					}

					unset($tag_items[$key]);
					unset($tag_items[$prevtag]);
					$prevtag = '';
				} else if($tag->count() < 10) {
					$prevtag = $key; 
				} else {
					$prevtag = '';
				}

			}
			//Sort again by alpah keys
			ksort($tag_items);
		}
		//prepare the arraylist to send the data to template
		$tag_list = new ArrayList();
		if($tag_items) {
			foreach($tag_items as $key => $tag) {
				$tag_list->push(new ArrayData(array(
						'Title' => $key,
				                'Items' => $tag,
		            			)));
			
			}
		}
		//Merge to the data 'others'
		if($tag_others->count()) {
			$tag_list->push(new ArrayData(array(
					'Title' => 'Others',
		                        'Items' => $tag_others,
                    			)));
		}

		$data = array(
			'Results' => $tag_list
		);			
		return $this->customise($data)->renderWith(array('TagPageIndex', 'Page_results','Page'));
        }
	//UrlHandelres not redirecting Hence using common methods to all
	//Controller

	function specificTags() {
		$Slug = $this->request->param('Slug');
		$Tag = Tag::get()->filter('slug',$Slug)->first(); 
		if($Tag) {
			$TagIDs = array($Tag->ID);
			$in = "('" . implode("','", $TagIDs) . "')";
			$result = SiteTree::get()->where("\"SiteTree_Tags\".\"TagID\" IN $in")->leftJoin('SiteTree_Tags', "SiteTree.ID = SiteTree_Tags.SiteTreeID");
		
			$data = array(
				'Results' => $result,
				'Tagname' => $Tag->Title
			);	
		} else {
			$data = array(
				'Results' => array(),
				'Tagname' => $Slug
			);
		}	
		return $this->customise($data)->renderWith(array('TagPage', 'Page_results','Page'));
  }

}
