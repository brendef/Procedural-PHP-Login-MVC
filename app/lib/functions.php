<?php

    // Get the page loaded in the header
    function get($name, $default = '') {
        return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $default;
    }

    // get the current active page (for navbar)
    function is_active($page, $current_link)
    {
        return $page == $current_link ? 'active' : '';
    }

    // Connect to the database
    function create_database_connection()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $databasename = "mvc";
        $connection = mysqli_connect($servername, $username, $password, $databasename) or die("Error No. " . mysqli_connect_errno() . ": " . mysqli_connect_error());

        return $connection;
        if (mysqli_connect_errno()) {
            echo "Failed to connect to database " . mysqli_connect_errno();
        }
    }
