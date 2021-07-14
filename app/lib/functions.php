<?php

    // Get the page loaded in the header
    function get($name, $default = '') {
        return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $default;
    }

    // Get the current active page (for navbar)
    function is_active($page, $current_link)
    {
        return $page == $current_link ? 'active' : '';
    }

    // Connect to the database
    function create_database_connection()
    {
        $servername = "localhost"; // Server or website domain
        $username = "root"; // Database user
        $password = ""; // Database user's password
        $databasename = "mvc"; // Name of the database

        // Connection variable to be used throughout the application to access the database
        $connection = mysqli_connect($servername, $username, $password, $databasename) or die("Error No. " . mysqli_connect_errno() . ": " . mysqli_connect_error());

        return $connection;

        // Display connection errors on screen 
        if (mysqli_connect_errno()) {
            echo "Failed to connect to database " . mysqli_connect_errno() . ': Message: ' . mysqli_connect_error();
        }
    }
