<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<h2><span>您好!</span>欢迎使用会员管理系统</h2>
            <ul class="clearfix">
            <?php if($_SESSION['to_admin'] ==admin){?>
            <!--  
                <li> <a href="huikuantongzhi.php">汇款通知</a> </li>
              --> 
                <li> <a href="tixianguanli.php">提现管理</a> </li>
                 <li> <a href="chongzhiguanli.php">充值管理</a> </li>
                 <li> <a href="jiangjinzongbiao.php">奖金总表</a> </li>
<!--                <li> <a href="shengjishenqing.php">升级申请</a> </li>-->
                <li> <a href="dingdanguanli.php">订单管理</a> </li>
            </ul>
            <?php }?>