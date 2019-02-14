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
			var panel=$('#panel');
			var Pic_a=new Array();
			var Pic_box=new Array();
			var Pic_box_pic=new Array();
			
			for(var i=0;i<datas.length;i++){  //循环添加首页图片内容
				Pic_a[i]=document.createElement("a");
				Pic_box[i]=$("<div class=box></div>");
				Pic_box_pic[i]=$("<div class=pic></div>");
				$(Pic_a[i]).attr({
					"class":"galpop-info", 
					"data-galpop-group":"Recommend",
					"data-galpop-link":"Picture-Page.php?id="+datas[i].Pic_id,
					"data-galpop-link-title":"Click Here For More Info",
					"data-galpop-link-target":"_blank",
					"title":"标签：暂无 ",
					"href":datas[i].Big_Pic_url
				});
				$(Pic_a[i]).append('<img src="'+datas[i].Middle_Pic_url+'"/>');				
				$(Pic_box_pic[i]).append(Pic_a[i]);
				$(Pic_box[i]).append(Pic_box_pic[i]);
				$(panel).append(Pic_box[i]);
			}			
        }
    }
    xmlhttp.open("POST","../Akalin/php/Recommend_PageDataUp.php",false);
    xmlhttp.send();
});