<?php 
require_once("config.php");
error_reporting(0);

		$reactType = $_POST["reactType"];
		$postId = $_POST["postId"];
		
		//Change this userid to the $_SESSION id
		$userid = 4;
	

	
	$stmt = $pdo->prepare("SELECT * FROM post_like WHERE userid=:userid AND post_id=:post_id");
	$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
    $stmt->bindParam(":post_id", $postId, PDO::PARAM_STR);
	$stmt->execute();
	$getReact = $stmt->fetch();
	$count = $stmt->rowCount();
		
	if(isset($reactType) && $getReact["reactType"]!==$reactType){
	$stmt = $pdo->prepare("UPDATE post_like SET reactType=:reactType WHERE post_id=:post_id AND userid=:userid");
    $stmt->bindParam(":reactType", $reactType, PDO::PARAM_STR);
    $stmt->bindParam(":post_id", $postId, PDO::PARAM_STR);
	$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
	$stmt->execute();
	}
	
	if($count<1){
	$stmt = $pdo->prepare("INSERT INTO post_like(userid, post_id, reactType) VALUE (:userid, :post_id, :reactType)");
    $stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
    $stmt->bindParam(":post_id", $postId, PDO::PARAM_STR);
    $stmt->bindParam(":reactType", $reactType, PDO::PARAM_STR);
	$stmt->execute();
	}
	
	

	$stmt = $pdo->prepare("SELECT * FROM post_like WHERE post_id=".$postId);
	$stmt->execute();
	$data=$stmt->fetchAll();
	$countLike = $stmt->rowCount();
	echo $countLike;
?>




