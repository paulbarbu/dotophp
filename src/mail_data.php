<?php
/**
 * @file src/mail_data.php
 * @brief Helper file that contains the mail details
 * @author Paul Barbu
 *
 * @ingroup registerFiles
 */

/**
 * Mail header
 */
$mail_data['header'] = 'From: noreply@dotophp.com';
/**
 * Mail subject
 */
$mail_data['subject'] = '[dotophp] Account registration for %(nick)s';
/**
 * Mail body
 */
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
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
