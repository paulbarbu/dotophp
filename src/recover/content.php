<?php
/**
 * @file src/recover/content.php
 * @brief HTML for recover module
 * @author Paul Barbu
 *
 * @ingroup recoverFiles
 */

/**
 * @defgroup recoverFiles Recover module
 */

if(isset($feedback['recover']['recover']) || $feedback['recover'] === RECOVER_PROCESSED){
?>

<form action="" method="post">
<table border="0" cellspacing="5">
<tr><td colspan="2"><center><h4><?php echo $_SESSION['security_q']; ?></h4></center></td></tr>
<tr><td><label for="answer">Answer:</label></td><td><input tabindex="1" type="text" maxlength="255" id="answer" name="security_a" />
</td></tr>
<tr><td colspan="2" ><center>
<input type="submit" name="recover" value="Recover" tabindex="2" /></center>
</td></tr>
</table>
</form>

<?php
    if(is_numeric($feedback['recover']['recover'])){
        echo '<h3>';

        switch($feedback['recover']['recover']){
            case RECOVER_ERR_ANSWER: printf("Invalid answer! (#%d)", RECOVER_ERR_ANSWER);
                break;
            case RECOVER_ERR_NOT_SENT: printf('An error occurred while sending the email! (#%d)
                <br /> Please <a href="index.php?show=notreceived" >click here</a> to resend it!', RECOVER_ERR_NOT_SENT);
                break;
            case RECOVER_ERR_DB_C: printf('Error connecting to the database! (#%d)', RECOVER_ERR_DB_C);
                break;
            case RECOVER_ERR_DB: printf('A database related error occured, please contact the administrator! (#%d)', RECOVER_ERR_DB);
                break;
            case RECOVERED: printf('An email was sent to your address in order to re-activate your recovered account! (#%d)', RECOVERED);
                break;
        }
        echo '</h3>';
    }
}
else{
?>

<form action="" method="post">
<table border="0" cellspacing="5">
<tr><td>
    <label for="email">E-mail:</label></td><td><input id="email" type="text" name="email" maxlength="255" tabindex= "1" />
    </td></tr><tr><td colspan="2" ><center>
<input type="submit" name="proceed" value="Proceed" tabindex="2" /></center>
</td></tr>
</table>
</form>

<?php
    if(is_numeric($feedback['recover'])){
        echo '<h3>';

        switch($feedback['recover']){
            case RECOVER_ERR_NOUSER: printf("This email is not associated to any account! (#%d)", RECOVER_ERR_NOUSER);
                break;
            case RECOVER_ERR_INACTIVE: printf("The account you're trying to recover has not been activated yet! (#%d)", RECOVER_ERR_INACTIVE);
                break;
            case RECOVER_ERR_DB_C: printf('Error connecting to the database! (#%d)', RECOVER_ERR_DB_C);
                break;
            case RECOVER_ERR_DB: printf('A database related error occured, please contact the administrator! (#%d)', RECOVER_ERR_DB);
                break;
        }
        echo '</h3>';
    }
}
