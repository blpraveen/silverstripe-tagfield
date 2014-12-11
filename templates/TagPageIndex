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
			
	<h1>Tag List</h1>	
	
	<% if Results %>
	    <div class="tag_list">
	     <% loop Results %>		
		    <div class="tag_index">
			<div class="tag_title">$Title</div>
			<div class="tag_item_container">
			<% loop Items %>		
			        <div class="tag_index_item"><a href="$Link($Slug)">$Title</a></div>
			<% end_loop %>			
			</div>
		    </div>	
	      <% end_loop %>
	    </div>
	  <% else %>
	    <p>Sorry,there are not tags created.</p>
	  <% end_if %>
	


	</body>
					
</html>
