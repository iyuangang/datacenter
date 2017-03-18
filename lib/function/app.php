<?php

function check_login()
{
	session_start();
	if (isset($_SESSION['user']) || isset($_SESSION['pass'])) {}
	else{
		echo "<script>";
      	echo "window.location.href = '?c=login'";
      	echo "</script>";
	}
}