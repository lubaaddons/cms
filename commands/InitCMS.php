<?php

namespace Luba\Commands;

use Luba\CMS\CMS;

class InitCMS extends Command
{
	public function run()
	{
		$filepath = __DIR__.'/../files/';

		print "Copying new routes file...\n";
		copy("{$filepath}routes.php", base_path('routes.php'));


		print "Creating database structure...\n";
		CMS::createDatabaseStructure();

	}
}