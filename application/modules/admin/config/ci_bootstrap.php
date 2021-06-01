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
	'site_name' => 'Unilife',

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
	
	/*
	// Default scripts to embed at page head or end
	'scripts' => array(
		'head'	=> array(
			'assets/dist/admin/adminlte.min.js',
			'assets/dist/admin/lib.min.js',
			'assets/dist/admin/app.min.js'
		),
		'foot'	=> array(
		),
	),
	

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
			'assets/dist/admin/adminlte.min.css',
			'assets/dist/admin/lib.min.css',
			'assets/dist/admin/app.min.css'
		)
	),*/

	// Default scripts to embed at page head or end
	'scripts' => array(
		'head'	=> array(
			'assets/admin/js/jquery.min.js',
			'assets/admin/js/bootstrap.js',
			// 'assets/admin/js/bootstrap-select.min.js',
			'assets/admin/js/jquery.slimscroll.js',
			'assets/admin/js/jquery.inputmask.bundle.js',
			'assets/admin/js/sweetalert.min.js',
			'assets/admin/js/dialogs.js',
			'assets/admin/js/waves.js',
			/*'assets/admin/js/jquery.flot.js',
			'assets/admin/js/jquery.flot.resize.js',
			'assets/admin/js/jquery.flot.pie.js',*/
			'assets/admin/js/Chart.bundle.js',
			'assets/admin/js/admin.js',
			// 'assets/admin/js/demo.js',
			'assets/admin/js/jquery.validate.js',
			'assets/admin/js/jquery.steps.min.js',
			//'assets/admin/js/select2.min.js',
			'assets/admin/js/form-wizard.js',
			'assets/admin/js/advanced-form-elements.js',
			'assets/admin/js/bootstrap-tagsinput.js',
			'assets/admin/js/ckeditor/ckeditor.js',
			'assets/admin/js/bootstrap-material-datetimepicker/js/moment.js',
			'assets/admin/js/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
			'assets/admin/js/chosen.jquery.js',
			'assets/admin/js/viewer.min.js',
		),
		'foot'	=> array(
		),
	),

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
			'assets/admin/css/roboto.css',
			'assets/admin/css/fonts_popins.css',
			'assets/admin/css/material_icons.css',
			'assets/admin/css/bootstrap.css',
			//'assets/admin/css/bootstrap-select.min.css',
			'assets/admin/css/waves.css',
			'assets/admin/css/animate.css',
			'assets/admin/css/morris.css',
			'assets/admin/css/style.css',
			'assets/admin/css/all-themes.css',
			'assets/admin/css/mystyle.css',
			'assets/admin/css/sweetalert.css',
			//'assets/admin/css/select2.min.css',
			'assets/admin/css/bootstrap-tagsinput.css',
			'assets/admin/js/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
			'assets/admin/css/chosen.css',
			'assets/admin/css/viewer.min.css'
		)
	),

	// Default CSS class for <body> tag
	'body_class' => '',
	
	// Multilingual settings
	'languages' => array(
	),

	// Menu items
	'menu' => array(

		'dashbord' => array(
			'name'		=> 'Dashbord',
			'url'		=> '',
			'icon'		=> 'dashboard',
		),    


  		'users' => array(
			'name'		=> 'User management',
			'url'		=> 'users',
			'icon'		=> 'account_circle',
			'children'  => array(
				'Users'				=> 'users',
				'Deleted users'			=> 'users/deleted_users',
			)
		),

  		'application' => array(
			'name'		=> 'Category listing',
			'url'		=> 'application/category_listing',
			'icon'		=> 'domain_disabled',
			// 'children'  => array(
				// 'Categories'				=> 'application/category_listing',
				// 'Brands'					=> 'application/brands',
			// )
		),

  		'brands' => array(
			'name'		=> 'Brands',
			'url'		=> 'brands',
			'icon'		=> 'queue_play_next',
			'children'  => array(
				'Brands'						=> 'brands',
				'Redeem user list'				=> 'brands/redeem_user_list',
				'Brand banner'					=> 'brands/banner',
			)
		),

		'blog' => array(
			'name'		=> 'Blog ',
			'url'		=> 'blog',
			'icon'		=> 'analytics',
			'children'  => array(
				'Listing'						=> 'blog',
				'Create blog'					=> 'blog/create',
				'Banner Listing'				=> 'blog/banner',
			)
		),



  		'university' => array(
			'name'		=> 'University/School List',
			'url'		=> 'university',
			'icon'		=> 'school',
			'children'  => array(
				'List'						=> 'university',
				'Create'					=> 'university/create',
			)
		),


		/*'coupon' => array(
			'name'		=> 'Coupons',
			'url'		=> 'coupon',
			'icon'		=> 'qr_code',
			'children'  => array(
				'Listing'						=> 'coupon',
				'Create coupon'					=> 'coupon/create',
				'Redeem coupon'					=> 'coupon/redeem_coupon',
			)
		),
*/


		'groups' => array(
			'name'		=> 'Groups',
			'url'		=> 'groups',
			'icon'		=> 'invert_colors_off',
			'children'  => array(
				'Listing'						=> 'groups',
				'Create '					=> 'groups/create',
			)
		),

		'post' => array(
			'name'		=> 'Post Listing',
			'url'		=> 'post',
			'icon'		=> 'bar_chart',
			'children'  => array(
				'User Post'						=> 'post',
				'Admin Post '					=> 'post/admin',
			)
		),


		/*'social_media_post' => array(
			'name'		=> 'Social media post (Instagram)',
			'url'		=> 'social_media_post',
			'icon'		=> 'invert_colors_off',
			'children'  => array(
				'Listing'						=> 'social_media_post',
				'Create '					=> 'social_media_post/create',
			)
		),*/



		'report' => array(
			'name'		=> 'Report user & post lising',
			'url'		=> 'report',
			'icon'		=> 'bar_chart',
			'children'  => array(
				'Report User'						=> 'report',
				'Report Post '					=> 'report/post',
			)
		),


		'content_management' => array(
			'name'		=> 'Content Management',
			'url'		=> 'content_management',
			'icon'		=> 'contact_mail',
			'children'  => array(
				'About Us'						=> 'content_management/about/edit/1',
				'Contact Us '					=> 'content_management/contact',
				'Terms & Conditions '			=> 'content_management/terms/edit/1',
				'FAQ\'s'						=> 'content_management/faq',
				'Team'							=> 'content_management/team',
				'Feedback'						=> 'content_management/feedback',
			)
		),


		'api' => array(
        	'name'		=> 'Api ',
        	'url'		=> 'api',
        	'icon'		=> 'add_a_photo',
            	),


		'logout' => array(
			'name'		=> 'Sign Out',
			'url'		=> 'panel/logout',
			'icon'		=> 'input',
		)
	),

	// Login page
	'login_url' => 'admin/login',

	// Restricted pages
	
	'page_auth' => array(
		'useful_links'					=> array('webmaster', 'admin', 'manager'),
		'user'							=> array('webmaster', 'admin', 'manager'),
		'user/create'					=> array('webmaster', 'admin', 'manager'),
		'user/group'					=> array('webmaster', 'admin', 'manager'),
		'util'							=> array('webmaster'),
		'util/list_db'					=> array('webmaster'),
		'util/backup_db'				=> array('webmaster'),
		'util/restore_db'				=> array('webmaster'),
		'util/remove_db'				=> array('webmaster'),
	),

	// AdminLTE settings
	'adminlte' => array(
		'body_class' => array(
			'webmaster'	=> 'theme-light-green',
			'admin'		=> 'theme-light-green',
			'manager'	=> 'theme-light-green',
			'staff'		=> 'theme-light-green',
			'partner'	=> 'theme-light-green',
			'vendor'	=> 'theme-light-green',
			'branch'	=> 'theme-light-green',
		)
	),

	// Useful links to display at bottom of sidemenu
	'useful_links' => array(
		array(
			'auth'		=> array('webmaster', 'admin', 'manager', 'partner'),
			'name'		=> 'Frontend Website',
			'url'		=> '',
			'target'	=> '_blank',
			'color'		=> 'text-aqua'
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
$config['sess_cookie_name'] = 'ci_session_admin';
