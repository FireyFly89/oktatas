<form method="POST" action="/" enctype="multipart/form-data">
    <div class='login-form'>
        <label for="username">Felhasználónév</label>
        <input id="username" class="username" type="text" name="username" value="<?php echo !empty($_POST['username']) ? $_POST['username'] : '' ?>" />
        <span class="form-errors"><?php echo getError('username'); ?></span>

        <label for="password">Jelszó</label>
        <input id="password" class="password" type="text" name="password" value="<?php echo !empty($_POST['password']) ? $_POST['password'] : '' ?>" />
        <span class="form-errors"><?php echo getError('password'); ?></span>
        <!--<input type="file" name="file">-->
    </div>
    <input type="submit" value="Beküldés" />
</form>
