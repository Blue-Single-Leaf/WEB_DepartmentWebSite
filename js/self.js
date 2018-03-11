var $ = jQuery.noConflict();
$(function() {
$('#tabsmenu').tabify();
$(".toggle_container").hide(); 
$(".trigger").click(function(){
	$(this).toggleClass("active").next().slideToggle("slow");
	return false;
});
});

function confir(){
	var key=document.getElementsByName("manage")[0];
	var skey=key.innerHTML;
	switch(skey){
		case "文章管理列表":
		var word="你确定删除该文章？";
		break;
		case "程序管理列表":
		var word="你确定删除该程序？";
		break;
		case "软件管理列表":
		var word="你确定删除该软件？";
		break;
		case "图片管理列表":
		var word="你确定删除该图片？";
		break;
	}
	if(confirm(word)){
		return true;
	}
	else {
		return false;
	}
	
}

function check(form){
	var key=document.getElementsByName("manage")[0];
	var skey=key.innerHTML;
	switch(skey){
		case "文章管理列表":
		if (form.title.value==""){
		alert("标题不能为空！");form.title.focus();return false;
	}
	if (form.author.value==""){
		alert("作者不能为空！");form.author.focus();return false;
	}
	if (form.description.value==""){
		alert("简介不能为空！");form.description.focus();return false;
	}
		break;
		case "程序管理列表":
		
		break;
		case "软件管理列表":
		if (form.AppName.value==""){
		alert("软件名不能为空！");form.AppName.focus();return false;
	}
	if (form.description.value==""){
		alert("介绍不能为空！");form.description.focus();return false;
	}
		break;
		case "图片管理列表":
		var word="你确定删除该图片？";
		break;
	}
	
}
function pagelist(){
	var manage=document.getElementsByName("manage");
	var five_page=document.getElementById("five_page");
	var ten_page=document.getElementById("ten_page");
	var add_article=document.getElementById("add_article");
	
	five_page.style.display="none";
	ten_page.style.display="block";
	add_article.style.display="none";
	manage[0].style.display="block";
	
}
function org(){
	var manage=document.getElementsByName("manage");
	var five_page=document.getElementById("five_page");
	var ten_page=document.getElementById("ten_page");
	var add_article=document.getElementById("add_article");
	
	five_page.style.display="block";
	ten_page.style.display="none";
	add_article.style.display="block";
	manage[0].style.display="block";
	
}

function a_a(){
	var manage=document.getElementsByName("manage");
	var five_page=document.getElementById("five_page");
	var ten_page=document.getElementById("ten_page");
	var add_article=document.getElementById("add_article");
	
	five_page.style.display="none";
	ten_page.style.display="none";
	add_article.style.display="block";
	manage[0].style.display="none";
	
}// JavaScript Document