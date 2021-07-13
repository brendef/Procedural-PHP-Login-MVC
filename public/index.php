<?php
// Define the application folder and set the path
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../app'));

// Replace slashed with DS
const DS = DIRECTORY_SEPARATOR;

// All static includes
include(APPLICATION_PATH . DS . 'config' . DS . 'config.php');

// Global Functions
include($config['LIB_PATH'] . 'functions.php');

// Connect to database 
$connection = create_database_connection();

// Get current page in header
$page = get('page', 'home');

// Load PHP Logic
$model = $config['MODEL_PATH'] . $page . '_model.php';

// Load Page
$view  = $config['VIEW_PATH'] . $page . '.php';

// Load 404 if view doesn't exist
$_pagenotfound  = $config['VIEW_PATH'] . 'pagenotfound.php';

// Start a session
session_start();

// Load the PHP logic if it exists
if (file_exists($model)) {
    include($model);
}

// Load the relevant page in the view
$app = $_pagenotfound;
if (file_exists($view)) {
    $app = $view;
}

// Load page header
include($config['INCLUDE_PATH'] . 'header.php'); 

// Display page template / layout
include($config['VIEW_PATH'] . 'layout.php');