window.onload=function(){
	waterfall('panel','box');
	window.onscroll=function(){
		if(checkScrollSlide){
		   //填写添加图片的代码
		}
		waterfall('panel','box');
	}
};

function checkScrollSlide(){     //检查是否需要往下加载图片
	var oParent=document.getElementById('panel');
	var oBoxs=document.getElementsByClassName('box') || getByClass(oParent,'box');
	var lastBoxH=oBoxs[oBoxs.length-1].offsetTop+Math.floor(oBoxs[oBoxs.length-1].offsetHeight/3);
	var scrollTop=document.body.scrollTop || document.documentElement.scrollTop;
	var wHeighr=document.body.clientHeight || document.documentElement.clientHeight;
	return (lastBoxH<scrollTop+wHeighr)?true:false;
};
