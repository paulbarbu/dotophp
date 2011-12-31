<?php
/**
 * @file src/notreceived/content.php
 * @brief No activation email was sent, it must be resent
 * @author Paul Barbu
 *
 * @ingroup notreceivedFiles
 */

/**
 * If nothing happened just display the form
 */
if($feedback['notreceived']){
?>
<p>You didn't receive the activation email?<br />
Fill the form below so we can resend it.</p>

<form action="" method="post">
<label for="email" title="<?php echo TOOLTIP_EMAIL ?>">E-mail:</label><input id="email" type="text" name="email"
 maxlength="255" tabindex="1" title="<?php echo TOOLTIP_EMAIL ?>" />
<input type="submit" name="resend" value="Resend activation email" tabindex="2" />
</form>
<?php
    if(is_numeric($feedback['notreceived'])){
        echo '<h3>';

        switch($feedback['notreceived']){
            case NR_ERR_DB_CONNECTION: printf("Could not connect to the database, please contact the administrator! (#%d)", NR_ERR_DB_CONNECTION);
                break;
            case NR_ERR_NO_MAIL: printf("Please enter your email address (#%d)", NR_ERR_NO_MAIL);
                break;
            case NR_ERR_MAIL: printf("Invalid email! (#%d)", NR_ERR_MAIL);
                break;
            case NR_ERR_ACTIVE: printf("The account associated with this email is activated! (#%d)", NR_ERR_ACTIVE);
                break;
            case NR_ERR_NOT_SENT: printf("Couldn't send the email! (#%d)", NR_ERR_NOT_SENT);
                break;
        }

        echo '</h3>';
    }
}
elseif(!$feedback['notreceived']){
    echo '<h3>Email resent!</h3>';
}
?>
