<?php

namespace Luba\Controllers;

class HomePage extends Controller
{
	protected static $fields = [
		'text' => 'content',
		'string' => 'headline'
	];

	protected static $hasMany = [];

	protected static $manyMany = [];
}