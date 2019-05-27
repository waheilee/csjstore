<?php
session_start();
include("admin_check.php");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="javascript">

<!--
function SetUrl(url,para)
{
	parent.iframepage.location.href = url+"?yemian="+para;
}
function iFrameHeight() {
var ifm= document.getElementById("iframepage");
var subWeb = document.frames ? document.frames["iframepage"].document : ifm.contentDocument;
if(ifm != null && subWeb != null) {
ifm.height = subWeb.body.scrollHeight;
}
}
-->

</script>
<script language="JavaScript">
<!-- Hide
function killErrors() {
return true;
}
window.onerror =killErrors;
// -->
</script>
<div id="sideBar" cl ass="heightLine-1">
        	<ul>
            	<li><a href="main.php">首页</a></li>
            	<li>
	<?php if($_SESSION['zq1']==1){ echo "<a href='#' class='first'>会员管理</a>";}?>
                   <div class="dropdown">
                    
                    <?php if($_SESSION['q1']==1){ echo "<a href='jihuohuiyuan.php'>激活会员</a>";}?>
                    <!--<?php if($_SESSION['q1']==1){ echo "<a href='zhucehuiyuan.php'>注册会员</a>";}?>
                    <?php if($_SESSION['q3']==1){ echo "<a href='shengjishenqing.php'>升级申请</a>";}?>
                    <?php if($_SESSION['q5']==1){ echo "<a href='shengjijilu.php'>升级记录</a>";}?>-->
                    <?php if($_SESSION['q2']==1){ echo "<a href='zhengshihuiyuan.php'>正式会员</a>";}?>
                    <?php if($_SESSION['q4']==1){ echo "<a href='bdrecord.php'>激活记录</a>";}?>
                    <?php if($_SESSION['q6']==1){ echo "<a href='caozuojilu.php'>操作记录</a>";}?>
                       
                    <!--
                    <?php if($_SESSION['q7']==1){ echo "<a href='fuwuzhongxin.php'>服务中心</a>";}?>
                    <?php if($_SESSION['q8']==1){ echo "<a href='shitizhanting.php'>实体展厅</a>";}?>
                    -->
                    	
                    </div>
                </li>
            	<li>
		<?php if($_SESSION['zq2']==1){ echo "<a href='#' class='first'>财务管理</a>";}?>

                    <div class="dropdown"> 
                    <?php if($_SESSION['q9']==1){ echo "<a href='jiangjinjiesuan.php'>会员升级</a>";}?>
                    <?php if($_SESSION['q10']==1){ echo "<a href='chongzhiguanli.php'>充值管理</a>";}?>
                    <?php if($_SESSION['q11']==1){ echo "<a href='tixianguanli.php'>提现管理</a>";}?>
                    <?php if($_SESSION['q12']==1){ echo "<a href='zhuanzhangjilu.php'>转账记录</a>";}?>
                        
                <!--<?php if($_SESSION['q5']==1){ echo "<a href='jidufenhong.php'>董事分红</a>";}?>    
                    
                    <?php if($_SESSION['q6']==1){ echo "<a href='jiekuanshenqing.php'>借款申请</a>";}?>                                          	
                    <?php if($_SESSION['q10']==1){ echo "<a href='zhuanhuanjilu.php'>转换记录</a>";}?>                          
                 	<?php if($_SESSION['q9']==1){ echo "<a href='fenhong.php'>管理奖发放</a>";}?>
                    <?php if($_SESSION['q31']==1){ echo "<a href='fulijiang.php'>福利奖管理</a>";}?>-->
                        
                    </div>
                </li>
            	<li>
	<?php if($_SESSION['zq3']==1){ echo "<a href='#' class='first'>数据统计</a>";}?> 
                	
                    <div class="dropdown">
                    <?php if($_SESSION['q14']==1){ echo "<a href='jiangjinzongbiao.php'>积分总表</a>";}?>   
                    <?php if($_SESSION['q15']==1){ echo "<a href='jiangjinmingxi.php'>积分明细</a>";}?> 
<!--                    <?php if($_SESSION['q15']==1){ echo "<a href='honglibaomingxi.php'>红利包明细</a>";}?> -->
                    <?php if($_SESSION['q16']==1){ echo "<a href='huiyuantongji.php'>会员统计</a>";}?>					
                    <?php if($_SESSION['q17']==1){ echo "<a href='shouzhitongji.php'>收支统计</a>";}?>                   
                    <?php if($_SESSION['q18']==1){ echo "<a href='yejitongji.php'>业绩统计</a>";}?>  
                   <?php //if($_SESSION['q13']==1){ echo "<a href='yejifenxi.php'>本月排名</a>";}?>            
                    <?php if($_SESSION['q19']==1){ echo "<a href='shujupaihang.php'>数据排行</a>";}?>                    	
                        
                    </div>
                </li>
            	<li>
<?php if($_SESSION['zq4']==1){ echo "<a  href='#' class='first'>商城管理</a>";}?>

                    <div class="dropdown">
                   <?php if($_SESSION['q20']==1){ echo "<a href='tianjiashangpin.php?lx=1'>添加商品</a>";}?>
                   <?php if($_SESSION['q21']==1){ echo "<a href='shangpinguanli.php'>商品管理</a>";}?>
                   
                                           	          
                   <?php if($_SESSION['q23']==1){ echo "<a href='dingdanguanli.php'>未发货</a>";}?>
                   <?php if($_SESSION['q23']==1){ echo "<a href='dingdanguanli2.php'>已发货</a>";}?>
                   
                    <?php if($_SESSION['q24']==1){ echo "<a href='jiaoyijilu.php'>待匹配管理</a>";}?>
                    <?php if($_SESSION['q24']==1){ echo "<a href='jiaoyijilu2.php'>已匹配管理</a>";}?>
                        
                        <?php //if($_SESSION['q6']==1){ echo "<a href='yanseguanli.php'>颜色管理</a>";}?>         
                <!--    <?php if($_SESSION['q20']==1){ echo "<a href='dingdanguanli2.php'>积分订单管理</a>";}?>
                 <!--<?php if($_SESSION['q22']==1){ echo "<a href='leibieguanli.php'>类别管理</a>";}?>    
                  <?php if($_SESSION['q21']==1){ echo "<a href='tianjialeibie.php'>添加类别</a>";}?>  
                    <?php if($_SESSION['q20']==1){ echo "<a href='dingdanguanli3.php'>套餐订单管理</a>";}?>
                 -->    
                    </div>
                </li>
<!--                <li>
<?php if($_SESSION['zq9']==1){ echo "<a  href='#' class='first'>库存管理</a>";}?>

                    <div class="dropdown">
                   <?php if($_SESSION['q25']==1){ echo "<a href='rukudengji.php'>入库登记</a>";}?>
                   <?php if($_SESSION['q25']==1){ echo "<a href='rukuliebiao.php'>进销记录</a>";}?>
                    </div>
                </li>-->
            	<li>
<?php if($_SESSION['zq5']==1){ echo "<a href='#' class='first'>信息管理</a>";}?>
                	
                    <div class="dropdown">
                    <?php if($_SESSION['q26']==1){ echo "<a href='tianjiaxinwen.php'>添加新闻</a>";}?>
                    <?php if($_SESSION['q27']==1){ echo "<a href='xinwenguanli.php'>新闻管理</a>";}?>
                    
                    <?php if($_SESSION['q28']==1){ echo "<a href='lunbotu.php'>添加轮播图</a>";}?>
                    <?php if($_SESSION['q29']==1){ echo "<a href='lunboguanli.php'>轮播管理</a>";}?>
                        
                        <!--<?php if($_SESSION['q25']!==0){ echo "<a href='zhanneiduanxin.php'>站内短信</a>";}?> -->                   	
               
                    <!-- <?php if($_SESSION['q23']==1){ echo "<a href='zhanghu.php'>公司账户</a>";}?> -->
                 <!--     <?php if($_SESSION['q32']==1){ echo "<a href='shangchuanshipin.php'>添加视频</a>";}?> 
                    <?php if($_SESSION['q33']==1){ echo "<a href='shipinguanli.php'>视频管理</a>";}?>-->
                    </div>
                </li>
            	<li>
<?php if($_SESSION['zq6']==1){ echo "<a href='#' class='first'>系统设置</a>";}?> 
                	
                    <div class="dropdown">
                    <?php if($_SESSION['q30']==1){ echo "<a href='huiyuanshezhi.php'>会员设置</a>";}?> 
                    <?php if($_SESSION['q31']==1){ echo "<a href='quanxianshezhi2.php'>银行列表</a>";}?> 
                    <?php if($_SESSION['q32']==1){ echo "<a href='xitongcanshu.php'>系统参数</a>";}?> 
                    <?php if($_SESSION['q33']==1){ echo "<a href='quanxianshezhi.php'>权限管理</a>";}?>  
                               	
                    <!--
                 <?php if($_SESSION['q33']==1){ echo "";}?>      
                <?php if($_SESSION['q32']==0){ echo "<a href='dianziyoujian.php'>电子邮件</a>";}?>                        
                    -->
                                          
                        
                    </div>
                </li>
            	<li>
<?php if($_SESSION['zq7']==1){ echo "<a href='#' class='first'>数据管理</a>";}?>
                	
                    <div class="dropdown">
                        <!--<a href='memberadd.php'>虚拟数据</a>
                    <?php if($_SESSION['q24']==1){ echo "<a href='daorushuju.php'>导入数据</a>";}?>-->
                    <?php if($_SESSION['q34']==1){ echo "<a href='../databack/index.php'>数据备份</a>";}?>
                    <?php if($_SESSION['q35']==1){ echo "<a href='qingkongshuju.php'>清空数据</a>";}?>  
                   
                    </div>
                </li>
            </ul>
</div>