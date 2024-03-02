<form method="POST" action="/" id="userForm" enctype="multipart/form-data">
    <div class='login-form'>
        <?php
        $formHandler = new FormHandler();
        $formHandler->generateForm('userForm', 'json', 'definitions');

        /*
        getInputTemplate("username", "text", "Felhasználónév");
        getInputTemplate("email", "email", "E-mail");
        getInputTemplate("password", "text", "Jelszó");
        getInputTemplate("phone_country", "text", "Telefonszám", "", false);
        getInputTemplate("phone", "text", "");
        getInputTemplate("country", "text", "Ország");
        getInputTemplate("city", "text", "Város");
        getInputTemplate("house", "text", "Házszám");
        getInputTemplate("street", "text", "Utca");*/
        ?>
        <!--<input type="file" name="file">-->
    </div>
    <input type="submit" value="Beküldés" />
</form>
