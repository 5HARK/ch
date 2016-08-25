<?
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
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div id="content">
	  <?php
	  if(isset($_SESSION['id'])) {
	  if($_SESSION['id'] === "admin") { ?>
		<div class="form_settings">
			<h2>Board Management</h2>
			<table style="width:100%; border-spacing:0;">
			  <tr><th>ch</th><th style="width:60%">Title</th><th>Writer</th></tr>
				<?php
				if(isset($_POST['pst_del'])) {
					if(!empty($_POST['pst'])) {
						// $count = count($_POST['']);				
						foreach($_POST['pst'] as $selected) {
							$query  = "DELETE FROM board WHERE no='" . $selected . "'";
							$db->query($query);
						}
					}
				}
				?>
			  <!--<tr><td>Item 1</td><td>Description of Item 1</td></tr>-->
			</table>
			<p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="pst_del" value="delete" /></p>
		</div>
		<form action="admin.php" method="post">
			<div class="form_settings">
				<h2>Member Management</h2>
				<?php
					if(isset($_POST['mmb_del'])) {
						if(!empty($_POST['member'])) {
							// $count = count($_POST['member']);	
							foreach($_POST['member'] as $selected) {
								$query  = "SELECT id FROM user WHERE no='" . $selected . "'";
								$result = $db->query($query);
								$row    = $result->fetch_assoc();
								
								echo 'You have deleted ' . $row['id'] . '.</br>';
								
								$query  = "DELETE FROM user WHERE no='" . $selected . "'";
								$db->query($query);
							}
						}
					}
				?>
				<table style="width:100%; border-spacing:0;">
				  <tr><th>ch</th><th style="width:60%">ID</th></tr>
				  <?php
					$query  = "SELECT * FROM user";
					$result = $db->query($query);
					while($row = $result->fetch_assoc()){ ?>
						<tr>
						<td><?php echo '<input style="width: 5%" type="checkbox" name="member[]" value="' . $row['no'] . '">' ?></td>
						<td><?php echo $row['id'] ?></td>
						</tr>
					<?php } ?>
				</table>
				<p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="mmb_del" value="delete" /></p>
			</div>
		</form>
      </div>
	  <?php
	  }
	  else echo '<br/><p>You are not admin.</p>';
	  }
	  else echo '<br/><p>Please log in first.</p>';
	  ?>
    </div>
    <div id="footer">
    </div>
  </div>
</body>
</html>
