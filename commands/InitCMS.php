<?php

namespace Luba\Commands;

use Luba\CMS\CMS;

class InitCMS extends Command
{
	public function run()
	{
		$filepath = __DIR__.'/../files/';

		print "Creating cache dirctory...\n";

		if (!is_dir(storage_path('cmscache')))
			mkdir(storage_path('cmscache'));

		print "Copying new routes file...\n";
		copy("{$filepath}routes.php", base_path('routes.php'));


		print "Creating database structure...\n";
		CMS::createDatabaseStructure();

		print "Adding initial data...\n";
		//CMS::fillDatabase();

		print "Creating new view structure...\n";

		if (file_exists(view_path('home.lb')))
			unlink(view_path('home.lb'));

		if (file_exists(view_path('master.lb')))
			unlink(view_path('master.lb'));

		if (!is_dir(view_path('pages')))
			mkdir(view_path('pages'));

		copy("{$filepath}home.lb", view_path('pages/HomePage.lb'));
		copy("{$filepath}main.lb", view_path('main.lb'));

		print "Creating Controllers...\n";

		if (file_exists(base_path('controllers/Controller.php')))
			unlink(base_path('controllers/Controller.php'));
		copy("{$filepath}HomePage.php", base_path('controllers/HomePage.php'));

		parent::exec("BuildTables");
	}
}