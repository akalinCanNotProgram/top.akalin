//实现浮动定位导航
	$(document).ready(function(){                  //浏览器加载完成后执行
		$(window).scroll(function(){                 //监听浏览器滑动
			var top=$(document).scrollTop();         //浏览器滑块滑动的距离
			var menu=$("#menu");
			var currentId = "";
			var partsArray = new Array();
			partsArray[0]=$("#recommendation")
			partsArray[1]=$("#screen")
			partsArray[2]=$("#computer")
			partsArray[3]=$("#mobile")
			partsArray[4]=$("#ipad")

			for(var i=0;i<partsArray.length;i++){
				var m = partsArray[i];
				var partTop = m.offset().top;
				if(top > partTop-200){
					currentId = "#" + m.attr("id");
				}else{
					continue;
				}
			};
			var currentOld = menu.find(".current");
			if(currentId && currentOld.attr("href") != currentId){
				currentOld.removeClass("current");
				menu.find("[href=" + currentId + "]").addClass("current");
			};
			
		});
	});

//点击滑动到相应的地方
	$('#index').click(function () {
$('html, body').animate({
scrollTop: $($.attr(this, 'href')).offset().top
}, 500);
return false;
});

	$('#filter').click(function () {
$('html, body').animate({
scrollTop: $($.attr(this, 'href')).offset().top
}, 500);
return false;
});

	$('#cpt').click(function () {
$('html, body').animate({
scrollTop: $($.attr(this, 'href')).offset().top
}, 500);
return false;
});

	$('#cellphone').click(function () {
$('html, body').animate({
scrollTop: $($.attr(this, 'href')).offset().top
}, 500);
return false;
});

	$('#tablet').click(function () {
$('html, body').animate({
scrollTop: $($.attr(this, 'href')).offset().top
}, 500);
return false;
});
