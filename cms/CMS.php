<?php

namespace Luba\CMS;

use SQL;
use Flo\MySQL\Blueprint;

class CMS
{
	public static function getPageRoutes()
	{
		if (php_sapi_name() == 'cli')
		{
			return [];
		}

		$db = SQL::table('routes')->select('routes.route as route, pagetypes.name as name')->leftJoin('pagetypes', 'routes.pagetype_id', 'pagetypes.id')->get()->toArray();

		$routes = [];

		foreach ($db as $route => $pagetype)
		{
			$routes[$route] = "{§pagetype}Controller";
		}

		return $routes;
	}

	public static function createDatabaseStructure()
	{
		SQL::createBasic('routes', function(Blueprint $table){
			$table->string('route');
			$table->integer('pagetype_id', false, true);
			$table->integer('pagetype_content_id');
		});

		SQL::createBasic('pagetypes', function(Blueprint $table){
			$table->string('name');
		});
	}

	public static function fillDatabase()
	{
		
	}

	public function createPagetype($pagetype)
	{
		
	}
}