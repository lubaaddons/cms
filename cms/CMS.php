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
		
		foreach ($db as $route)
		{
			$routes[$route->route] = $route->name;
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

		SQL::table('routes')->insert(['route' => 'admin', 'pagetype_id' => 1]);
		SQL::table('pagetypes')->insert(['name' => 'CMSAdminController']);

		SQL::table('routes')->insert(['route' => 'auth', 'pagetype_id' => 2]);
		SQL::table('pagetypes')->insert(['name' => 'CMSAuthController']);
	}

	public static function buildPagetypes()
	{

	}

	public function createPagetype($pagetype)
	{
		
	}

	public static function addInitialData()
	{
		$homepageid = SQL::table('HomePage')->insert(['content' => 'A CMS for the Luba Framework', 'headline' => 'Luba CMS']);
		$pagetypeid = SQL::table('pagetypes')->where('name', 'HomePage')->first()->id;
		SQL::table('routes')->insert(['route' => '/', 'pagetype_id' => $pagetypeid, 'pagetype_content_id' => $homepageid]);
	}
}