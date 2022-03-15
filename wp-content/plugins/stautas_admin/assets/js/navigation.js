
window.onload = function(){
	setActiveNavButton();
}


getUrlParams(window.location.href, "page");

function getUrlParams(url, paramKey){
	var url = new URL(url);
	var paramValue = url.searchParams.get(paramKey);
	return paramValue;
}



function setActiveNavButton(){
	var nav = document.getElementById("stautas-admin-nav");
	var menuItems = nav.getElementsByTagName("a");
	var urlParam = getUrlParams(window.location.href, "page");

	for(var i = 0; i < menuItems.length; i++){
		var linkParam = getUrlParams(menuItems[i].href, "page");
		if(urlParam == linkParam){
			menuItems[i].classList.add("active");
		}
	}
}