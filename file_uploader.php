<?php
$file_name = $_FILES['upload_file']['name'];
$tmp_file = $_FILES['upload_file']['tmp_name'];
$file_mime = $_FILES['upload_file']['type'];

$file_path = 'data/'. $file_name;
$file_url = 'data/'. $file_name;


$r = move_uploaded_file($tmp_file, $file_path);

$file_size = $_FILES["upload_file"]["size"];
?>


<!DOCTYPE html>
<html>
    <head>
	<meta charset=utf-8">
	<title>file_uploader.php</title> 
	<script src="./js/popup.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="./css/popup.css" type="text/css"  charset="utf-8"/>
	<script type="text/javascript">
	 // <![CDATA[
	 
	 function initUploader(){
             
             var _opener = PopupUtil.getOpener();
             if (!_opener) {
		 alert('잘못된 경로로 접근하셨습니다.');
		 return;
             }
             
             var _attacher = getAttacher('file', _opener);
             registerAction(_attacher);
             
             if (typeof(execAttach) == 'undefined') { //Virtual Function
		 return;
             }
             
             var _mockdata = {
		 'attachurl': '<?php echo $file_url; ?>',
		 'filemime': '<?php echo $file_mime; ?>',
		 'filename': '<?php echo $file_name; ?>',
		 'filesize': <?php echo $file_size; ?>,
             };
             
             execAttach(_mockdata);
             closeWindow();
             
	 }
	 // ]]>
	</script>
    </head>
    <body onload="initUploader();">

    </body>
</html> 
