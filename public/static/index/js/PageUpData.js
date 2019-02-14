$(document).ready(function(){	
    if (window.XMLHttpRequest)
    {
        // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
        xmlhttp=new XMLHttpRequest();
    }
    else
    {    
        //IE6, IE5 浏览器执行的代码
        xmlhttp=new ActiveXObject("");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            var datas = JSON.parse(xmlhttp.responseText);
			var style= datas.style;
			var Pic_info= datas.Pic_info;
			var style_lable=$('#Pic_type');
			var image_frame=$('.image-frame');
			var Pic_a=new Array();
			var style_lable_a=new Array();
			for(var j=0;j<style.length;j++){    //循环添加标签
				style_lable_a[j]=document.createElement("a");
				$(style_lable_a[j]).text(style[j]);
				$(style_lable_a[j]).attr("href","ScreenPage.php?color='*'&style='"+style[j]+"'");
				$(style_lable).append(style_lable_a[j]);
			}
			
			for(var i=0;i<image_frame.length;i++){  //循环添加首页图片内容
				Pic_a[i]=document.createElement("a");
				$(Pic_a[i]).attr({
					"class":"galpop-info", 
					"data-galpop-group":Pic_info[i].Pic_type,
					"data-galpop-link":"Picture-Page.php?id="+Pic_info[i].Pic_id,
					"data-galpop-link-title":"Click Here For More Info",
					"data-galpop-link-target":"_blank",
					"title":"标签：暂无 ",
					"href":Pic_info[i].Big_Pic_url
				});
				$(Pic_a[i]).append('<img src="'+Pic_info[i].Small_Pic_url+'"/>');
				$(image_frame[i]).append(Pic_a[i]);
			}
			
			
			
        }
    }
    xmlhttp.open("POST","../Akalin/php/index_PageDataUp.php",false);
    xmlhttp.send();
});