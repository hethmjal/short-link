<?php
ob_start();

session_start();
 
	include "connect.php";

	if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['do'] == "active"){
		$id = $_POST['id'];
		$stmt = $connect->prepare("UPDATE users SET `user_approval` = 1 WHERE `users`.`user_id` = '$id'");
		$stmt->execute();
		$count = $stmt->rowCount();
		if($count > 0){
			
			?>
			<meta http-equiv="refresh" content="0; url=user_report.php">
		
	<?php }

	}
   
	if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['do'] == "delete"){
		$id = $_POST['id'];
		$stmt = $connect->prepare("DELETE FROM `users` WHERE `users`.`user_id` = '$id'");
		$stmt->execute();
		$count = $stmt->rowCount();
		if($count > 0){
			
		?>
		<meta http-equiv="refresh" content="0; url=user_report.php">
	
<?php } }