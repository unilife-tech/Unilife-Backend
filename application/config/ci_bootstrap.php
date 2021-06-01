<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| CI Bootstrap 3 Configuration
| -------------------------------------------------------------------------
| This file lets you define default values to be passed into views 
| when calling MY_Controller's render() function. 
| 
| See example and detailed explanation from:
| 	/application/config/ci_bootstrap_example.php
*/

$config['ci_bootstrap'] = array(

	// Site name
	'site_name' => 'Vegetable',

	// Default page title prefix
	'page_title_prefix' => '',

	// Default page title
	'page_title' => '',

	// Default meta data
	'meta_data'	=> array(
		'author'		=> '',
		'description'	=> '',
		'keywords'		=> ''
	),

	// Default scripts to embed at page head or end
	'scripts' => array(
		'head'	=> array(
			
			'assets/frontend/js/jquery-3.1.1.min.js?v=2.1',
			'assets/frontend/js/jquery-ui.min.js?v=2.1',	
			'assets/frontend/js/jquery.ui.touch-punch.js?v=2.1',			 
			  'assets/frontend/js/menu.js?v=2.1',
			  // 'assets/frontend/js/slider.js',
			  'assets/frontend/js/jquery.flexslider.js?v=2.1',
			  'assets/frontend/js/jquery.zoom.js?v=2.1',
			  'assets/frontend/js/sweetalert.min.js?v=2.1',
			  /*'assets/frontend/js/rangeslider.min.js',*/
			  'assets/admin/js/chosen.jquery.js?v=2.1',
			'assets/admin/js/viewer.min.js?v=2.1'
			  // 'assets/frontend/js/flickity-docs.min.js'
			  
		),
		'foot'	=> array(
			/*'assets/dist/frontend/lib.min.js',
			'assets/dist/frontend/app.min.js'*/

		),
	),

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
			/*'assets/dist/frontend/lib.min.css',
			'assets/dist/frontend/app.min.css',*/
			'assets/frontend/css/style.css?v=1.1',
			'assets/frontend/css/flexslider.css?v=1.1',
			'assets/frontend/css/sweetalert.css?v=1.1',
			/*'assets/frontend/css/rangeslider.css',*/
			'assets/admin/css/chosen.css?v=1.1',
			'assets/admin/css/viewer.min.css?v=1.1'
			// 'assets/frontend/css/jquery.elevatezoom.js.css'
			
		)
	),

	// Default CSS class for <body> tag
	'body_class' => '',
	
	// Multilingual settings
	'languages' => array(
		/* 'default'		=> 'en',
		'autoload'		=> array('general'),
		'available'		=> array(
			'en' => array(
				'label'	=> 'English',
				'value'	=> 'english'
			),
			'ar' => array(
				'label'	=> 'العربية',
				'value' => 'arabic'
			)
			'zh' => array(
				'label'	=> '繁體中文',
				'value'	=> 'traditional-chinese'
			),
			'cn' => array(
				'label'	=> '简体中文',
				'value'	=> 'simplified-chinese'
			),
			'es' => array(
				'label'	=> 'Español',
				'value' => 'spanish'
			)

		)*/
	),

	// Google Analytics User ID
	'ga_id' => '',

	// Menu items
	'menu' => array(
		'home' => array(
			'name'		=> 'Home',
			'url'		=> '',
		),
	),

	// Login page
	'login_url' => '',

	// Restricted pages
	'page_auth' => array(
	),

	// Email config
	'email' => array(
		'from_email'		=> '',
		'from_name'			=> '',
		'subject_prefix'	=> '',
		
		// Mailgun HTTP API
		'mailgun_api'		=> array(
			'domain'			=> '',
			'private_api_key'	=> ''
		),
	),

	// Debug tools
	'debug' => array(
		'view_data'	=> FALSE,
		'profiler'	=> FALSE
	),
);

/*
| -------------------------------------------------------------------------
| Override values from /application/config/config.php
| -------------------------------------------------------------------------
*/
$config['sess_cookie_name'] = 'ci_session_frontend';