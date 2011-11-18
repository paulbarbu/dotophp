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

if(is_numeric($feedback['recover']) && $feedback['recover'] == RECOVER_PROCESSED){
    var_dump($_SESSION);
    //TODO: Here be secutiry_* form
}
else{
?>
<form action="" method="post">
<table border="0" cellspacing="5">
<tr><td>
    <label for="email">E-mail:</label></td><td><input id="email" type="text" name="email" maxlength="255" tabindex= "2" />
    </td></tr><tr><td colspan="2" ><center>
<input type="submit" name="proceed" value="Proceed" tabindex="3" /></center>
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
        }
        echo '</h3>';
    }
}
