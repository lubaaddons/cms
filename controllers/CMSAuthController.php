<?php

namespace Luba\Controllers;

use Luba\Framework\Controller;

class CMSAuthController extends Controller
{
	protected $get_actions = ['login'];

	protected $post_actions = ['postlogin'];

	public function login()
	{
		$form = $this->loginform();
	}

	public function postlogin()
	{
		$form = $this->loginform();

		if (!$form->validate())
			return Redirect::to(url('auth/login'));

		return Redirect::to(url('admin'));
	}

	public function loginform()
	{
		$form = new \Form(url('auth/postlogin'));
		$form->text('username')->label('Username')->required();
		$form->password('password')->label('Password')->required();

		return $form;
	}
}