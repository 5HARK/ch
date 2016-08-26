<?php
include_once("connect_db.php");
include_once("header.php");
session_start();
?>

<div id="site_content">
    <div id="content">
	<?php 
	$query = "SELECT id FROM board where no=". $_GET['no'];
	$result = $db->query($query);
	$row = $result->fetch_assoc();
	if($_SESSION['id'] === $row['id']){
	    $query = "DELETE FROM board WHERE no='". $_GET['no'] ."'";
	    $result = $db->query($query);

	    if($result === false){
		echo("게시글 삭제에 실패하였습니다.");
	    }else{
		echo("게시글이 삭제되었습니다.");
	    }
	}else{
	    echo("권한이 없습니다.");
	}

	?>

	<input style="margin-center: 0px" class="button" type="button" value="게시판으로 이동하기" onclick="location.href='board.php'" />
<?php    

$db->close();


exit();

?>
<?php
include_once("footer.php");
?>
    </div>
</div>
