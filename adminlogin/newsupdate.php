<?php
include("admin_check.php");
include_once("../function.php");
session_start();

if ($_GET['nid']!=NULL){
    $nid=$_GET['nid'];
    $news=que_select_cl('news',$_GET['nid']);
}else{
    echo "<script language=javascript>alert('新闻不存在,可能已被删除.');window.location.href='../test.php?yid=11'</script>";
}

if ($_POST['save']){
    if($_GET['nid']!=NULL){
        //var_dump($_POST);exit;
        $nid=$_GET['nid'];
        $newstitle=$_POST['newstitle'];
        $newscontent=$_POST['content'];
        //$newstime=$_POST['newstime'];
        $news['newstitle']=$newstitle;
        $news['newscontent']=$newscontent;
        //$news['newstime']=$newstime;
        if(!$newscontent){
            $newscontent=$_POST['content1'];
        }
        edit_update_cl("news",$news,$nid);
        echo "<script language=javascript>alert('新闻修改成功.');window.location.href='?nid=".$nid."'</script>";
    }else{
        echo "<script language=javascript>alert('新闻修改失败.');window.location.href='../test.php?yid=11'</script>";
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
    <title>修改新闻</title>
    <link rel="stylesheet" type="text/css" href="css/lanrenzhijia.css">
    <link rel="stylesheet" type="text/css" href="css/common/layout.css">
    <link rel="stylesheet" type="text/css" href="css/common/general.css">
    <link rel="stylesheet" type="text/css" href="css/content.css">
    <link rel="stylesheet" type="text/css" href="css/shangpinguanli.css">
    <script src="js/jquery.js"></script>
    <script src="js/lanrenzhijia.js"></script>
    <script src="js/heightLine.js"></script>
    <script src="js/index.js"></script>
    <script type="text/javascript" charset="utf-8" src="./uephp/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="./uephp/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="./uephp/lang/zh-cn/zh-cn.js"></script>
    <script>
        if(((navigator.userAgent.indexOf('iPhone') > 0) || (navigator.userAgent.indexOf('Android') > 0) && (navigator.userAgent.indexOf('Mobile') > 0) && (navigator.userAgent.indexOf('SC-01C') == -1))){
            document.write('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">');
        }
    </script>
    <script language="javascript">
        <!--
        function CheckForm(){
            newstitle=document.form1.newstitle.value;
            newscontent=document.form1.newscontent.value;
            if(newstitle.length == 0){
                alert("温馨提示:\n请输入新闻标题.");
                document.form1.newstitle.focus();
                return false;
            }
            if(newscontent == ''){
                alert("温馨提示:\n请输入新闻内容.");
                return false;
            }
            return true;
        }
        -->
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
                <h2>修改新闻</h2>
                <div class="table">
                    <form name="form1" method="post" action="?nid=<?=$nid?>" onSubmit="return CheckForm()">
                    <table>

                            <tr>
                                <td>标题</td>
                                <td>
                                    <input type="text" value="<?=$news['newstitle']?>" name="newstitle" id="newstitle"/>
                                </td>
                            </tr>

                            <tr>
                                <td>内容</td>
                                <td>
                                    <script id="editor" name="content" type="text/plain" style="width:1024px;height:500px;"><?=$news['newscontent']?></script>
                                    <textarea name="content1" id="content1" hidden></textarea>
                                    <script type="text/javascript">

                                        //实例化编辑器
                                        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                                        var ue = UE.getEditor('editor');

                                        function createEditor() {
                                            enableBtn();
                                            UE.getEditor('editor');
                                        }
                                        function getContent() {
                                            var content1 = document.getElementById('content1');
                                            content1.value=UE.getEditor('editor').getContent()
//                                        var arr = [];
//                                        arr.push("使用editor.getContent()方法可以获得编辑器的内容");
//                                        arr.push("内容为：");
//                                        arr.push(UE.getEditor('editor').getContent());
//                                        alert(arr.join("\n"));
                                        }
                                        function enableBtn() {
                                            var div = document.getElementById('btns');
                                            var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
                                            for (var i = 0, btn; btn = btns[i++];) {
                                                UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
                                            }
                                        }

                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="2">
                                    <input type="submit" onclick="getContent()" name="save" value="发布" />
                                </th>
                            </tr>


                    </table>
                    </form>
                </div>


            </div>
        </div>
    </section>
    <footer id="gFooter">

    </footer>
</div>
</body>
</html>