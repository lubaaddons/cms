<?php

namespace Luba\Controllers;

class HomePage extends Controller
{
	protected static $fields = [
		'content' => 'text',
		'headline' => 'string'
	];

	protected static $hasMany = [];

	protected static $manyMany = [];
}