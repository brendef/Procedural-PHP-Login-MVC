<div class="container">
    <h4>Log In</h4>
    <form method="post">
        <div class="mb-3">
            <label for="InputEmail" class="form-label">Username / Email address</label>
            <input type="text" class="form-control" name="user" value="<?php echo $user; ?>" id="InputEmail">
        </div>
        <div class="mb-3">
            <label for="InputPassword" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" value="<?php echo $_POST['password']; ?>" id="InputPassword">
        </div>
        
        <!-- Fetches login error from the "login_functions.php" page -->
        <p class="text-danger"><?php echo getLoginError(); ?></p>

        <!-- Clicking button calles the if statement "isset($_POST['login_submit]) from "login_model.php"  -->
        <button type="submit" name="login_submit" class="btn btn-dark">Log In</button>
    </form>
</div>