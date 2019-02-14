//瀑布流脚本
window.onload=function(){
	waterfall('panel','box');
}
function waterfall(parent,box){   //瀑布流实现函数
	var oParent=document.getElementById(parent);
	var oBoxs=oParent.getElementsByClassName(box) || getByClass(oParent,box);
	var oBoxsW=oBoxs[0].offsetWidth;
	var cols=4;
	var hArr=[];
	for(var i=0;i<oBoxs.length;i++){
		if(i<4){
			hArr.push(oBoxs[i].offsetHeight)
		}else{
			var minH=Math.min.apply(null,hArr);
			var index=getMinhIndex(hArr,minH);
			oBoxs[i].style.position='absolute';
			oBoxs[i].style.top=minH+'px';
			oBoxs[i].style.left=oBoxsW*index+'px';
			hArr[index]+=oBoxs[i].offsetHeight;
		}
	}
}
function getByClass(parent,clsName){  //旧版ie通过类名获取元素
	var boxArr=new Array();
	var oElements=parent.getElementsByTagName('*');
	for(var i=0;i<oElements.length;i++){
		if(oElements[i].className==clsName){
			boxArr.push(oElements[i]);
		}
	}
	return boxArr;
}
function getMinhIndex(arr,val){   //获取整列高度最小列的下标
	for(var i in arr){
		if(arr[i]==val)
			return i;
	}
}

