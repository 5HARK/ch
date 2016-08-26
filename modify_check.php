<?php
include_once("connect_db.php");
include_once("header.php");
session_start();
?>
<div id="site_content">
    <div id="content">
	<?php

	$post_num = $_POST['no'];
	$member_id = $_SESSION['id'];
	$attach_files = $_POST['attach_file'];
	$attach_images = $_POST['attach_image'];
	$q_files = "";
	$q_images = "";

	// 에디터에서 넘어온 첨부파일 파일명들 DB 쿼리용 문자열 초기화 루틴
	if(isset($attach_files)){
	    foreach($attach_files as $file){
		if(!$q_files == ""){
		    $q_files = $q_files. ":" .urldecode($file);
		}else{
		    $q_files = $q_files . urldecode($file);
		}
	    }
	}
	if(isset($attach_images)){
	    foreach($attach_images as $image){
		if(!$q_images == ""){
		    $q_images = $q_images. ":" .urldecode($image);
		}else{
		    $q_images = $q_images . urldecode($image);
		}
	    }
	}

	// 기존에 첨부되어져서 업로드 됬던 파일중 더이상 첨부되지 않은 파일들 삭제 루틴
	$query = "SELECT image_names FROM board where no=". $post_num;
	$result = $db->query($query);
	$row = $result->fetch_assoc();
	$old_q_images = $row['image_names'];

	$query = "SELECT file_names FROM board where no=". $post_num;
	$result = $db->query($query);
	$row = $result->fetch_assoc();
	$old_q_files = $row['file_names'];

	foreach(explode(":", $old_q_images) as $image){
	    if(strpos($q_images, $image) === false){
		if(is_file($image)){
		    unlink($image);
		}
	    }
	}

	foreach(explode(":", $old_q_files) as $file){
	    if(strpos($q_files, $file) === false){
		if(is_file($file)){
		    unlink($file);
		}
	    }
	}

	$query = "UPDATE board SET title='". $_POST['subject'] ."', content='". $_POST['content'] ."', image_names='". $q_images ."', file_names='". $q_files ."' WHERE no=". $post_num;

	if(isset($member_id) && isset($_POST['subject']) && isset($_POST['content'])){
	    $result = $db->query($query);
	}else{
	    $result = false;
	}

	if ($result == false) {
	    echo("게시글 저장에 실패하였습니다.");
	}
	else {
	    echo("게시글이 저장되었습니다.");
	    
	?>
	    <input style="margin-center: 0px" class="button" type="button" value="게시판으로 이동하기" onclick="location.href='board.php'" />
	<?php    
	}

	$db->close();
	
	
	exit();
	
	?>
	<?php
	include_once("footer.php");
	?>
    </div>
</div>
