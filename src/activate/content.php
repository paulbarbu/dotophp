<?php
/**
 * @file src/activate/content.php
 * @brief HTML for activate module
 * @author Paul Barbu
 *
 * @ingroup activateFiles
 */

//TODO: sequrity q. and answer
//TODO; set tabindex for activation_code field only if the $_GET['code'] is empty
?>
<form method="post" action="" >
<table border=0 cellspacing=5>
<tr><td>
<label for="code">Activation code:</label></td><td><input tabindex="1" type="text" maxlength=10 name="code" id="code" />
</tr></td><tr><td>
<label for="pass">Password:</label></td><td><input tabindex="2" type="password" maxlength="30" id="pass" name="pass" />
</tr></td><tr><td>
<label for="passconfirm">Confirm password:</label></td><td><input tabindex="3" type="password" maxlength="30" id="passconfirm" name="passconfirm" />
</tr></td><tr><td>
</table>
<input tabindex="4" type="submit" value="Activate!" name="activate" />
</form>
