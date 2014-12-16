<?php
$adjacents = 2;
$get_total_pages = mysql_query("SELECT COUNT(*) as num FROM posts");
$total_pages = mysql_fetch_array($get_total_pages);
$total_pages = $total_pages[num];
$targetpage = "postssettings.php";
$limit = 8;
$page = $_GET['page'];
if($page){
$start = ($page - 1) * $limit;
}
else{
$start = 0;
}
$userposts = mysql_query("SELECT posts.id,posts.userid,posts.content,posts.attach,posts.title,posts.date,users.fullname,users.avatar FROM posts,users WHERE posts.userid=users.id ORDER BY posts.date DESC LIMIT $start, $limit");
if($page == 0){
$page = 1;
}
$prev = $page - 1;
$next = $page + 1;
$lastpage = ceil($total_pages/$limit);
$lpm1 = $lastpage - 1;
$pagination = "";
if($lastpage > 1){
$pagination .= "<div class='pagination'>";
//previous button
if ($page > 1){
$pagination.= "<a href='$targetpage?page=$prev'> previous</a>";
}
else{
$pagination.= "<span class='disabled'> previous</span>";	
}
//pages	buttons
if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
{	
	for ($counter = 1; $counter <= $lastpage; $counter++)
	{
		if ($counter == $page){
		$pagination.= "<span class='current'>$counter</span>";
		}
		else{
		$pagination.= "<a href='$targetpage?page=$counter'>$counter</a>";
		}
	}
}
elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
{
	//close to beginning; only hide later pages
	if($page < 1 + ($adjacents * 2))		
	{
		for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
		{
			if ($counter == $page){
			$pagination.= "<span class='current'>$counter</span>";
			}
			else{
			$pagination.= "<a href='$targetpage?page=$counter'>$counter</a>";	
			}
		}
	$pagination.= "...";
	$pagination.= "<a href='$targetpage?page=$lpm1'>$lpm1</a>";
	$pagination.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";		
	}
	//in middle; hide some front and some back
	elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
	{
	$pagination.= "<a href='$targetpage?page=1'>1</a>";
	$pagination.= "<a href='$targetpage?page=2'>2</a>";
	$pagination.= "...";
		for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
		{
			if ($counter == $page){
			$pagination.= "<span class='current'>$counter</span>";
			}
			else{
			$pagination.= "<a href='$targetpage?page=$counter'>$counter</a>";
			}
		}
	$pagination.= "...";
	$pagination.= "<a href='$targetpage?page=$lpm1'>$lpm1</a>";
	$pagination.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";		
	}
			//close to end; only hide early pages
	else{
	$pagination.= "<a href='$targetpage?page=1'>1</a>";
	$pagination.= "<a href='$targetpage?page=2'>2</a>";
	$pagination.= "...";
		for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
		{
			if ($counter == $page){
			$pagination.= "<span class='current'>$counter</span>";
			}
			else{
			$pagination.= "<a href='$targetpage?page=$counter'>$counter</a>";	
			}
		}
	}
}
		
//next button
if ($page < $counter - 1){
$pagination.= "<a href=\"$targetpage?page=$next\">Next</a>";
}
else{
$pagination.= "<span class='disabled'>Next</span>";
$pagination.= "</div>";		
}
}