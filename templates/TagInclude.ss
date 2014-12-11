	<% if $ShowTags %>
	    <p class="tags">
		 <% _t('TagPage_ss.TAGS', 'Tags : ') %>
	    <% loop Tags %>
		<a href="$Link($Slug)">$Title</a>
		<% if First %>
			<% if not Last %>
			  	,&nbsp;
			<% end_if %>
		<% end_if %>
		<% if Middle %>
			<% if not Last %>
			  	,&nbsp;
			<% end_if %>
		<% end_if %>				
	    <% end_loop %>
	    </p>
	<% end_if %> 
