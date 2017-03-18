<?php

class login extends medoo
{
	public function get_user_info( $username )
	{
		$datas = $this->select("shop_user", [
			"username",
			"password"
		], [
			"username[=]" => $username
		]);

		return $datas;
	}
}