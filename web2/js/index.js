$(function(){
		$("#gFooter ul li a").click(function(){
			$(this).parent("li").addClass("on")
		})	
		
		//继续购物
		$("#main .mainBox .list1 li").click(function(){
			$(this).addClass("on").siblings("li").removeClass("on")	
		})
	
	
	
})