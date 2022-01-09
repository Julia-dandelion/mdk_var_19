

function productInTrash(id){
	
	var query = "?product=" + id; // передаём параметры через адресную строку
	var protocol = "http://localhost";
	var host = "/mdk_var_19-main";
	var resourcePath = "/trash.php";
	var uri = protocol + host + resourcePath + query;
	
	var xhr = new XMLHttpRequest(); //создаём новый экземляр объекта
		
		//метод запроса, адрес URL ресурса, асинхроность/синхроность
		xhr.open("GET", uri, true);//aсинхроно
		
		xhr.onreadystatechange = function() {
			
			if(xhr.readyState == 4 && xhr.status == 200) {
				
				var res = xhr.responseText;
				var a = document.getElementById("trash-menu-txt").innerHTML = "Корзина - " + res + " товар"; // меню в заголовке
			}
		}
		
		//отпрака параметров через адресную строку
		xhr.send();// поэтому здесь пусто
}