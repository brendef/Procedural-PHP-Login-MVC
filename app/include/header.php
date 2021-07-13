<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Page title dynamically rendered -->
    <title><?php echo $page ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Title Brand</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <!-- Navbar Links -->
                    <a class="nav-link" href="/">Home</a>
                    <?php
                    // Check if user is logged in by looking for the id in the session variable
                    if (isset($_SESSION['users_id'])) {
                        echo "<a class='nav-link' href='?page=profile'>Profile</a>";
                        echo "<a class='nav-link' href='?page=logout'> Logout</a>";
                    } else {
                        echo "<a class='nav-link' href='?page=login'>Log In</a>";
                        echo "<a class='nav-link' href='?page=register'>Register</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>