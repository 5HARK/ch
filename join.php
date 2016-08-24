<?php
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
			<li class="selected"><a href="login.php">Login</a></li>
			<li><a href="board.php">Board</a></li>
		    </ul>
		</div>
	    </div>
	    <div id="site_content">
		<div id="content">
		    <!-- insert the page content here -->
		    <h1>Join</h1>
		    <?php
		    $joined = FALSE;
		    if(isset($_POST['sign_up'])) {
			do {
			    $id    = $_POST['id'];
			    $pw    = $_POST['pw'];
			    $re_pw = $_POST['re_pw'];
			    
			    if(empty($id) || empty($pw) || empty($re_pw)) echo 'Please fill every forms. ';
			    else if(strcmp($pw, $re_pw)) {
				echo 'Password and Re-entered password are different.';
				break;
			    }

			    $query = "SELECT * FROM user WHERE id = '" . $id ."'";
			    
			    $result = $db->query($query);
			    
			    if($result->num_rows) echo 'Your id is already exist.';
			    else {
				$query = "INSERT INTO user VALUES('', '" . $id . "', '" . sha1($pw) . "')";
				$db->query($query);
				
				$joined = TRUE;
				
				echo 'You have joined. id : ' . $id;
			    }
			} while(0);
		    }
		    if(!$joined) {
		    ?>
			<form action="join.php" method="post">
			    <div class="form_settings">
				<p><span>Identifier</span><input class="contact" type="text" name="id" value="" /></p>
				<p><span>Password</span><input class="contact" type="password" name="pw" value="" /></p>
				<p><span>Re-Password</span><input class="contact" type="password" name="re_pw" value="" /></p>
				<p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="sign_up" value="join" /></p>
			    </div>
			</form
		    <?php } ?>
		</div>
	    </div>
	    <div id="footer">
	    </div>
	</div>
    </body>
</html>
