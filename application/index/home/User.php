<?php

namespace app\index\home;

use app\index\home\Base;

class User extends Base
{
	public function register()
	{
		return $this->fetch();
	}
}