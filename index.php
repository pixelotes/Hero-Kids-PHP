<?php
	include './auth.php';
	include './main_pre.php';
?>
<!-- Page content starts here -->
	<p class="title1">Aventuras disponibles</p>
	<?php
	include './functions.php';
	$db = getDatabase();
	$result = $db->query("select * from modules;"); 
	$db = null;			
	foreach($result as $row)
	{
		if (($row !== false)) {
			echo "<div class='module'>";
			echo "<img src=\"".$row['thumbnail']."\"></img><br/>";
			echo "<span class='module-title'>".$row['name']."</span><br />";
			echo "<span class='module-description'>".substr($row['description'],0,145).'...'."</span>";
			echo "<span class='module-difficulty'>Dificultad: ";
			for ($i=0;$i<$row['difficulty'];$i++){
				echo "&#9733;";
			}
			echo "</span><br />";
			echo "<a href='game.php?id=".$row['id']."'>Jugar</a><br />";
			echo "</div>";
		}
	}
	?>
	<!-- Page content ends here -->
<?php
	include './main_post.php';
?>