<?php 
include("admin_check.php");
include_once("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
//checkqx(7,25);
//删除文件
function delDirAndFile($path,$delDir = FALSE) {
    $handle = opendir($path);
    if ($handle) {
        while (false !== ( $item = readdir($handle) )) {
            if ($item != "." && $item != "..")
                is_dir("$path/$item") ? delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
        }
        closedir($handle);
        if ($delDir)
            return rmdir($path);
    }else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return FALSE;
        }
    }
}
if ($_POST['button']){
    $pasword=md5($_POST['password']);
    $sql="select * from to_admin where id='".$_SESSION['adminid']."' ";
    $ad=getOne($sql);
    if($ad['loginpass'] == $pasword){
        
    
        	$sql="delete from `member` where id<>1";
        	@mysql_query($sql) or die (mysql_error());
            
        	$sql="alter table `member` AUTO_INCREMENT=1";
        	@mysql_query($sql) or die (mysql_error());
            
            $sql="delete from `isnews` where id<>1";
        	@mysql_query($sql) or die (mysql_error());
            
        	$sql="alter table `isnews` AUTO_INCREMENT=1";
        	@mysql_query($sql) or die (mysql_error());
            
        	$sql="delete from `kkk`";
        	@mysql_query($sql) or die (mysql_error());
        	$ulevel=1;
            $ul= ulevel($ulevel);
            $member_update['rejine']=0;
        	$member_update['rdt']=now();
        	$member_update['pdt']=now();
            $member_update['fanli']=0;
        	$member_update['ulevel']=$ulevel;
        	$member_update['lsk']=$ul['lsk'];
        	$member_update['slsk']=0;
        	$member_update['dan']=0;
            $member_update['dan2']=0;
            $member_update['ydan2']=0;
            $member_update['dan1']=0;
            $member_update['ydan1']=0;
        	$member_update['pv']=0;
        	$member_update['meys']=0;
        	$member_update['sgb']=0;
        	$member_update['maxsgb']=0;
        	$member_update['djsgb']=0;
        	$member_update['gwb']=0;
        	$member_update['jihuo']=0;
        	$member_update['zsq']=0;
        	$member_update['mey']=0;
        	$member_update['jj']=0;
        	$member_update['maxfanli']=0;
        	$member_update['maxmey']=0;
        	$member_update['wlf']=0;
        	$member_update['recount']=0;
        	$member_update['recount2']=0;
        	$member_update['reyeji']=0;
        	$member_update['area1']=0;
        	$member_update['area2']=0;
        	$member_update['area3']=0;
        	$member_update['area4']=0;
        	$member_update['area5']=0;
        	$member_update['narea1']=0;
        	$member_update['narea2']=0;
        	$member_update['narea3']=0;
        	$member_update['yarea1']=0;
        	$member_update['yarea2']=0;
        	$member_update['yarea3']=0;
        	$member_update['rejine']=0;
        	$member_update['b0']=0;
        	$member_update['b1']=0;
        	$member_update['b2']=0;
        	$member_update['b3']=0;
        	$member_update['b4']=0;
        	$member_update['b5']=0;
        	$member_update['b6']=0;
        	$member_update['b7']=0;
        	$member_update['b8']=0;
        	$member_update['re1']=0;
        	$member_update['re2']=0;
        	$member_update['re3']=0;
        	$member_update['ispay']=1;
        	$member_update['zhongzi']=0;
        	$member_update['cis']=0;
        	$member_update['cishu']=0;
        	$member_update['zjulevel']=0;
                $member_update['zjulevel1']=0;
            $member_update['zju']=0;
        	$member_update['erweima']="";
        	$member_update['cfxf']=0;
        	
        	$member_update['ishb']=0;
        	$member_update['zb1']=0;
        	$member_update['isfh']=0;
        	$member_update['gudong']=0;
        	$member_update['pid']=0;
        	$member_update['pcount']=0;
        	$member_update['chl']=0;
        	$member_update['chr']=0;
        	$member_update['isb']=1;
        	$member_update['isbd']=2;
                $member_update['bdid']=0;
        	$member_update['bdlevel']=1;
        	$member_update['zuo']=0;
        	$member_update['zhong']=0;
        	$member_update['you']=0;
          
        	$member_update['jiekuan']=0;
        	$member_update['jkje']=0;       	
        	$member_update['hkje']=0;
        	$member_update['tao']=0;
        	$member_update['teamtao']=0;
        	$member_update['retao']=0;
        	$member_update['re1']=0;
        	$member_update['re2']=0;
        	$member_update['sd']=0;
                $member_update['z1']=1;
                $member_update['z2']=1;
                $member_update['z3']=1;
                $member_update['z4']=1;
                $member_update['z5']=1;
                $member_update['z6']=1;
                $member_update['z0']=1;
                $member_update['zl1']=1;
                $member_update['zl2']=1;
                $member_update['zl3']=1;
                $member_update['zl4']=1;
                $member_update['zl5']=1;
                $member_update['zl6']=1;
                $member_update['zl0']=1;
                $member_update['fdate']=0;
                $member_update['isff']=0;
        	
        	
        	
        	$member_update['date1']=null;
        	$member_update['date2']=null;

        	$member_update['kai']=1;
        	$member_update['cy']=0;
        	
//            $member_update['sheng']=0;
//            $member_update['shi']=0;
//            $member_update['xian']=0;
        	edit_update_cl('member',$member_update,1);
        	
        	$system_update['yeji']=0;
        	$system_update['fanli']=0;
        	$system_update['qckai']=0;
        	// $system_update['zhanting']=0;
        	$system_update['date']=0;
        	$system_update['date1']=0;
        	$system_update['date2']=0;
        	$system_update['date3']=0;
            $system_update['num']=0;
        	$system_update['shichangjia']=0;
        	$system_update['fenhong']=0;
        	$system_update['zhanting']=0;
            $system_update['rid']=1;
            
        	$system_update['rsum']=0;
        	edit_update_cl('systemparameters',$system_update,1);
        	
        	//$jsb['num']=5000000;
        	//$jsb['shu']=50000;
        	//$jsb['lsk']=0.2;
        	//$jsb['jia']=0.01;
        	//$jsb['jine']=0.2;
        	//$jsb['ltnum']=0;
        	//$jsb['synum']=0;
        	//$jsb['buy']=0;
        	
        	
        	
        	//edit_update_cl('jiaoyibi',$jsb,1);//交易币还原
        	
        	 
        	edit_sql("update `goods` set cis=0,sales=0");
            
//        	edit_delete_all('kucun');
//            edit_delete_all('kucun2');
//            edit_delete_all('news');
           
            
        	edit_delete_all('jiekuan');
        	edit_delete_all('ljyeji');
        	edit_delete_all('addon_cengyeji');
        	edit_delete_all('tuidan');
        	edit_delete_all('gqdh');
        	edit_delete_all('ipdz');
        	
        	edit_delete_all('action');
        	edit_delete_all('jiesuan');
        	edit_delete_all('aixinjijin');
        	edit_delete_all('ulevelup');
        	edit_delete_all('ulevelup2');
        	edit_delete_all('lsbd');
        	edit_delete_all('bonus');
        	edit_delete_all('bonustime');
        	edit_delete_all('chongzhi');
        	edit_delete_all('huikuan');
        	edit_delete_all('mail');
        	edit_delete_all('orders');
        	edit_delete_all('orders2');
            edit_delete_all('inorders');
        	edit_delete_all('systemyeji');
        	edit_delete_all('tixian');
        	edit_delete_all('zhuanhuan');
        	edit_delete_all('zhuanzhang');
        	edit_delete_all('bdrecord');
        	edit_delete_all('bonuslaiyuan');
        
        	edit_delete_all('buysell');
        	edit_delete_all('buycar');
        	edit_delete_all('bonuslaiyuan');
        	edit_delete_all('fulijiang');
        	edit_delete_all('qianbao');
        	edit_delete_all('home');
        	edit_delete_all('home2');
        	
        	//edit_delete_all('buy');
        	edit_delete_all('buynum');
        	edit_delete_all('dongjie');
        	edit_delete_all('jingtai');
        	edit_delete_all('jingtaimx');
        	edit_delete_all('jiaoyibicf');
        	edit_delete_all('zju');
            $sys=getsys();
        	$path='../upload2/';
                delDirAndFile($path,$delDir = FALSE);
                
                //引入phpqrcode库文件
                include_once("../web2/phpqrcode.php");
                $u= getOne("select * from member where id=1");
                
                // 二维码数据
                $data = $sys['url'].'/web2/register2.php?rname='.$u['nickname'];

                // 生成的文件名
                $filename = '1.png';
                // 纠错级别：L、M、Q、H
                $errorCorrectionLevel = 'L';
                // 点的大小：1到10
                $matrixPointSize = 3;
                //创建一个二维码文件
                QRcode::png($data,'../upload2/1.png',$errorCorrectionLevel,$matrixPointSize,2);
                //输入二维码到浏览器
                //		QRcode::png($data);

                edit_sql("update member set erweima='1.png' where id=1");

        	
        	echo "<script language=javascript>alert('清空数据完成.');window.location.href='?'</script>";
    }else {
        echo "<script language=javascript>alert('管理员密码有误.');window.location.href='?'</script>";
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>清空数据</title>
<link rel="stylesheet" type="text/css" href="css/default.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/xitongshezhi.css">
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
<script>
if(((navigator.userAgent.indexOf('iPhone') > 0) || (navigator.userAgent.indexOf('Android') > 0) && (navigator.userAgent.indexOf('Mobile') > 0) && (navigator.userAgent.indexOf('SC-01C') == -1))){
document.write('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">');
}                                         
</script>
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
</head>
<body>
<div id="container">
    <!-- #BeginLibraryItem "/Library/header.lbi" -->
     <?php include 'header.php';?>
    <!-- #EndLibraryItem -->
<section id="main" class="clearfix">
        <!-- #BeginLibraryItem "/Library/sideBar.lbi" -->
       <?php include 'left.php';?>
        <!-- #EndLibraryItem -->
<div id="conts" cl ass="heightLine-1">
            <!-- #BeginLibraryItem "/Library/title.lbi" -->
             <?php include 'title.php';?>
            <!-- #EndLibraryItem -->
<div class="mainBox">
            	<div class="table3">
                	<table>
                    	<tr>
                        	<td>注意：清空数据库前先做好数据备份，以免重要数据丢失</td>
                        </tr>
                    	<tr>
                        	<td><form id="form1" name="form1" method="post" action="">
                        	    <p style="visibility: hidden;"><input type="password" id="0"  disabled ></p>
                        	
                        	     输入管理密码：<input type="password" name="password" id="password" value="">&nbsp;&nbsp;
                               <input name="button" type="submit" class="btn3" id="button" value="清空数据" onClick="{if(confirm('您确定要清空数据吗?')){this.document.selform.submit();return true;}return false;}"/></td>
                        </tr>
                    </table>
                	
                
                </div>
                
                
                
                
                
            </div>
        </div>
    </section>
</div>
</body>
</html>