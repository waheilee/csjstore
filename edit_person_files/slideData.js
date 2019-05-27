(function($){
    $.fn.slideData = function (options) {
		var slideHeight=0;
		var sum=0;
        var _this = $(this);
		var opts;
        var defaults = {
			"dataline":"",
			"slideTime":2,
			"data": "",
        };
        return _this.each(function () {
            opts = $.extend({}, defaults, options);	
			_this.find("li").hide().end().find("li:lt("+opts.dataline+")").show();
			AjaxData();
		})
			
		function AjaxData(){
			var responseData="";
            for (var i = 0; i < opts.data.length; i++) {
                 responseData += "<li>"+opts.data[i] + "</li>";
            }
            _this.children("ul").append(responseData);
			InitHeight(_this,opts.dataline);
			dataSlideMove(_this,opts.dataline,opts.slideTime,_this.find("li").length);
			        
             
			}
			
			function InitHeight(obj,n){
			obj.height(obj.find("li").eq(0).outerHeight()*n);
			
			}
		  function dataSlideMove(obj,n,s,total){
				  var slideTimeOut=setInterval(function(){
						  if(sum>=(total-n)){
							 
							  sum=0;
							  clearInterval(slideTimeOut);
							  AjaxData();
							  }
						  slideHeight+=obj.find("li").eq(0).outerHeight();
						  obj.find("li").eq(0).animate({opacity:0});
						  obj.children("ul").animate({"top":"-"+slideHeight+"px"},function(){
						  obj.find("li").eq(0).remove();
						  slideHeight=0;
						  obj.children("ul").css("top","0px");
							  })
						  sum++;
					  },s*1000);
			  }
    } 
	})(jQuery)