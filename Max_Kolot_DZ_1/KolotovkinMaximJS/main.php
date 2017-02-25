<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title id = 'myTitle'>Добро пожаловать</title>
	
	<style>
		body
		{
			padding-left: 30px;
			padding-right: 30px;
			padding-top: 15px;
			padding-bottom: 30px;
		}
	</style>
</head>
<body>

<h1 id = 'myHeader'>Добро пожаловать</h1>
<hr>
<br>


<div id = "registerAndLogIn">
	<form>
		<b><p>Логин и пароль могут состоять только из строчных латинских букв и цифр.</p></b>
		
		<p>Логин</p>
		<input type = 'text' name = 'my_login' id = 'my_login' placeholder = 'maxim123' maxlength = '25' size = '35'>
		<br>
		
		<p>Пароль</p>
		<input type = 'password' name = 'my_password' id = 'my_password' placeholder = 'g23cv45re' maxlength = '25' size = '35'>
		<br>
		
		<br>
		<br>
		
		<input type = 'button' id = 'goToAccount' value = 'Войти в аккаунт' onclick = "goToAccountFunction()">
		<input type = 'button' id = 'goToRegistration' value = 'Зарегистрироваться в системе' onclick = "goToRegistrationFunction()">
		
		<br>
		<br>
		<br>
		<div id = "forError"></div>
		<br>
	</form>
</div>

<script>

var my_login;
var my_password;
var forError;

window.onload = function()
{
	my_login = document.getElementById('my_login');
	my_password = document.getElementById('my_password');
	forError = document.getElementById('forError');
}

function isNumber(c)
{
	const s = "0123456789";
	if(s.indexOf(c) == -1) 
		return false;
	else
		return true;
}

function isLittleChar(c)
{
	const s = "abcdefghijklmnopqrstuvwxyz";
	if(s.indexOf(c) == -1) 
		return false;
	else
		return true;
}

function controlString(s)
{
	if(s.length == 0) return "Поле ввода пусто.";
	
	let n = s.length;
	
	for(let i = 0; i < n; ++i)
	{
		let c = s.charAt(i);		
		if( isNumber(c) == false && isLittleChar(c) == false) return "В поле ввода содержатся запретные символы.";
	}
	
	return "OK";
}

function registerUser(s1,s2)
{
	var r = new XMLHttpRequest();
	r.open("POST","scr1.php?login=" + s1 + "&password=" + s2);
	r.setRequestHeader("Content-Type","text/plain;charset=UTF-8");
	r.send(null);
	r.onreadystatechange = function()
	{
		if(r.readyState === 4 && r.status === 200) 
		{
			let s = r.responseText + "";
			
			if(s == "Complete")
				forError.innerHTML = "Регистрация прошла успешно.";
			else
				forError.innerHTML = "Ошибка. Пользователь с таким логином уже есть в БД.";
		}
	}
}

function goToAccount(s1,s2)
{
	var r = new XMLHttpRequest();
	r.open("POST","scr2.php?login=" + s1 + "&password=" + s2);
	r.setRequestHeader("Content-Type","text/plain;charset=UTF-8");
	r.send(null);
	r.onreadystatechange = function()
	{
		if(r.readyState === 4 && r.status === 200) 
		{
			let s = r.responseText + "";
			
			if(s == "Complete")
			{
				document.getElementById('registerAndLogIn').innerHTML = "<h2>Вы вошли как пользователь " + s1 + "</h2>";
				document.getElementById('myHeader').innerHTML = "Мой профиль";
				document.getElementById('myTitle').innerHTML = "Мой профиль";
			}
			else
				forError.innerHTML = "Ошибка. Неверный логин или пароль.";
		}
	}
}

function goToRegistrationFunction()
{
	let s1 = my_login.value;
	let s2 = my_password.value;
	let err;
	
	err = controlString(s1);
	if(err != "OK")
	{
		forError.innerHTML = err;
		return;
	}
	
	err = controlString(s2);
	if(err != "OK")
	{
		forError.innerHTML = err;
		return;
	}
	
	forError.innerHTML = "";

	registerUser(s1,s2)
}

function goToAccountFunction()
{
	let s1 = my_login.value;
	let s2 = my_password.value;
	let err;
	
	err = controlString(s1);
	if(err != "OK")
	{
		forError.innerHTML = err;
		return;
	}
	
	err = controlString(s2);
	if(err != "OK")
	{
		forError.innerHTML = err;
		return;
	}
	
	forError.innerHTML = "";

	goToAccount(s1,s2);
}

</script>

<body>
</html>