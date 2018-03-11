
function confir(){
	var a1=document.getElementById("ob_type");
	
		if (a1.innerHTML=="文章列表"){
		var word="你确定删除此文章？";
		}
		else  if(a1.innerHTML=="程序列表"){
		var word="你确定删除此程序？";
		}
		else if(a1.innerHTML== "软件列表"){
		var word="你确定删除此软件？";
		}
		else if(a1.innerHTML=="图片列表"){
		var word="你确定删除此图片？";
		}
		else {
		var word="你确定删除此用户？";
		}
		
	if(confirm(word)){
		return true;
	}
	else {
		return false;
	}	
}
function submit_confirm(){
	var ch=document.getElementsByName("checkBoxs[]");
	var y=0;
	for (var i=0;i<ch.length;i++){
		if(ch[i].checked){
			y++;
		}
	}
	if (y==0){
		var a1=document.getElementById("ob_type");
	
		if (a1.innerHTML=="文章列表"){
		var word="请先选择文章!";
		}
		else  if(a1.innerHTML=="程序列表"){
		var word="请先选择程序!";
		}
		else if(a1.innerHTML== "软件列表"){
		var word="请先选择软件!";
		}
		else if(a1.innerHTML=="图片列表"){
		var word="请先选择图片!";
		}
		else {
		var word="请先选择用户!";
		}
		alert(word);return false;
	}
	else {
		var a1=document.getElementById("ob_type");
	
		if (a1.innerHTML=="文章列表"){
		var word="你确定删除选中的文章？";
		}
		else  if(a1.innerHTML=="程序列表"){
		var word="你确定删除选中的程序？";
		}
		else if(a1.innerHTML== "软件列表"){
		var word="你确定删除选中的软件？";
		}
		else if(a1.innerHTML=="图片列表"){
		var word="你确定删除选中的图片？";
		}
		else {
		var word="你确定删除选中的用户？";
		}
		if(confirm(word)){
			
			return true;
		}
		else{
			return false;
		}
	}
}
function allselect(){
	var ch=document.getElementsByName("checkBoxs[]");
	/*alert("als");*/
	var con=document.getElementById("allselect");
	/*alert(con);*/
	if (con.innerHTML=="全选"){
		for (var i=0;i<ch.length;i++){
			ch[i].checked=true;
		}
		con.innerHTML="全不选";
	}
	else {
		for (var i=0;i<ch.length;i++){
			ch[i].checked=false;
		}
		con.innerHTML="全选";
	}
			
}
