/*
guopengcheng
2015-11-30
后台管理
*/
(function($){
	$.fn.jrdek=function(options){
		$.fn.jrdek.defaults={
			type:"tip", //方法名称,默认tip
			//左侧菜单参数
			foldCell:"", //折叠左侧菜单className
			//后台自适应浏览器窗口参数
			Mtop:"", //顶部的className
			Mleft:"", //左侧的className
			Mright:"", //右侧的className
			Mfooter:"" //底部的className
		};
		return this.each(function(){
			var opts = $.extend({},$.fn.jrdek.defaults,options);
			$(function(){
				//默认给定容器宽高
				function free(){
					var Width=$(window).width(); 
					var Height=$(window).height();
					var tWidth=$(opts.Mleft).innerWidth(); //左侧宽度
					var tHidth=$(opts.Mtop).innerHeight(); //top高度
					var bHidth=$(opts.Mfooter).innerHeight(); //底部高度
					$(opts.Mleft).css("height",(Height-tHidth-bHidth)+'px'); 
					$(opts.Mright).css("height",(Height-tHidth-bHidth-40)+'px');
					if($(opts.Mleft).is(":hidden")){
						$(opts.Mright).css("width",(Width)+'px');
					}else{
						$(opts.Mright).css("width",(Width-tWidth)+'px');
					}
				}
				free();
				Roll();
				//自适应浏览器窗口（适用于后台布局）
				//当浏览器宽高发生改变时给定容器宽高
				$(window).resize(function(){
					var fold =$(opts.Mleft).css("display"); //左侧菜单的display属性
					if(fold=="none"){
						free();
						$(opts.Mright).css("width",$(window).width()-40);
					}else{
						free();
					}
					Roll();
					return false;
				});
				//折叠左侧菜单
				$(opts.foldCell).on("click",function(){
					var fold =$(opts.Mleft).is(".min_w");
					if(fold==true){
						var movetxt = $(".min_w .menu_icon").parent();
						movetxt.off("mouseover");
						$(opts.Mleft).removeClass("min_w");
						free();
					}else{
						$(opts.Mleft).addClass("min_w");
						$(opts.Mright).css("width",$(window).width());
						minMenu();
						free();
					}
					return false;
				});
				//----折叠时提示
				function minMenu(){
					var movetxt = $(".min_w .menu_icon").parent("li");
					movetxt.mouseover(function(){
						var txt = $(this).find("a").text(),
							html = "<div class='out_txt'><i class='fa fa-caret-left'></i><span>"+txt+"</span></div>",
							appnum = $(this).find(".out_txt").length;
						if(appnum<=0){
							$(this).append(html).css("position","relative");
						}
					});
					movetxt.mouseout(function(){
						$(this).find(".out_txt").remove();
					});
				}
				//nav
				//$(opts.Mleft).hide(); //默认左侧菜单隐藏
				$(".top-nav li").on("click",function(){
					$("iframe[name='cont_box']").css("opacity","0");
                    showLoadding();
					var that = $(this),
						dataId = $(this).find("p").attr("data-id"),
						dataFast = $(this).find("p").attr("data-fast");
					/*普通方式，只是改变菜单的显示隐藏*/
					var flag = 0;
					if(dataFast!=undefined){
						$(".left-menu li").each(function(){
							if($(this).find("a").attr("data-fast")==dataFast&&flag<=0){
								$(this).show();
								$(this).addClass("curr").siblings().removeClass("curr");
								$(".main_right").find("iframe").prop("src",$(this).find("a").attr("data-href"));
								flag += 1;
							}else if($(this).find("a").attr("data-fast")==dataFast&&flag>0){
								$(this).show();
							}else{
								$(this).hide();
							}
						});
					}else{
						$(".left-menu li").each(function(){
							if($(this).find("a").attr("data-id")==dataId&&flag<=0){
								$(this).show();
								$(this).addClass("curr").siblings().removeClass("curr");
								$(".main_right").find("iframe").prop("src",$(this).find("a").attr("data-href"));
								flag += 1;
							}else if($(this).find("a").attr("data-id")==dataId&&flag>0){
								$(this).show();
							}else{
								$(this).hide();
							}
						});
					}
					$(this).addClass("curr").siblings().removeClass("curr");
					$(opts.Mleft).show();
					free();
					minMenu();
					return false;
				});
				//menu
				$("body").on("click",".left-menu li",function(){
					$("iframe[name='cont_box']").css("opacity","0");
                    showLoadding();
					$(this).addClass("curr").siblings().removeClass("curr");
					var dataHref = $(this).find("a").attr("data-href");
					$(opts.Mright).children().prop("src",dataHref);
				});
				//返回首页时
				$(".top-header .logo").click(function(){
					$(opts.Mleft).hide(); //左侧菜单隐藏
					$(".top-nav li").removeClass("curr");
					free();
					return false;
				});
				//nav roll
				//导航滚动
				function Roll(){
					$(".top-nav ul").css("width",parseInt($(".top-nav li").outerWidth())*parseInt($(".top-nav").find("li").length));
					var navW = $(".top-nav ul").width(),
						navL = $(".logo").outerWidth(),
						navR = $(".login_msg").outerWidth(),
						bodyW = $(window).width();
					if(bodyW<parseInt(navW)+parseInt(navL)+parseInt(navR)){
						var rollW = $(".top-nav_roll").outerWidth(),
							num = parseInt((parseInt(bodyW)-parseInt(navL)-parseInt(navR)-parseInt(rollW))/parseInt($(".top-nav li").outerWidth())),
							newW = parseInt($(".top-nav li").outerWidth())*num;
						$(".top-nav_roll").show();
						$(".top-nav").css("width",newW);
					}else{
						$(".top-nav_roll").hide();
						$(".top-nav").css("width",parseInt(bodyW)-parseInt(navL)-parseInt(navR));
					};
				};
				var offset = parseInt($(".top-nav ul").width())-parseInt($(".top-nav").width());
				$(window).resize(function(){
					offset = parseInt($(".top-nav ul").width())-parseInt($(".top-nav").width());
					if($(".top-nav ul").width()<=$(".top-nav").width()){
						$(".top-nav ul").animate({
			                left:"0px"
			            },300);
					}
				});
				function navLeft(){
					if($(".top-nav ul").position().left < 0){
						$(".top-nav_roll .f_left").off("click");
						$(".top-nav ul").animate({
			                left:$(".top-nav ul").position().left+parseInt($(".top-nav li").outerWidth())+"px"
			            },300,function(){
			            	$(".top-nav_roll .f_left").on("click",navLeft);
			            });
					}
				}
				function navright(){
					if($(".top-nav ul").position().left > -offset){
						$(".top-nav_roll .f_right").off("click");
						$(".top-nav ul").animate({
			                left:$(".top-nav ul").position().left+parseInt(-$(".top-nav li").outerWidth())+"px"
			            },300,function(){
			            	$(".top-nav_roll .f_right").on("click",navright);
			            });
					}
				}
				$(".top-nav_roll .f_left").click(function(){
					navLeft();
				});
				$(".top-nav_roll .f_right").click(function(){
					navright();
				});
			});
		});
	};
})(jQuery);



