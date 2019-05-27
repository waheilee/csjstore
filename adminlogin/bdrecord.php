<?php
include("admin_check.php");
include_once("../function.php");
include_once("../class/bonus_class.php");
include_once("../class/member_class.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
#搜索会员
if ($_POST['Search']){
    $SearchContent=$_POST['SearchContent'];
    $SearchType=$_POST['SearchType'];
    if ($SearchContent!=NULL){
        if($SearchType==1){
             #搜索会员编号
            //$uu=getMemberbyNickName($SearchContent);
            $_SESSION['Search']="and nickname='".$SearchContent."'";
        }else{
             #搜索推荐人编号
            //$uu=getMemberbyNickName($SearchContent);
            $_SESSION['Search']="and bdname='".$SearchContent."'";
        }
           

    }else{
        $_SESSION['Search']=NULL;
    }
}else{
    if ($_GET['page']==NULL){
        $_SESSION['Search']=NULL;
        $_SESSION['SearchTime']=NULL;
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
    <title>激活记录</title>
    <link rel="stylesheet" type="text/css" href="css/common/layout.css">
    <link rel="stylesheet" type="text/css" href="css/common/general.css">
    <link rel="stylesheet" type="text/css" href="css/content.css">
    <link rel="stylesheet" type="text/css" href="css/jihuohuiyuan.css">
    <script src="js/jquery.js"></script>
    <script src="js/heightLine.js"></script>
    <script src="js/index.js"></script>
    <script language="javascript">
        <!--
        function checknickname(lx)
        {
            var iframe = document.getElementById("iframe");
            var user =  document.getElementById("nickname");
            iframe.src= "../member/checknickname.php?lx="+lx+"&nickname="+user.value;
        }



        -->
    </script>
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
        <div id="conts" class="celan heightLine-1">
            <!-- #BeginLibraryItem "/Library/title.lbi" -->
            <?php include 'title.php';?>
            <!-- #EndLibraryItem -->
            <div class="mainBox">
                <div class="title clearfix">
                    <form action="" method="post">
                        <div class="left">
                            <select name="SearchType" id="SearchType">
                                <option value="1">会员编号</option>
                                <option value="2">推荐人编号</option>
                            </select>
                            <input type="text" name="SearchContent" id="SearchContent">
                            <input type="submit" name="Search" id="Search" class="btn1" value="搜索">

                        </div>
<!--                        <div class="right">-->
<!--                             <span>搜索时间范围：</span><input type="text" name="date" class="tcal" value="" />至-->
<!--                             <input type="text" name="date" class="tcal1 tcal" value="" />-->
<!--                         </div>-->
                    </form>
                </div>
                <br/>
                <div class="table4">
                    <table>
                        <tr>
                            <th colspan="7">激活记录</th>
                        </tr>
                        <tr>
                            
                            <td>会员编号</td>
                            <td>会员姓名</td>
                            <td>会员级别</td>
                            <td>投资金额</td>
                            <td>推荐人编号</td>
                            <td>激活时间</td>
                        </tr>
                        <?php
                        $pagesize = 10; //设置每页记录数
                        $sql = "SELECT id FROM `bdrecord` where 1=1  ".$_SESSION['Search']." ";
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
                        $sql = "SELECT * FROM `bdrecord`  where 1=1 ".$_SESSION['Search']." order by bddate desc limit ".$start.",".$pagesize;
                        if($query = mysql_query($sql)){
                            while ($row=mysql_fetch_array($query)){
                                $us= getOne("select username from member where id={$row['uid']}");
                                $ul=ulevel($row['ulevel']);

                                ?>
                                <tr>
                                    <td align="center"><?=$row['nickname']?></td>
                                    <td align="center"><?=$us['username']?></td>
                                    <td align="center"><?=$ul['lvname']?></td>
                                    <td align="center"><?=$row['lsk']?></td>
                                    <td align="center"><?=$row['bdname']?></td>
                                    <td align="center"><?=$row['bddate']?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                        <tr>
                            <th colspan="7"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></th>
                        </tr>
                    </table>


                </div>




            </div>
        </div>
    </section>
    <footer id="gFooter">

    </footer>
</div>
</body>
</html>