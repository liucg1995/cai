<?php
class Sign extends AdminBase{
	public $title='签到管理';
	public $pageSize=15;
	
	public final function index(){
		$this->action='sendlist';
		$this->display('sign/index.php');
	}

	public final function signlist(){
		$this->display('sign/list.php');
	}


}