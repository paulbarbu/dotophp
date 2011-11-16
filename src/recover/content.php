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
?>
<form action="" method="post">
<table border="0" cellspacing="5">
<tr><td>
    <label for="nick">Nickname:</label></td><td><input id="nick" type="text" name="nick" maxlength="20" tabindex="1" />
    </td></tr><tr><td>
    <label for="email">E-mail:</label></td><td><input id="email" type="text" name="email" maxlength="255" tabindex= "2" />
    </td></tr><tr><td colspan="2" ><center>
<input type="submit" name="recover" value="Recover" tabindex="3" /></center>
</td></tr>
</table>
</form>
