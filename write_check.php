<?php
include_once("connect_db.php");
include_once("header.php");
session_start();
?>
<div id="site_content">
    <div id="content">
	<?php


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
	

	$query = "INSERT INTO board (id, title, content, image_names, file_names) VALUES('" . $member_id . "', '". $_POST['subject'] ."', '". $_POST['content'] ."', '". $q_images ."', '". $q_files ."')";

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
