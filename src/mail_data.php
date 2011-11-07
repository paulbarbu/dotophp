<?php
/**
 * @file src/register/mail_data.php
 * @brief Helper file that contains the mail details
 * @author Paul Barbu
 *
 * @ingroup registerFiles
 */

$mail_data['header'] = 'From: noreply@dotophp.com';
$mail_data['subject'] = '[dotophp] Account registration for %(nick)s';
$mail_data['msg'] =
'Hello, %(nick)s!

Your DoToPHP account has been created!

For activation please visit:
    %(code_link)s

If you cannot click on the link copy and paste it in your browser\'s address bar.

OR

Access %(activation_link)s and use the activation code: %(code)s

If you do not activate your account within a week from the activation date the account will be deleted!

Thank you!';

return $mail_data;
