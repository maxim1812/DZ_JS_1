<?php

$GLOBALS["dataBase"] = "b3";

function getLink()
{
	$link = mysqli_connect( 'localhost', 'root'); 
	return $link;
}

function isLoginInDataBase($login)
{
	$link = getLink();
	mysqli_select_db($link, $GLOBALS["dataBase"]);
	
	$s = "select u1 from u where u1 = '{$login}';";
	
	$result = mysqli_query($link, $s);
	$flag = false;
	
	while( $row = mysqli_fetch_row($result) )
	{
		$flag = true;
	}
	
	mysqli_close($link); 

	return $flag;
}

function correctLoginAndPassword($login,$password)
{
	$link = getLink();
	mysqli_select_db($link, $GLOBALS["dataBase"]);
	
	$s = "select u1,u2 from u where u1 = '{$login}' and u2 = '{$password}';";
	
	$result = mysqli_query($link, $s);
	$flag = false;
	
	while( $row = mysqli_fetch_row($result) )
	{
		$flag = true;
	}
	
	mysqli_close($link); 

	return $flag;
}

function registrateUser($login, $password)
{
	$link = getLink();
	mysqli_select_db($link, $GLOBALS["dataBase"]);	
	$s = "insert into u (u1,u2) values ('{$login}','{$password}');";
	$result = mysqli_query($link, $s);	
	mysqli_close($link); 
}

?>