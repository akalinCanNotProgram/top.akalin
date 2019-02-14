// function searchClick(){
// 	var obj_lis = $(".suggest ul li");
// 	for(i=0;i<obj_lis.length;i++){
//         obj_lis[i].onclick = function(){
//             $(".search-input").val(this.innerHTML);
//         }
//     }
// }

function searchClick(li){
	console.log('正在隐藏选项。。。')
    $(".search-input").val(li.innerHTML);
    $(".suggest").hide();
    // alert('已隐藏')

}

function check(form) {
 
          if(form.pic_label.value=='') {
                alert("请输入搜索内容!");
                form.pic_label.focus();
                return false;
           }
         return true;
         }

$(".search-input").blur(
	function(){
		if($(".suggest ul li").length==0 || $(".search-input").val()==null || $(".search-input").val()==""){
			$(".suggest").hide();
		}
	}
)
$(".search-input").focus(
	function(){
		if($(".suggest ul li").length>0){
			$(".suggest").show();
		}else{
			$(".suggest").hide();
		}
	}
)
$(".search-input").keyup(
	function(){
		if($(".search-input").val()!=null && $(".search-input").val()!=""){
				var panel=$('#search-suggest ul');
					$(panel).empty();  			
				$.ajax({
					type:'get',
					url:'search',
					data:$('.search-input').serialize(),
					dataType:'json',
					success:function(result){
						// console.log(result.suggestions.length);
						if(result.statu){
							// var suggestions=result.suggestions;
							$(panel).empty();
							for(var i=0;i<result.suggestions.length;i++){
								$(panel).append("<li onclick='searchClick(this)'>"+result.suggestions[i]+"</li>");
								// alert(result.suggestions);
							}
						}else{
							$(panel).append('<li>没有搜到相关结果！</li>');
						}
					}
				})
			$(".suggest").show();
			
		}
	}
)