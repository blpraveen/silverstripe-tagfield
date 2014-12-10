<!DOCTYPE html>
<html>
	<head>
		
		<title>$Title</title>
		
		<% base_tag %>
		
		$MetaTags(false)
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<link rel="shortcut icon" href="/favicon.ico" /> 			
	


	</head>
	
	<body class="<% if ClassName = HomePage %>home<% end_if %>">
			
	<p class="message results">Tags matching <strong>$Tagname</strong>, which returned <strong>$Results.Count</strong> results.</p>
	
	<% if Results %>
	    <ul id="SearchResults">
	      <% loop Results %>					
			<li class="clearfix">
				<h2><a class="searchResultHeader" href="$Link">$Title</a></h2>

				<p class="pageinfo">
					Last edited $LastEdited.ago
					<% if getDepartmentPage %>
						in <a href="$getPage.Link">$getPage.Title</a>
					<% end_if %>
				</p> 

			
				<p>$Content.ContextSummary</p>
				
				<p><a class="more" href="$Link">Continue reading...</a></p>
			</li>
	      <% end_loop %>
	    </ul>
	  <% else %>
	    <p>Sorry, your search query did not return any results.</p>
	  <% end_if %>
	
	<div class="clear">&nbsp;</div>

	<% if Results.MoreThanOnePage %>
		<!-- Pagination -->
		<div class="pagination">
			<ul>
				<% loop Results.PaginationSummary(4) %>
				<li <% if CurrentBool %>class="selected"<% end_if %>>
					<a href="$Link">$PageNum</a>
				</li>
				<% end_loop %>
			</ul>
		</div>
		<!--End  Pagination -->
	<% end_if %>
	


	</body>
					
</html>
