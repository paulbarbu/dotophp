<?php
/**
 * @file src/activate/content.php
 * @brief HTML for the activate module
 * @author Paul Barbu
 *
 * @ingroup activateFiles
 */

if($feedback['activate']){
?>
<form method="post" action="" >
<table border="0" cellspacing="5">
<tr><td>
<label for="code">Activation code:</label></td><td><input type="text" maxlength="10"
 name="code" id="code" <?php isset($_GET['code']) ? list($_GET['code']) = filterInput($_GET['code']) : NULL;
echo isset($_GET['code']) && !empty($_GET['code']) ? 'value="' . $_GET['code'] . '" disabled' : 'tabindex="1"' ?> />
</td></tr><tr><td>
<label for="pass">Password:</label></td><td><input tabindex="2" type="password" maxlength="30" id="pass" name="pass" />
</td></tr><tr><td>
<label for="passconfirm">Confirm password:</label></td><td><input tabindex="3" type="password" maxlength="30" id="passconfirm" name="passconfirm" />
</td></tr><tr><td>
<label for="question">Security question:</label></td><td><input tabindex="4" type="text" maxlength="255" id="question" name="security_q" />
</td></tr><tr><td>
<label for="answer">Security answer:</label></td><td><input tabindex="5" type="text" maxlength="255" id="answer" name="security_a" />
</td></tr><tr><td colspan="2"><center>
<input tabindex="6" type="submit" value="Activate!" name="activate" />
<input tabindex="7" type="reset" name="reset" value="Reset" />
</center></td></tr>
</table>
</form>
<?php
    if(is_numeric($feedback['activate'])){
        echo '<h3>';

        switch($feedback['activate']){
            case A_ERR_PASS: printf('Passwords don\'t match or aren\'t between 6 and 30 valid characters! (#%d)', A_ERR_PASS);
                break;
            case A_ERR_CODE: printf('Invalid activation code! (#%d)', A_ERR_CODE);
                break;
            case A_ERR_DB_CONNECTION: printf('Error connecting to the database! (#%d)', A_ERR_DB_CONNECTION);
                break;
            case A_ERR_SECURITY_DATA: printf('The question and the answer bust be between 8 and 255 valid characters long! (#%d)', A_ERR_SECURITY_DATA);
                break;
            case A_ERR_DB: printf('A database related error occured, please contact the administrator! (#%d)', A_ERR_DB);
                break;
        }

        echo '</h3>';
    }
}
elseif(!$feedback['activate']){
    echo '<h3>Account activated!</h3>';
}
