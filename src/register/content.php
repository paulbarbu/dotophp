<?php
/**
 * @file src/register/content.php
 * @brief HTML file for the register module
 * @author Paul Barbu
 *
 * @ingroup registerFiles
 */

/**
 * Country list
 */
$countries = require_once __DIR__ . DIRECTORY_SEPARATOR .  '..'
            . DIRECTORY_SEPARATOR . 'countries.php';

/**
 * Time-zones list
 */
$tz = require_once __DIR__ . DIRECTORY_SEPARATOR .  '..'
            . DIRECTORY_SEPARATOR . 'tz.php';

if($feedback['register']){
?>

<form action="" method="post">
<table align="center" border="0" cellspacing="5">
<tr><td>
    <fieldset id="req">
    <legend>Required information</legend>
    <table border="0">
    <tr><td>

    <label for="f_n">First name:</label></td><td><input id="f_n" type="text" name="first_name" maxlength="10"
 <?php echo isset($_POST['first_name']) ? 'value="' . $_POST['first_name'] . '"' : NULL ?> />
    </td></tr><tr><td>
    <label for="l_n">Last name:</label></td><td><input id="l_n" type="text" name="last_name" maxlength="10"
 <?php echo isset($_POST['last_name']) ? 'value="' . $_POST['last_name'] . '"' : NULL ?> />
    </td></tr><tr><td>
    <label for="nick">Nickname:</label></td><td><input id="nick" type="text" name="nick" maxlength="20"
 <?php echo isset($_POST['nick']) ? 'value="' . $_POST['nick'] . '"' : NULL ?> />
    </td></tr><tr><td>
    <label for="email">E-mail:</label></td><td><input id="email" type="text" name="email" maxlength="255"
 <?php echo isset($_POST['email']) ? 'value="' . $_POST['email'] . '"' : NULL ?> />
    </td></tr><tr><td>
    <label for="tz">Timezone:</label></td><td><select id="tz" name="timezone">
        <?php arrayToOption(array_values($tz), array_values($tz), isset($_POST['timezone']) ? $_POST['timezone'] : 'Please select your timezone!'); ?>
    </select>
    </td></tr><tr><td>
    <label for="country">Country:</label></td><td><select id="country" name="country">
        <?php arrayToOption(array_values($countries), array_keys($countries), isset($_POST['country']) ? $_POST['country'] : 'Please select your country!'); ?>
    </select>
    </td></tr><tr><td>
    <label for="city">City:</label></td><td><input id="city" type="text" name="city" maxlength="30"
 <?php echo isset($_POST['city']) ? 'value="' . $_POST['city'] . '"' : NULL ?> />
    </td></tr>
    </table>
    </fieldset>

</td><td>

    <fieldset id="opt">
    <legend>Optional information</legend>
    <table border="0">
    <tr><td>

    <label for="priv">Private account:</label></td><td><input id="priv" type="checkbox" name="private" value="1"
 <?php echo isset($_POST['private']) ? 'checked="checked"' : NULL ?> />
    </td></tr><tr><td>
    <label for="sm">Male</label><br />
    <label for="sf"> Female</label></td><td>
    <input type="radio" name="sex" value="M" id="sm"
 <?php echo isset($_POST['sex']) && $_POST['sex'] == 'M'? 'checked="checked"' : NULL ?> /><br />
    <input type="radio" name="sex" value="F" id="sf"
 <?php echo isset($_POST['sex']) && $_POST['sex'] == 'F'? 'checked="checked"' : NULL ?> />
    </td></tr><tr><td>
    <label for="phone">Phone:</label></td><td><input id="phone" type="text" name="phone" maxlength="20"
 <?php echo isset($_POST['phone']) ? 'value="' . $_POST['phone'] . '"' : NULL ?> />
    </td></tr><tr><td><label for="bday">Birth date:</label></td><td><input type="text" id="bday" name="birthday" maxlength="10"
 <?php echo isset($_POST['birthday']) ? 'value="' . $_POST['birthday'] . '"' : 'value="' . DATE_TOUSER . '"' ?> />
    </td></tr><tr><td>
    <label for="desc">Description:</label></td><td><textarea rows="3" cols="23" name="description" id="desc">
<?php echo isset($_POST['description']) ? $_POST['description'] : NULL ?></textarea>
    </td></tr>

    </table>
    </fieldset>

</td></tr></table>

<center>
<fieldset>
<legend>Security code</legend>
<label for="captcha">Please enter the security code shown in the image<br />
<img src="index.php?show=captcha" alt="Captcha"/></label><br />
 <input id="captcha" type="text" name="captcha" />
</fieldset>

<input type="submit" name="register" value="Register" />
<input type="reset" name="reset" value="Reset" />
</center>
</form>
<?php
    if(is_numeric($feedback['register'])){
        echo '<h3>';

        switch($feedback['register']){
            case R_ERR_CAPTCHA: printf('Captcha code entered is invalid! (#%d)', R_ERR_CAPTCHA);
                break;
            case R_ERR_DB_CONNECTION: printf('Error connecting to the database! (#%d)', R_ERR_DB_CONNECTION);
                break;
            case R_ERR_NAME: printf('The entered name is invalid! (#%d)', R_ERR_NAME);
                break;
            case R_ERR_NICK: printf('The nickname must contain only letters, numbers, dashes or underscores! (#%d)', R_ERR_NICK);
                break;
            case R_ERR_EMAIL: printf('E-mail address entered is not valid! (#%d)', R_ERR_EMAIL);
                break;
            case R_ERR_CITY: printf('The city name can consist of letters only! (#%d)', R_ERR_CITY);
                break;
            case R_ERR_DESC: printf('Invalid symbols used in the description! (#%d)', R_ERR_DESC);
                break;
            case R_ERR_PHONE: printf('The phone field can contaion only numbers, parentheses, salshes or dashes! (#%d)', R_ERR_PHONE);
                break;
            case R_ERR_BDATE: printf('The birthdate must have the following format: DD-MM-YYYY! (#%d)', R_ERR_BDATE);
                break;
            case R_ERR_DB: printf('A database related error occured, please contact the administrator! (#%d)', R_ERR_DB);
                break;
            case R_ERR_TZ: printf('Please select your timezone! (#%d)', R_ERR_TZ);
                break;
            case R_ERR_COUNTRY: printf('Please select your country! (#%d)', R_ERR_COUNTRY);
                break;
            case R_ERR_USED_NICK: printf('The nickname is already in use! (#%d)', R_ERR_USED_NICK);
                break;
            case R_ERR_USED_MAIL: printf('The e-mail is already in use! (#%d)', R_ERR_USED_MAIL);
                break;
            case R_ERR_NOT_SENT: printf('An error occurred while sending the email! (#%d)
                <br /> Please <a href="index.php?show=notreceived" >click here</a> to resend it!', R_ERR_NOT_SENT);
                break;
        }

        echo '</h3>';
    }
}
elseif(!$feedback['register']){
    echo '<h3>Registration complete, an activation email was sent to the submitted e-mail address!</h3>';
}
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
