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
		  <li class="selected"><a href="login.php">Login</a></li>
          <li><a href="board.php">Board</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div id="content">
        <!-- insert the page content here -->
		<?php
		if(isset($_POST['id']) && isset($_POST['pw']))		   {			
			// need to filter
			$id    = $_POST['id'];
			$pw    = $_POST['pw'];
			$query = "SELECT * FROM user WHERE id ='" . $id . "' and pw = '" . sha1($pw) . "'";

			$row   = mysqli_query($conn, $query);
			if(mysqli_num_rows($row) == 1) {	
				$_SESSION['id'] = $id;
				$_SESSION['pw'] = $pw;
			}
			
			mysqli_close($conn);
		}
		if(!isset($_SESSION['id']) || !isset($_SESSION['pw'])) {
		?>
        <h1>Log In</h1>
        <form action="login.php" method="post">
          <div class="form_settings">
            <p><span>Identifier</span><input class="contact" type="text" name="id" value="" /></p>
            <p><span>Password</span><input class="contact" type="password" name="pw" value="" /></p>
            <p style="padding-top: 15px"><span>&nbsp;</span>
			<input class="button" type="button" value="join" onclick="location.href='join.php'" />
			<input style="margin-left: 10px" class="submit" type="submit" name="sign_in" value="login" />
			</p>
          </div>
        </form>
		<?php }
		else {
			echo '<h2>hello, ' . $_SESSION['id'] . '!</h2>';
		?>
		<form action="login.php" method="get">
		  <div class="form_settings">
			<p style="padding-top: 10px"><span>&nbsp;</span><input class="submit" type="submit" name="log_out" value="log out" /></p>
		  </div>
		</form>
		<?php
			if(isset($_GET['log_out'])) {
				session_destroy();
				echo '<script>location.reload()</script>';
			}
		}
		?>
      </div>
    </div>
    <div id="footer">
    </div>
  </div>
</body>
</html>
