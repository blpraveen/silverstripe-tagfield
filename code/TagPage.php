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

		$data = array(
			'Results' => array()
		);			
		return $this->customise($data)->renderWith(array('PageTag', 'Page_results','Page'));
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
