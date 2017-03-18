<?php

class loginController extends medoo
{
	function index()
	{
		$datas['title'] = '登陆';

		$this->display( $datas );
	}

	function login()
	{
		header("Content-type: text/html; charset=utf-8");
		$username = $_POST ['username' ];
		$password = $_POST ['password' ];
		$database = new login();
		$user_data = $database->get_user_info( $username );
		$user_info = $user_data[0];
		if ($user_info) {
			$realpass = md5($password);
			if ($realpass == $user_info['password']) {
				session_start();
				$_SESSION['user'] = $username;
				$_SESSION['pass'] = md5($realpass);
				echo "<script>";
		      	echo "window.location.href = '?c=admin'";
		      	echo "</script>";
			}
			else{	//密码错误
				echo "<script>";
				echo "alert('用户名或密码错误');";
		      	echo "window.location.href = '?c=login'";
		      	echo "</script>";
			}
		}
		else{	//用户名错误
			echo "<script>";
			echo "alert('用户名或密码错误');";
	      	echo "window.location.href = '?c=login'";
	      	echo "</script>";
		}
	}

	function logout()
	{
		session_start();
		session_unset();
		session_destroy();
		echo "<script>";
      	echo "window.location.href = '?c=login'";
      	echo "</script>";
	}
}