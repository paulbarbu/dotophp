<?php
/**
 * @file src/login/content.php
 * @brief content of the login module
 * @author Paul Barbu
 *
 * @ingroup loginFiles
 */
?>
<form action="" method="post">
<table border=0 cellspacing=5>
<tr><td>
<label for="nick">Nickname:</label></td><td><input id="nick" type="text" name="nick" maxlength=20 />
</td></tr><tr><td>
<label for="pass">Password:</label></td><td><input type="password" maxlength="30" id="pass" name="pass" />
</td></tr><tr><td>
<label for="remember">Remember me</label></td><td><input type="checkbox" checked name="remember" id="remember" />
</td></tr>
</table>
<input type="submit" name="login" value="Log in" />
</form>
