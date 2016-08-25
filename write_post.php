<?php
define("IMAGE_DIR", "./image/");
define("FILE_DIR",  "./file/");
session_start();
include_once("header.php");
?>

    <div id="site_content">
	<?php
	$post       = FALSE;
	$allow_type = array("audio/mpeg", "text/plain", "application/pdf", "application/vnd.microsoft.portable-executable");
	do {
		if(isset($_POST['post'])) {
			$title     = $_POST['title'];
			$content   = $_POST['content'];
			$image_err = $_FILES['uploaded_image']['error'];
			$file_err  = $_FILES['uploaded_file']['error'];
			
			if(empty($title) || empty($content)) {
				echo '</br><p>Title and content must be filled.</p>';
				break;
			}
			
			if($image_err === UPLOAD_ERR_OK) {
				if(exif_imagetype($_FILES['uploaded_image']['tmp_name'])) {
					$uploaded_image = IMAGE_DIR . basename($_FILES['uploaded_image']['name']);
					if(file_exists($uploaded_file)) break;
					move_uploaded_file($_FILES['uploaded_image']['tmp_name'], $uploaded_image);
				}
				else break;
			}
			
			if($file_err === UPLOAD_ERR_OK) {
				$type = $_FILES['uploaded_file']['type'];
				if(in_array($type, $allow_type)) {
					$uploaded_file = FILE_DIR . basename($_FILES['uploaded_file']['name']);
					if(file_exists($uploaded_file)) break;
					move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $uploaded_file);
				}
				else break;
			}
			
			$post = TRUE;
		}
	} while(0);
	
	if($post == FALSE) {
	?>
      <div id="content">
	  <?php if(isset($_SESSION['id'])) { ?>
        <h2>Write Post</h2>
        <form action="write_post.php" enctype="multipart/form-data" method="post">
          <div class="form_settings">
            <p><span>Form field example</span><input type="text" name="title" value="" /></p>
            <p><span>Textarea example</span><textarea rows="8" cols="50" name="content"></textarea></p>
			<p><span>Image upload</span><input type="file" name="uploaded_image" size="20"></p>
			<p><span>File upload</span><input type="file" name="uploaded_file" size="20"></p>
			<!--
            <p><span>Checkbox example</span><input class="checkbox" type="checkbox" name="name" value="" /></p>
            <p><span>Dropdown list example</span><select id="id" name="name"><option value="1">Example 1</option><option value="2">Example 2</option></select></p>
			-->
            <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="post" value="post" /></p>
          </div>
        </form>
	  <?php }
	  else echo '<br/><p>You must login first.</p>';
	  ?>
	<?php } ?>
      </div>
    </div>
<?php
include_once("footer.php");
?>
