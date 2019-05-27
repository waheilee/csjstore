$(function(){
	
	/*手机端侧栏开始*/
	$("#gHeader .menu").toggle(function(){
		$("#gHeader").animate({"margin-left":190},300)
		$("#main #sideBar").animate({"margin-left":0},300)
		$("#main #conts").animate({"margin-left":190},300)
		
		
	},function(){
		$("#gHeader").animate({"margin-left":0},300)
		$("#main #sideBar").animate({"margin-left":-190},300)
		$("#main #conts").animate({"margin-left":0},300)
		
	})
	/*手机端侧栏结束*/
	
	
	
	/*侧栏下拉开始*/
	$("#main #sideBar li .first").toggle(function(){
		$(this).siblings(".dropdown").slideDown()
		$(this).addClass("on")
		
	},function(){
		$(this).siblings(".dropdown").slideUp()
		$(this).removeClass("on")
		
	})

	
	
	
	/*侧栏下拉结束*/
	
	/*订单管理开始*/
	$("#main #conts .mainBox .table table").hide()
	$("#main #conts .mainBox .table table").first().show()
	$("#main #conts .mainBox .table li").click(function(){
		$(this).addClass("on").siblings().removeClass("on")
		var index=$(this).index()
		$("#main #conts .mainBox .table table").eq(index).show().siblings().hide()
		return false;
	})
	
	
	
	
})