<form method="POST" action="/" id="userForm" enctype="multipart/form-data">
    <div class='login-form'>
        <?php FormController::generateForm('userForm', 'json', 'definitions'); ?>
    </div>
    <input type="submit" value="Beküldés" />
</form>