<?php
/**
 * @file src/login/content.php
 * @brief Content of the login module
 * @author Paul Barbu
 *
 * @ingroup loginFiles
 */

if($feedback['login']){
?>

<form action="" method="post">
<table border="0" cellspacing="5">
<tr><td>
<label for="nick">Nickname:</label></td><td><input id="nick" type="text" name="nick" maxlength="20" tabindex="1" />
</td></tr><tr><td>
<label for="pass">Password:</label></td><td><input type="password" maxlength="30" id="pass" name="pass" tabindex="2"/>
</td></tr><tr><td>
<label for="remember">Remember me</label></td><td><input type="checkbox" checked="checked" name="remember" id="remember" tabindex="3"/>
</td></tr>
</table>
<input type="submit" name="login" value="Log in" tabindex="4"/>
</form>
<p>Activation email not received? <a href="index.php?show=notreceived" tabindex="5" >Click here</a> to have it resent!</p>

<?php
    if(is_numeric($feedback['login'])){
        echo '<h3>';

        switch($feedback['login']){
            case L_ERR_DB_CONNECTION: printf('Error connecting to the database! (#%d)', L_ERR_DB_CONNECTION);
                break;
            case L_ERR_NO_USER: printf('This user is inexistent! (#%d)', L_ERR_NO_USER);
                break;
            case L_ERR_PASS: printf('Incorrect password! (#%d)', L_ERR_PASS);
                break;
            case L_ERR_SESS_START: printf('Cound not start session! (#%d)', L_ERR_SESS_START);
                break;
            case L_ERR_INACTIVE: printf ('This account is inactive, please activate it! (#%d)', L_ERR_INACTIVE);
                break;
            case L_ERR_DB: printf('A database related error occured, please contact the administrator! (#%d)', L_ERR_DB);
                break;
        }

        echo '</h3>';
    }
}
else if($feedback['login'] == ERR_NONE){
    echo '<h3>You\'re now logged in!</h3>';
}
