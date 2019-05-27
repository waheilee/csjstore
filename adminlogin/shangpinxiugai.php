<?php
include("admin_check.php");
include_once("../function.php");
include_once("../class/ulevel_class.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
//checkqx(4,12);
$id=$_GET['id'];
$good=getOne("select * from goods where id=$id ");
$lx=$good['lx'];
if ($_POST['button']){
//    if($_POST['price']<0 || $_POST['price2']<0){
//        echo "<script language=javascript>alert('商品价格错误!!.');window.location.href='?'</script>";
//        return ;
//    }
    $id=$_POST['gid'];
    $goods['goodsname'] = $_POST['goodsname'];
    $goods['shichangjia'] = $_POST['shichangjia'];
    $goods['price']=$_POST['price'];
    $goods['shumu']=$_POST['shumu'];
    $goods['shumu2']=$_POST['shumu2'];
//    if($_POST['lx']==1){
//        $goods['shumu']=1;
//        //$goods['shumu2']=1;
//        $goods['price1']=$_POST['shichangjia'];
//        $goods['price2']=$_POST['shichangjia'];
//        $goods['price3']=$_POST['shichangjia'];
//        $goods['price4']=$_POST['shichangjia'];
//        $goods['price5']=$_POST['shichangjia'];
//        $goods['price6']=$_POST['shichangjia'];
//        $goods['price7']=$_POST['shichangjia'];
//        $goods['price8']=$_POST['shichangjia'];
//    }else{
        $goods['price1']=$_POST['price1'];
        $goods['price2']=$_POST['price2'];
        $goods['price3']=$_POST['price3'];
        $goods['price4']=$_POST['price4'];
        $goods['price5']=$_POST['price5'];
        $goods['price6']=$_POST['price6'];
        $goods['price7']=$_POST['price7'];
        $goods['price8']=$_POST['price8'];
//    }
//    $yanse= serialize($_POST['yanse']);
//    $goods['yanse']=$yanse;
//    
//    
//    $goods['shichangjia2'] = $_POST['shichangjia2'];
//    
    $goods['pv']=$_POST['pv'];
    $goods['goodsimg'] = $_POST['goodsimg'];
    $goods['lx'] = $_POST['lx'];
    $goods['sales'] = $_POST['sales'];
    $goods['goodscontent'] = $_POST['content1'];
    $goods['kucun'] = $_POST['kucun'];
    $goods['shunxu'] = $_POST['shunxu'];
    $goods['cis'] = $_POST['cis'];
    
    $goods['bili']=$_POST['bili'];
    $goods['shijian']=$_POST['shijian'];
    
    $goods['leiji']=$_POST['leiji'];
    
    
    echo edit_update_cl('goods', $goods, $_POST['gid']);
    
//    $arr= getAll("select id from goods");
//        foreach ($arr as $key =>$row){
//            $num=getOne("select table_name from information_schema.columns where table_schema = 'kucun' and column_name='g{$row['id']}'");
//            $num2=getOne("select table_name from information_schema.columns where table_schema = 'kucun2' and column_name='g{$row['id']}'");
//            if($num==null){
//                mysql_query("alter table kucun add g{$row['id']} int(11) NOT NULL default '0'");
//            }
//            if($num2==null){
//                mysql_query("alter table kucun2 add g{$row['id']} int(11) NOT NULL default '0'");
//            }
//        } 
    echo "<script language=javascript>alert('修改商品成功.');window.location.href='shangpinxiugai.php?id=$id'</script>";
    
}else{
    if (!$goods=que_select_cl('goods',$_GET['id'])){
        echo "<script language=javascript>alert('商品不存在.');window.location.href='admin_goodsList.php'</script>";
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
<link rel="stylesheet" href="../kindeditor-4.1.9/themes/default/default.css" />
<link rel="stylesheet" href="../kindeditor-4.1.9/plugins/code/prettify.css" />
<script charset="utf-8" src="../kindeditor-4.1.9/kindeditor.js"></script>
<script charset="utf-8" src="../kindeditor-4.1.9/lang/zh_CN.js"></script>
<script charset="utf-8" src="../kindeditor-4.1.9/plugins/code/prettify.js"></script>
<script>
	KindEditor.ready(function(K) {
		var editor1 = K.create('textarea[name="content1"]', {
			cssPath : '../kindeditor-4.1.9/plugins/code/prettify.css',
			uploadJson : '../kindeditor-4.1.9/php/upload_json.php',
			fileManagerJson : '../kindeditor-4.1.9/php/file_manager_json.php',
			allowFileManager : true,
			afterCreate : function() {
				var self = this;
				K.ctrl(document, 13, function() {
					self.sync();
					K('form[name=example]')[0].submit();
				});
				K.ctrl(self.edit.doc, 13, function() {
					self.sync();
					K('form[name=example]')[0].submit();
				});
			}
		});
		prettyPrint();
	});
</script>
<title>商品管理——修改</title>

<link rel="stylesheet" type="text/css" href="css/default.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/shangpinguanli.css">
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
<script>
	KindEditor.ready(function(K) {
		var editor1 = K.create('textarea[name="content1"]', {
			cssPath : '../kindeditor-4.1.9/plugins/code/prettify.css',
			uploadJson : '../kindeditor-4.1.9/php/upload_json.php',
			fileManagerJson : '../kindeditor-4.1.9/php/file_manager_json.php',
			allowFileManager : true,
			afterCreate : function() {
				var self = this;
				K.ctrl(document, 13, function() {
					self.sync();
					K('form[name=example]')[0].submit();
				});
				K.ctrl(self.edit.doc, 13, function() {
					self.sync();
					K('form[name=example]')[0].submit();
				});
			}
		});
		prettyPrint();
	});
</script>
<script>
if(((navigator.userAgent.indexOf('iPhone') > 0) || (navigator.userAgent.indexOf('Android') > 0) && (navigator.userAgent.indexOf('Mobile') > 0) && (navigator.userAgent.indexOf('SC-01C') == -1))){
document.write('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">');
}                                         
</script>
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
<script language="javascript">

function CheckForm(){
	goodsname=document.form1.goodsname.value;
    lx=document.form1.lx.value;
	shichangjia=document.form1.price.value;
    //shumu=document.form1.shumu.value;
	//goodscontent=document.form1.content1.value;
	if(goodsname.length == 0){
		alert("温馨提示:\n请输入商品名称");
		document.form1.goodsname.focus();
		return false;
	}
    if(lx == -1){
		alert("温馨提示:\n请选择商品类型");
		document.form1.lx.focus();
		return false;
	}
	if(shichangjia <= 0){
		alert("温馨提示:\n零售价必须大于0");
		document.form1.shichangjia.focus();
		return false;
	}
//    if(shumu <= 0){
//		alert("温馨提示:\n商品数量必须大于0");
//		document.form1.shumu.focus();
//		return false;
//	}
	//if(goodscontent == ''){
	//	alert("温馨提示:\n请输入商品信息.");
	//	return false;
	//}
	return true;
}
function GetImgName(){
	//根据iframe的id获取对象  
	//var i1 = window.frames['UploadFiles'];   
	//获取iframe中的元素值  
	var i2=document.getElementById("UploadFiles").contentWindow;
	
	var imgname=i2.document.getElementById("imgname").value;
	
	//var imgname=i1.document.getElementById("imgname").value;
	
	document.getElementById("goodsimg").value = imgname;
}

</script>
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><?php include 'header.php';?><!-- #EndLibraryItem --><section id="main" class="clearfix"><!-- #BeginLibraryItem "/Library/sideBar.lbi" --><?php include 'left.php';?><!-- #EndLibraryItem --><div id="conts" cl ass="heightLine-1"><!-- #BeginLibraryItem "/Library/title.lbi" --><?php include 'title.php';?><!-- #EndLibraryItem --><div class="mainBox">
<form name="form1" method="post" action="?" onSubmit="return CheckForm();" > 
               	<h2>添加商品<input name="gid" type="hidden" value="<?=$_GET['id']?>"></h2>
                <div class="table">
                    <table>
                    	<tr>
                        	<td>上传图片</td>
                        	<td>
                            	<iframe ID="UploadFiles" src="UploadFiles.php" frameborder=0 scrolling=no height="35"></iframe>
                            </td>
                        </tr>
                    	<tr>
                        	<td>商品图片</td>
                        	<td>
                            	<input name="goodsimg" type="text" id="goodsimg" size="20" value="<?=$good['goodsimg']?>" maxlength="50">
                                <input name="button" type="button" class="btn1" id="button" onClick="GetImgName()" value="获取图片">
                            </td>
                        </tr>
                    	<tr>
                        	<td>商品类型</td>
                        	<td>
                            	<select name="lx" id="lx">
                                  
                                <?php $n= getOne("select lx,name from leibie where lx=$lx");
                                    
                                    ?>
                                    <option value="<?=$n['lx']?>"><?=$n['name']?></option> 
                               
                                </select>
      						
                            </td>
                        </tr>
                    	<tr>
                        	<td>商品名称</td>
                        	<td>
                     <input name="goodsname" type="text" id="goodsname" size="20" maxlength="50" value="<?=$good['goodsname']?>">
                            </td>
                        </tr>
<!--                     
                                 <tr>
                        	<td>商品颜色 </td>
                        	<td>
                                   
                                    <?php
                                      $yanse1=unserialize($good['yanse']);
                                      $_ulevel=new ulevel_class();
                                         for($i=1;$i;$i++){
                                         $yanse=$_ulevel->getyanse($i);
                                        if($yanse['id']==null){  break; }
                                          ?>
                                          
                                      
                                        	<input type="checkbox" value="<?=$i?>" name="yanse[]" id="yanse"   
                                        	<?php 
                                        	 for($y=0;$y<100;$y++){
                                        	if($yanse['lx']==$yanse1[$y])echo "checked='checked'";
                                        	}
                                        	 ?> /> <?=$yanse['name']?>&nbsp;&nbsp;
                                             
                                              <?php } ?>
                              </td>
                        </tr> -->
                
                       
                
              

                    	<tr>
                                <td>A积分价格</td>
                                <td> <input type="text" value="<?=$good['shichangjia']?>" name="shichangjia" id="shichangjia"/> </td>
                        </tr>
                    	<tr>
                                <td>C积分价格</td>
                                <td> <input type="text" value="<?=$good['price']?>" name="price" id="price"/> </td>
                        </tr>
 <!--                       <?php 
                        if($lx>1){ 
                            ?>
                        <tr>
                                <td>////<?=$name?>价格</td>
                                <td> <input type="text" value="////<?=$good['price']?>" name="price" id="price"/> </td>
                        </tr>
                          <?php   for($i=1;$i<=8;$i++){
                                $ul=ulevel($i+1);
                        ?>
                            <tr>
                                <td>////<?=$ul['lvname']?>价格</td>
                                <td> <input type="text" value="////<?=$good['price'.$i]?>" name="price<?=$i?>" id="price<?=$i?>"/> </td>
                            </tr>
                        
                        <?php 
                            }?>
                        <tr>
                        	<td>赠货数量</td>
                        	<td> <input type="text" value="////<?=$good['shumu']?>" name="shumu" id="shumu"/> </td>
                        </tr>
                        
                        
                            
                        <?php }?>-->
                        <tr>
                        	<td>最低订货</td>
                        	<td> <input type="text" value="<?=$good['shumu2']?>" name="shumu2" id="shumu2"/></td>
                        </tr>
                            
                        
<!--                         <tr> -->
<!--                         	<td>组合价格</td> -->
<!--                         	<td> -->
<!--                                                    <input name="price2" type="text" id="price2" size="20" maxlength="50" value=""> -->
<!--                             +<input name="price3" type="text" id="price3" size="20" maxlength="50" value=""> -->
<!--                             </td> -->
<!--                         </tr> -->
                    	
					    

           

<tr hidden> 
                        	<td>商品库存</td>
                        	<td>
     <input name="kucun" type="text" id="kucun" value="<?=$good['kucun']?>" size="20" maxlength="50">
                            </td>
                        </tr>
                    	<tr>
                        	<td>销量</td>
                        	<td>
       <input name="sales" type="text" id="sales" size="20" maxlength="50" value="<?=$good['sales']?>">
                            </td>
                        </tr>
                        <tr>
                        	<td>浏览次数</td>
                        	<td>
       <input name="cis" type="text" id="cis" size="20" maxlength="50" value="<?=$good['cis']?>">
                            </td>
                        </tr>
                    	<tr>
                        	<td>显示顺序</td>
                        	<td>
  <input name="shunxu" type="text" id="shunxu" size="20" maxlength="50" value="<?=$good['shunxu']?>">
                            </td>
                        </tr>
                    	<tr>
                        	<td>商品信息</td>
                        	<td>
                           <textarea name="content1" style="width:80%;height:400px;visibility:hidden;"><?=$good['goodscontent']?></textarea>
                           </td>
                        </tr>
                    	<tr>
                        	<th colspan="2">
                            	<input name="button" id="button" type="submit" value="修改"/>
                                <input type="button" value="返回" onClick="javascript:history.back();"/>
                            </th>
                        </tr>
                    
                    
                    </table>
                
                </div></form>
            </div>
        </div>
    </section>
</div>
</body>
</html>