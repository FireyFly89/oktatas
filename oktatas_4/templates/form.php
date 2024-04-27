<form method="POST" action="/" id="userForm" enctype="multipart/form-data">
    <div class='login-form'>
        <?php FormController::generateForm(); ?>
    </div>
    <input type="submit" value="Beküldés" />
</form>