
# PHP Login & Register Procedural MVC

PHP application with a MVC folder structure that dynamically loads the necessary view, models and functions.

## Installation

Clone this repository 

1.
```bash
git clone https://github.com/brendef/php_login_mvc.git
```

2.
Create database using database script included (database.sql)

## Usage
1. Connect to database
```PHP
function create_database_connection() {
        $servername = "localhost"; // Your Server or website domain
        $username = "root"; // Database user
        $password = ""; // Your Database user's password
        $databasename = "mvc"; // The Name of your the database

        // Connection variable to be used throughout the application to access the database
        $connection = mysqli_connect($servername, $username, $password, $databasename) or die("Error No. " . mysqli_connect_errno() . ": " . mysqli_connect_error());

        return $connection;

        // Display connection errors on screen 
        if (mysqli_connect_errno()) {
            echo "Failed to connect to database " . mysqli_connect_errno() . ': Message: ' . mysqli_connect_error();
        }
    }
```
2. Change all header() functions to point to a relevant location in your app.
```PHP
header('Location:?page=register&error=loginStatementFailed');
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)