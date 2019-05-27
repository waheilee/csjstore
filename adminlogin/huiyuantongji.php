<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>会员统计</title>
<link rel="stylesheet" type="text/css" href="css/lanrenzhijia.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/jihuohuiyuan.css">
<script src="js/jquery.js"></script>
<script src="js/lanrenzhijia.js"></script>
<script src="js/heightLine.js"></script>
<script src="js/index.js"></script>
<script>
if(((navigator.userAgent.indexOf('iPhone') > 0) || (navigator.userAgent.indexOf('Android') > 0) && (navigator.userAgent.indexOf('Mobile') > 0) && (navigator.userAgent.indexOf('SC-01C') == -1))){
document.write('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">');
}                                         
</script>
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->

<script type="text/javascript">
		<?php
			include("admin_check.php");
			include_once("../function.php");
			session_start();
header("Content-Type: text/html;charset=utf-8");
			//checkqx(3,10);
			$_Month[13];
			$y=date("Y");
			for ($i=1;$i<=12;$i++){
				$sql="SELECT * FROM `systemyeji` WHERE year(ydate)=".$y." and month(ydate)=".$i."";
				$query=mysql_query($sql);
				if(mysql_num_rows($query) >= 1){
					$sql1="SELECT sum(xzhy) FROM `systemyeji` WHERE year(ydate)=".$y." and month(ydate)=".$i." order by id desc";
					$query1=mysql_query($sql1);
					$mm=mysql_fetch_array($query1);
					$sql2="SELECT zhy FROM `systemyeji` WHERE year(ydate)=".$y." and month(ydate)=".$i." order by id desc";
					$query2=mysql_query($sql2);
					$mm2=mysql_fetch_array($query2);
					$_Month[$i]=array($mm[0],$mm2[0]);
				}else{
					$_Month[$i]=array(0,0);
				}
			}
		?>
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: '会员统计'
            },
            subtitle: {
                text: '单位/人'
            },
            xAxis: {
                categories: [
                    '1月',
                    '2月',
                    '3月',
                    '4月',
                    '5月',
                    '6月',
                    '7月',
                    '8月',
                    '9月',
                    '10月',
                    '11月',
                    '12月'
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                }
            },
            legend: {
                layout: 'vertical',
                backgroundColor: '#FFFFFF',
                align: 'left',
                verticalAlign: 'top',
                x: 100,
                y: 70,
                floating: true,
                shadow: true
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.x +': '+ this.y +' 人';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
                series: [{
                name: '新增人数',
                data: [<?=$_Month[1][0]?>, <?=$_Month[2][0]?>, <?=$_Month[3][0]?>, <?=$_Month[4][0]?>, <?=$_Month[5][0]?>, <?=$_Month[6][0]?>, <?=$_Month[7][0]?>, <?=$_Month[8][0]?>, <?=$_Month[9][0]?>, <?=$_Month[10][0]?>, <?=$_Month[11][0]?>, <?=$_Month[12][0]?>]
    
            }, {
                name: '总人数',
                data: [<?=$_Month[1][1]?>, <?=$_Month[2][1]?>, <?=$_Month[3][1]?>, <?=$_Month[4][1]?>, <?=$_Month[5][1]?>, <?=$_Month[6][1]?>, <?=$_Month[7][1]?>, <?=$_Month[8][1]?>, <?=$_Month[9][1]?>, <?=$_Month[10][1]?>, <?=$_Month[11][1]?>, <?=$_Month[12][1]?>]
    
            }]
        });
    });
    
});
		</script>

</head>
<body>
<div >
	
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
			</div>
<div class="mainBox">
            	<script src="../js/highcharts.js"></script>
<script src="../js/exporting.js"></script>
<div id="container" style="min-width: 400px; max-width: 900px; height: 400px; margin: 0 auto"></div>
                
                
                
            </div> 
</div>			
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>

</body>
</html>