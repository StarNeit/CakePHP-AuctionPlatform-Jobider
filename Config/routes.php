<?php

/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	//Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
       Router::connect('/', array('controller' => 'home', 'action' => 'index'));
       Router::connect('/read_more', array('controller' => 'home', 'action' => 'read_more'));
       Router::connect('/logout', array('controller' => 'login', 'action' => 'logout'));
        Router::connect('/aboutus', array('controller' => 'pages', 'action' => 'aboutus',));
        Router::connect('/examples', array('controller' => 'pages', 'action' => 'examples',));
        Router::connect('/termsofuse', array('controller' => 'pages', 'action' => 'termsofuse',));
        Router::connect('/feedback', array('controller' => 'pages', 'action' => 'feedback',));
        Router::connect('/careers', array('controller' => 'pages', 'action' => 'careers',));
        Router::connect('/press', array('controller' => 'pages', 'action' => 'press',));
        Router::connect('/community', array('controller' => 'pages', 'action' => 'comunity',));
        Router::connect('/trustandsafety', array('controller' => 'pages', 'action' => 'trustandsafety',));
        Router::connect('/contacthelp', array('controller' => 'pages', 'action' => 'contacthelp',));
        Router::connect('/termsofservices', array('controller' => 'pages', 'action' => 'termsofservices',));
        Router::connect('/clientmanuals', array('controller' => 'pages', 'action' => 'clientmanuals',));
        Router::connect('/privacy', array('controller' => 'pages', 'action' => 'privacy',));
        Router::connect('/tools', array('controller' => 'pages', 'action' => 'tools',));
        Router::connect('/clientresource', array('controller' => 'pages', 'action' => 'clientresource',));
        Router::connect('/howitworks', array('controller' => 'pages', 'action' => 'howitworks',));
        Router::connect('/services', array('controller' => 'pages', 'action' => 'services',));
        Router::connect('/contactus', array('controller' => 'pages', 'action' => 'contactus',));
        Router::connect('/client_policies', array('controller' => 'pages', 'action' => 'client_policies',));
        Router::connect('/freelancer_policies', array('controller' => 'pages', 'action' => 'freelancer_policies',));
        Router::connect('/client_guidelines', array('controller' => 'pages', 'action' => 'client_guidelines',));
        Router::connect('/Cookies_policy', array('controller' => 'pages', 'action' => 'Cookies_policy',));
        Router::connect('/freelancer_guidelines', array('controller' => 'pages', 'action' => 'freelancer_guidelines',));
        Router::connect('/Hourly_rates', array('controller' => 'pages', 'action' => 'Hourly_rates',));
        Router::connect('/benefits', array('controller' => 'pages', 'action' => 'benefits',));
        Router::connect('/career', array('controller' => 'careers', 'action' => 'career',));
        Router::connect('/partner', array('controller' => 'partners', 'action' => 'partner'));
        Router::connect('/marketing', array('controller' => 'enterprisesolutions', 'action' => 'marketing'));
        Router::connect('/marketing', array('controller' => 'enterprisesolutions', 'action' => 'marketing'));
        Router::connect('/Human_Recources', array('controller' => 'enterprisesolutions', 'action' => 'Human_Recources'));
        Router::connect('/Procurement', array('controller' => 'enterprisesolutions', 'action' => 'Procurement'));
        Router::connect('/operation', array('controller' => 'enterprisesolutions', 'action' => 'operation'));
        Router::connect('/certified_program_concultants', array('controller' => 'enterprisesolutions', 'action' => 'certified_program_concultants'));
//////////Footer Routing//////////////
 Router::connect('/findjobs', array('controller' => 'findfreelancer', 'action' => 'findjobs'));
 Router::connect('/professional_category', array('controller' => 'findfreelancer', 'action' => 'professional_category'));
 Router::connect('/professional_skills', array('controller' => 'findfreelancer', 'action' => 'professional_skills'));
 Router::connect('/professional_country', array('controller' => 'findfreelancer', 'action' => 'professional_country'));
 Router::connect('/login/GooglePlus', array('controller' => 'login', 'action' => 'GooglePlus'));
 /* ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/webadmin', array('controller' => 'login', 'action' => 'index','prefix'=>'webadmin','webadmin'=>true));
	
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
