<?php 
session_start();
include_once("header.php");
include_once("connect_db.php");
?>

	    <div id="site_content">
		<div id="content">
		    <!-- insert the page content here -->
		    <?php
		    if(isset($_POST['id']) && isset($_POST['pw']))		   {			
			// need to filter
			$id    = $_POST['id'];
			$pw    = $_POST['pw'];
			$query = "SELECT * FROM user WHERE id ='" . $id . "' and pw = '" . sha1($pw) . "'";

			$result = $db->query($query);
			if($result->num_rows == 1) {	
			    $_SESSION['id'] = $id;
			    $_SESSION['pw'] = $pw;
			}else{
			    echo 'Wrong or don\'t exist credentials';
			}
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
<?php
include_once("footer.php");
?>
