<?php

namespace Luba\Controllers;

use Luba\Framework\Controller;
use Auth, Redirect;

class CMSAdminController extends Controller
{
	protected $actions = [
		'index',
		'login'
	];

	public function __construct()
	{
		if (!Auth::check())
			Redirect::to(url('auth/login'));
	}

	public function index()
	{
		
	}

	public function login()
	{
		
	}
}