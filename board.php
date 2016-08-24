<?php
session_start();
include_once "connect_db.php";
?>
<!DOCTYPE HTML>
<html>

    <head>
	<title></title>
	<meta name="description" content="website description" />
	<meta name="keywords" content="website keywords, website keywords" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="style/style.css" title="style" />
    </head>

    <body>
	<div id="main">
	    <div id="header">
		<div id="logo">
		    <div id="logo_text">
			<!-- class="logo_colour", allows you to change the colour of the text -->
			<h1><a href="index.html">club's<span class="logo_colour"> board</span></a></h1>
		    </div>
		</div>
		<div id="menubar">
		    <ul id="menu">
			<!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
			<li><a href="index.html">Home</a></li>
			<li><a href="login.php">Login</a></li>
			<li class="selected"><a href="board.php">Board</a></li>
		    </ul>
		</div>
	    </div>
	    <div id="site_content">
		<div id="content">
		    <h2>Board</h2>
		    <table style="width:100%; border-spacing:0;">
			<tr><th>No</th><th style="width:60%">Title</th><th>Writer</th></tr>
			<?php
    			$sql = "select * from board order by no desc";
    			$result = $db->quert($sql);
			while($row = $result->fetch_assoc()){?>
			    <tr>
				<td><?php echo $row['no'] ?></td>
				<td><?php echo $row['title'] ?></td>
				<td><?php echo $row['id'] ?></td>
			    </tr>
			<?php } ?>
		    </table>
		    <?php
		    if(isset($_SESSION['id'])) {
		    ?>
			<div class="form_settings">
			    <input style="margin-left: 0px" class="button" type="button" value="write post" onclick="location.href='write_post.php'" />
			</div>
		    <?php } ?>
		</div>  
	    </div>
	    <div id="footer">
	    </div>
	</div>
    </body>
</html>
