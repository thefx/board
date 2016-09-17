<?php

chdir('..');

//$f3->set('DEBUG',3);
//ini_set('display_errors','On');
//error_reporting('E_ALL');


// composer autoloader for required packages and dependencies
require_once('lib/autoload.php');

/** @var \Base $f3 */
$f3 = \Base::instance();

// Initialize CMS
$f3->config('app/config.ini');

// Define routes
$f3->config('app/routes.ini');

@ini_set('error_log',$f3->LOGS.'error.log');
@ini_set('expose_php', 'off');

// Execute application
$f3->run();
