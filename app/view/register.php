<div class="container">
    <h4>Register</h4>
    <form method="post">
        <div class="mb-3">
            <label for="Inputusername" class="form-label">Username</label>
            <input name="username" value="<?php echo $_POST['username'] ?>" type="text" class="form-control" id="Inputusername" aria-describedby="usernameHelp">
        </div>
        <div class="mb-3">
            <label for="InputEmail" class="form-label">Email address</label>
            <input name="email" type="email" value="<?php echo $_POST['email'] ?>" class="form-control" id="InputEmail" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="InputPassword" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="InputPassword">
        </div>
        <div class="mb-3">
            <label for="InputPasswordConfirm" class="form-label">Confirm Password</label>
            <input name="confirm_password" type="password" class="form-control" id="InputPasswordConfirm">
        </div>
        <p class="text-danger"> <?php echo getRegisterError() ?> </p>
        <button type="submit" name="register_submit" class="btn btn-dark">Register</button>
    </form>
</div>