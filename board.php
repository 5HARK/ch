<?php
include_once "header.php";
include_once "connect_db.php";
session_start();
?>

	    <div id="site_content">
		<div id="content">
		    <h2>Board</h2>
		    <table style="width:100%; border-spacing:0;">
			<tr><th>No</th><th style="width:60%">Title</th><th>Writer</th></tr>
			<?php
    			$sql = "select * from board order by no desc";
			$result = $db->query($sql);
			while($row = $result->fetch_assoc()){?>
			    <tr>
				<td><?php echo $row['no'] ?></td>
				<td>
				    <a href="view_post.php?id=<?php  echo $row['no']?>"><?php echo $row['title'] ?></a>
				</td>
				<td><?php echo $row['id'] ?></td>
			    </tr>
			<?php } ?>
		    </table>
		    <?php
		    if(isset($_SESSION['id'])) {
		    ?>
			<div class="form_settings">
			    <input style="margin-left: 0px" class="button" type="button" value="write post" onclick="location.href='write_post.php'" />
			</div>
		    <?php } ?>
		</div>  
	    </div>
	    
<?php include_once "footer.php"; ?>
