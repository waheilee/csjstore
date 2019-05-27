<!DOCTYPE html>
<?php
include_once ("check.php");
include("check2.php");
include_once("../function.php");
include_once("../class/member_class.php");
include_once("../class/ulevel_class.php");
include_once("../bonus.php");
header("Content-Type: text/html;charset=utf-8");
session_start();

// $ID=$_GET['ID'];
// if ($ID=="")
$ID=$_SESSION['ID'];
$member = getMemberbyID($_SESSION['ID']);
$_member=new member_class();
// $cx="&ID=".$ID."";
#激活会员
if ($_POST['button']){

	$id = $_POST['oid'];
	$chenggong=0;
	$shibai=0;

        $us=getMemberbyID($id);
    if($member['zsq']>=$us['lsk']){
        
        $_member->jihuomember($id);
        $_member->addbdrecord($us,$member,$us['lsk']);//激活记录
    edit_sql("update `member` set zsq=zsq-{$us['lsk']} where id=".$_SESSION['ID']."");
	echo "<script language=javascript>alert('会员激活完成');window.location.href='?'</script>";
    }else{
        echo "<script language=javascript>alert('A积分不足无法激活');window.location.href='?'</script>";
    }
}

#删除会员
if ($_POST['button4']){
	$id = $_POST['oid'];
        
	$us=$_member->getMemberbyID($id);
        
	if ($us['ispay']==0){

        
		if ($_member->checkfman($id)){
    		edit_delete_cl('member',$id);
		}else{
			$us=$_member->getMemberbyID($id);
			echo "<script language=javascript>alert('会员".$us['nickname']."下方已经安置了会员,删除失败.');window.location.href='?'</script>";	
		}
	}
	echo "<script language=javascript>alert('删除会员完成.');window.location.href='?'</script>";
}
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>激活会员</title>
<SCRIPT LANGUAGE=javascript>
<!--
function SelectAll() {
	for (var i=0;i<document.form1.UID.length;i++) {
		var e=document.form1.UID[i];
		e.checked=!e.checked;
	}
}
-->
</script>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/send.css">
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
 <?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
    	<div class="mainBox">
            <form action="" method="post">
            	<div class="table">
                	<table>
                    	<tr>
                                <td class="two" >会员编号</td>
                                <td class="two" >会员姓名</td>
                                <td class="two">投资金额</td>
                                <td class="two">会员资格</td>
                                <td class="two">推荐人</td>
                                <td class="two">接点人</td>
                                <td class="two">注册时间</td>
                                <td class="two">详细信息</td>
                        </tr>
                        <?php
                            $pagesize = 20; //设置每页记录数
                            $sql = "SELECT * FROM `member` WHERE ispay=0 and bdid={$member['id']}";
		if($query = mysql_query($sql)){
	  		$sum = mysql_num_rows($query); //计算总记录数 
		}else{
			$sum=0;	
		} 
		if($sum % $pagesize == 0) //计算总页数 
			$total = (int)($sum/$pagesize); 
		else 
			$total = (int)($sum/$pagesize) + 1; 
			if (isset($_GET['page'])) //获得页码
			{ 
				$p = (int)$_GET['page'];
			} 
			else 
			{ 
				$p = 1;
			}
			if ($p>$total){
				$p=$total;	
			}
		$start = $pagesize * ($p - 1); //计算起始记录 
      	$sql = "SELECT * FROM `member` WHERE ispay=0 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by rdt desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			$ul=ulevel($row['ulevel']);
                                    ?>
                                     
                                    <tr>
                                <form name="form1" method="post" action="?id=<?=$row['id']?>">
                                    <input type="hidden" value="<?=$row['id']?>" name="oid">
                                        <td class="two" ><?=$row['userid']?></td>
                                        <td class="two" ><?=$row['username']?></td>
                                        <td class="two"><?=$row['lsk']?></td>
                                        <td class="two"><?=$ul['lvname']?></td>
                                        <td class="two"><?=$row['rname']?></td>
                                        <td class="two"><?=$row['fathername']?></td>
                                        <td class="two"><?=$row['rdt']?></td>
                                        <td class="two">
                                    
                                            <input name="button" type="submit" class="button" id="button" value="激活会员" onClick="{if(confirm('您确定要激活该会员吗?')){this.document.selform.submit();return true;}return false;}">
                                            <input name="button4" type="submit" class="button" id="button4" value="删除会员" onClick="{if(confirm('您确定要删除该会员吗?')){this.document.selform.submit();return true;}return false;}">
                                        </td>
                                    </form>
                                    </tr>
                                    <?php
                                }
                            }else{
                                ?>
                                <tr>
                                    <td colspan="10">暂无内容</td>
                                </tr>
                            <?php } ?>
                                 <tr>
                                    <td colspan="10"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
                                </tr>
                    </table>
                </div>
            
            
            </form>
           
        </div>
    <br/> <br/> <br/>
    </section><?php include 'footer.php';?>
</body>
</html>