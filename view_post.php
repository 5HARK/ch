<?php
include_once("header.php");
include_once("connect_db.php");
session_start();
?>

<?php

$query = "SELECT * FROM board WHERE no = ". $_GET['no'] . ";";
$result = $db->query($query);
$data = $result->fetch_array();

?>

<div id="site_content">
    <div id="content">
	<table>
	    <tr>
		<th style="width:5%" align="left" >
		    <?php echo $data['no']; ?>
		</th>
		<th style="width:80%" align="center" >
		    <?php echo $data['title']; ?>
		</th>
		<th width="5%" align="right">
		    <?php echo $data['id']; ?>
		</th>
	    </tr>
	    <tr>
		<td colspan="3">
		    <?php echo $data['content'];  ?>
		</td>
	    </tr>
	</table>
	<div class="form_settings">
	    <input style="margin-left: 0px" class="button" type="button" value="목록" onclick="location.href='board.php'" />
	    <?php if($data['id'] == $_SESSION['id']){?>
		<input style="margin-left: 0px" class="button" type="button" value="수정" onclick="location.href='modify_post.php?no=<?php echo($data['no']); ?>'" />
	    <?php } ?>
	    <?php if($data['id'] == $_SESSION['id']){?>
		<input style="margin-left: 0px" class="button" type="button" value="삭제" onclick="location.href='delete.php?no=<?php echo($data['no']); ?>'" />
	    <?php } ?>
	</div>
    </div>
</div>

<?php
include_once("footer.php");
?>
