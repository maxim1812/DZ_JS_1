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

if(correctLoginAndPassword($login,$password) == false)
{
	echo "Error";
	die("");
}

setcookie('login', $login );
setcookie('password', $password);

echo "Complete"

?>