<?php

namespace Luba\Commands;

use Luba\CMS\CMS;

class InitCMS extends Command
{
	public function run()
	{
		$filepath = __DIR__.'/../files/';

		print "Creating cache dirctory...\n";
		mkdir(storage_path('cmscache'));

		print "Copying new routes file...\n";
		copy("{$filepath}routes.php", base_path('routes.php'));


		print "Creating database structure...\n";
		CMS::createDatabaseStructure();

		print "Adding initial data...\n";
		CMS::fillDatabase();

		print "Creating new view structure...\n";
		unlink(view_path('home.lb'));
		unlink(view_path('master.lb'));
		copy("{$filepath}home.lb", view_path('pages/HomePage.lb'));
		copy("{$filepath}main.lb", view_path('main.lb'));
	}
}