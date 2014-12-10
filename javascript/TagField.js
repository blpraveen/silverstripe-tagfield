(function($) {
	SSSTagFieldLoader = function() {
		$(this).tokenize({
		    datas:$(this).attr('href')
		});
	}
	
	$(document).ready(function(){
		if (typeof $(document).livequery != 'undefined') 
			$('.stag.tagField').livequery(SSSTagFieldLoader);
		else	$('.stag.tagField').each(SSSTagFieldLoader);
	});
})(jQuery);
