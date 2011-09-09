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

    <label for="priv">Private account:</label></td><td><input id="priv" type="checkbox" name="private" />
    </td></tr><tr><td>
    <label for="sm">Male</label><br />
    <label for="sf"> Female</label></td><td>
    <input type="radio" name="sex" value="M" id="sm" checked="checked" /><br />
    <input type="radio" name="sex" value="F" id="sf" />
    </td></tr><tr><td>
    <label for="phone">Phone:</label></td><td><input id="phone" type="text" name="phone" maxlength=20 />
    </td></tr><tr><td><label for="bday">Birthdate:</label></td><td><input type="text" id="bday" value="ZZ-LL-AAAA" name="birthday" maxlength=10 />
    </td></tr><tr><td>
    <label for="desc">Description:</label></td><td><textarea rows="3" cols="23" name="description" maxlength=100 id="desc" ></textarea>
    </td></tr><tr><td>

    </table>
    </fieldset>

</td></tr></table>

<center>
<fieldset>
<legend>Security code</legend>
<label for="captcha">Please enter the security code shown in the image</label><br />
<img src="index.php?show=captcha" alt="Captcha"/><br />
 <input id="captcha" type="text" name="captcha" />
</fieldset>

<input type="submit" name="register" value="Register" />
</center>
</form>
