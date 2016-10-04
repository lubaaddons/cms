<?php

namespace Luba\Commands;

use SQL;

class BuildTables extends Command
{
	public function run()
	{
		$controllers = array_diff(scandir(base_path('controllers')), ['.', '..']);

		foreach ($controllers as $name)
		{
			$name = str_replace('.php', '', $name);
			$controllername = "Luba\Controllers\\$name";

			$fields = $controllername::fields();

			if (!SQL::tableExists($name))
			{
				SQL::createBasic($name, function($table) use ($fields){
					foreach ($fields as $name => $type)
					{
						$table->$type($name);
					}
				});

				SQL::table('pagetypes')->insert(['name' => $name]);

				echo "\033[32m Created $name table.\n";

				foreach ($fields as $col => $type)
				{
					echo "\033[32m $name table: Added '$col' column ($type)\n";
				}
			}
			else
			{
				//echo "No changes made to $name table\n";
				$columns = SQL::table($name)->getColumns();
				$fieldarray = $fields;

				foreach ($columns as $column)
				{
					if (isset($fieldarray[$column->Field]))
						unset($fieldarray[$column->Field]);
				}

				foreach ($fieldarray as $col => $type)
				{
					SQL::alter($name, function($table) use ($type, $col){
						$table->$type($col);
					});

					echo "\033[32m $name table: Added '$col' column ($type)\n";
				}

				$c = $columns;

				foreach ($columns as $column)
				{
					$dbfield = $column->Field;

					if ($dbfield == 'created_at' or $dbfield == 'updated_at' or $dbfield == 'id')
						continue;

					if (isset($fields[$dbfield]) === false)
					{
						SQL::alter($name, function($table) use ($dbfield){
							$table->dropColumn($dbfield);
						});

						echo "\033[31m $name table: Dropped '$dbfield' column\n";
					}
				}

				if (empty($fieldarray))
					echo "No changes made to $name table\n";
			}
		}
	}
}