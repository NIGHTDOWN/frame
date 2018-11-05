window.onload = function(){
	size();
	window.addEventListener("resize",size,false);
	window.addEventListener("orientationchange",size,false);	
	function size(){
		var html = document.getElementsByTagName('html')[0];
		var pageWidth = html.getBoundingClientRect().width;
		pageWidth = pageWidth > 640 ? 640 : pageWidth;
		html.style.fontSize = pageWidth / 64 + "px";		
	}
};