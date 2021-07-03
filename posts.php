
<link rel="stylesheet" href="css/style.css">
<script src="js/jquery.min.js"></script>
<script src="js/post-like.js"></script>

<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">


<?php 
require_once("config.php");


$sql = $pdo->prepare("SELECT * FROM posts");
$sql->execute();
$data = $sql->fetchAll();
	
foreach($data as $row){
	
?>


	<div class="content">
	
	<div class="text">
	<?php	echo $row["posts"]; ?>
	</div>

	<?php
	//Count the total likes
	$stmt = $pdo->prepare("SELECT * FROM post_like WHERE post_id=:post_id");
	$stmt->bindParam("post_id",$row["id"], PDO::PARAM_STR);
	$stmt->execute();
	$data=$stmt->fetchAll();
	$countLike = $stmt->rowCount();
	
	
	//Check if user has previously like this post
	//Change this userid to the $_SESSION id
	$userid = 4;
	$stmt = $pdo->prepare("SELECT * FROM post_like WHERE userid=:userid AND post_id=:post_id");
	$stmt->bindParam("userid",$userid, PDO::PARAM_STR);
	$stmt->bindParam("post_id",$row["id"], PDO::PARAM_STR);
	$stmt->execute();
	$value=$stmt->fetch();
	$countReact = $stmt->rowCount();
	
	if($countReact>0){$reactType = $value["reactType"];}
	
	?>
	
	<div class="all-reaction" id="react_<?php echo $row["id"]?>">
	
	<img src="images/thumb.gif" class="reaction" id="thumb_<?php echo $row["id"]?>"> 
	<img src="images/haha.gif" class="reaction" id="haha_<?php echo $row["id"]?>">
	<img src="images/love.gif" class="reaction" id="love_<?php echo $row["id"]?>">
	<img src="images/wow.gif" class="reaction" id="wow_<?php echo $row["id"]?>">
	<img src="images/sad.gif" class="reaction" id="sad_<?php echo $row["id"]?>">
	<img src="images/angry.gif" class="reaction" id="angry_<?php echo $row["id"]?>">
	
	</div>
	
	<div class="react-con" align="center" id="<?php echo $row["id"];?>">
	
	<?php if($countReact>0){ ?>
	<img src="images/<?php echo $reactType;?>.png" class="reaction" style="width:40px; height:40px">
	<?php }?>
	
	<?php if($countReact<1){ ?>
	<i class="glyphicon glyphicon-thumbs-up" style="font-size:18px; margin:11px;"></i>
	
	<?php }?>
	
	</div> <span id="counter_<?php echo $row["id"]?>"><?php if($countLike>0){echo $countLike; }?></span>


</div><p>

	<?php
	}
	?>


	
