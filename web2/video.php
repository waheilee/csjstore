<!DOCTYPE html>
<?php
include("check.php");
include("check2.php");
include_once("../function.php");
include_once("../class/system_class.php");

if ($_GET['action']=="admin"){
	$ID=$_GET['ID'];
}else{
	$_system=new system_class();
	
}

?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>会员详情</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/jbxx.css">
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
    	<?php include 'header.php';?>
    </header><!-- #EndLibraryItem -->
    
    
    <section id="main">
   		  <div class="mainBox">
   		  <?php
	  
	  	$sql = "SELECT * FROM `shipin` WHERE isfb=1 order by date desc";
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
          	<div class="video">
            	<h2><?=$row['biao']?></h2>
                <video  controls>
                	 <source  src="../upload2/<?=$row['name']?>" type="video/mp4">
                </video>
            </div>
            <!-- 
          	<div class="video">
            	<h2>视频一</h2>
                <video autoplay controls>
                	 <source  src="video/1.mp4" type="video/mp4">
                </video>
            </div>
          	<div class="video">
            	<h2>视频一</h2>
                <video autoplay controls>
                	 <source  src="video/1.mp4" type="video/mp4">
                </video>
            </div>
           -->
          <?php }}?>
          </div>
      
      
        
        <br/><br/><br/><br/><br/><br/>
    </section><?php include 'footer.php';?>
</body>
</html>