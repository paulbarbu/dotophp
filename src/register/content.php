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
<table align="center" border=0 cellspacing=5>
<tr><td>
    <fieldset id="req">
    <legend>Required information</legend>
    <table border=0>
    <tr><td>

    <label for="f_n">First name:</label></td><td><input id="f_n" type="text" name="first_name" maxlength=10 />
    </td></tr><tr><td>
    <label for="l_n">Last name:</label></td><td><input id="l_n" type="text" name="last_name" maxlength=10 />
    </td></tr><tr><td>
    <label for="nick">Nickname:</label></td><td><input id="nick" type="text" name="nick" maxlength=20 />
    </td></tr><tr><td>
    <label for="email">E-mail:</label></td><td><input id="email" type="text" name="email" maxlength=255 />
    </td></tr><tr><td>
    <label for="tz">Timezone:</label></td><td><select id="tz" name="timezone">
        <?php arrayToOption(array_values($tz), array_values($tz)); ?>
    </select>
    </td></tr><tr><td>
    <label for="country">Country:</label></td><td><select id="country" name="country">
        <?php arrayToOption(array_values($countries), array_keys($countries)); ?>
    </select>
    </td></tr><tr><td>
    <label for="city">City:</label></td><td><input id="city" type="text" name="city" maxlength=30 />
    </td></tr><tr><td>

    </td></tr>
    </table>
    </fieldset>

</td><td>

    <fieldset id="opt">
    <legend>Optional information</legend>
    <table border=0>
    <tr><td>

    <label for="priv">Private account:</label></td><td><input id="priv" type="checkbox" name="private" value="1" />
    </td></tr><tr><td>
    <label for="sm">Male</label><br />
    <label for="sf"> Female</label></td><td>
    <input type="radio" name="sex" value="M" id="sm" /><br />
    <input type="radio" name="sex" value="F" id="sf" />
    </td></tr><tr><td>
    <label for="phone">Phone:</label></td><td><input id="phone" type="text" name="phone" maxlength=20 />
    </td></tr><tr><td><label for="bday">Birth date:</label></td><td><input type="text" id="bday" value="DD-MM-YYYY" name="birthday" maxlength=10 />
    </td></tr><tr><td>
    <label for="desc">Description:</label></td><td><textarea rows="3" cols="23" name="description" maxlength=100 id="desc" ></textarea>
    </td></tr><tr><td>

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
            case R_ERR_NAME: printf('The eneterd name is invalid! (#%d)', R_ERR_NAME);
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
            case R_ERR_DB: printf('A database error occured, please contact the administrator! (#%d)', R_ERR_DB);
                break;
        }

        echo '</h3>';
    }
}
elseif(!$feedback['register']){
    echo '<h3>Registration complete, an activation email was sent to the submitted address!</h3>';
}
