<?php
/**
 * @file src/activate/content.php
 * @brief HTML for the activate module
 * @author Paul Barbu
 *
 * @ingroup activateFiles
 */

?>
<form method="post" action="" >
<table border=0 cellspacing=5>
<tr><td>
<label for="code">Activation code:</label></td><td><input type="text" maxlength=10
name="code" id="code" <?php echo isset($_GET['code']) && !empty($_GET['code']) ? 'value="' . $_GET['code'] . '" disabled' : 'tabindex="1"' ?> />
</tr></td><tr><td>
<label for="pass">Password:</label></td><td><input tabindex="2" type="password" maxlength="30" id="pass" name="pass" />
</tr></td><tr><td>
<label for="passconfirm">Confirm password:</label></td><td><input tabindex="3" type="password" maxlength="30" id="passconfirm" name="passconfirm" />
</tr></td><tr><td>
<label for="question">Security question:</label></td><td><input tabindex="4" type="text" maxlength="255" id="question" name="security_q" />
</tr></td><tr><td>
<label for="answer">Security answer:</label></td><td><input tabindex="5" type="text" maxlength="255" id="answer" name="security_a" />
</tr></td><tr><td colspan="2"><center>
<input tabindex="6" type="submit" value="Activate!" name="activate" />
<input tabindex="7" type="reset" name="reset" value="Reset" />
</center></tr></td>
</table>
</form>
