<?php

	use Reinink\Utils\Config;

	/*
	|--------------------------------------------------------------------------
	| Bundle setup
	|--------------------------------------------------------------------------
	*/

		// Set default page
		Config::set('admin::default_page', '/admin/leads');

		// Set the company name displayed in the control panel
		Config::set('admin::company', 'Control Panel');

	/*
	|--------------------------------------------------------------------------
	| Users
	|--------------------------------------------------------------------------
	*/

		Config::$values['admin::users'] = array
		(
			array('username' => 'admin', 'password' => 'password')
		);