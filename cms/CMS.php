<?php

namespace Luba\CMS;

use SQL;
use Flo\MySQL\Blueprint;

class CMS
{
	public static function getPageRoutes()
	{
		
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
}