<?php

namespace Luba\Controllers;

use Luba\Framework\Controller as BaseController;
use Luba\Framework\URL;
use SQL;

class CMSController extends BaseController
{
	protected $actions = [
		'index'
	];

	protected $data;

	protected static $fields = [];

	protected static $hasMany = [];

	protected static $manyMany = [];

	protected $template = NULL;

	public function __construct()
	{
		$uri = URL::getInstance()->uri();
		$pagetype = SQL::table('routes')->leftJoin('pagetypes', 'routes.pagetype_id', 'pagetypes.id')->where('routes.route', $uri)->first();
		$this->data = SQL::table($pagetype->name)->find($pagetype->pagetype_content_id);
		
		$this->template = $this->template ?: "pages.{$pagetype->name}";
	}

	public function index()
	{
		return $this->render(NULL);
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

	public function render($template, array $variables = [])
	{
		return parent::render($this->template, $this->data->toArray() + $variables);
	}
}