<?php

require "phpFunctions.php";

if( isset($_REQUEST['login']) == false )
{
	echo "Error";
	die("");
}

if( isset($_REQUEST['password']) == false )
{
	echo "Error";
	die("");
}

$login = $_REQUEST['login'] . "";
$password = $_REQUEST['password'] . "";

if(isLoginInDataBase($login) == true)
{
	echo "Error";
	die("");
}

registrateUser($login, $password);

echo "Complete";

?>