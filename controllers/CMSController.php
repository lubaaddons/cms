<?php

namespace Luba\Controllers;

use Luba\Framework\Controller as BaseController;

class CMSController extends BaseController
{
	protected $actions = [
		'index'
	];

	protected $data;

	protected static $fields = [];

	protected static $hasMany = [];

	protected static $manyMany = [];

	public function __construct()
	{
		
	}

	public function index()
	{
		
	}

	public static function fields()
	{
		return static::$fields;
	}

	public static function hasMany()
	{
		return static::$hasMany;
	}

	public static function manyMany()
	{
		return static::$manyMany;
	}
}