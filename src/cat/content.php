<?php
/**
 * @file src/category/category.php
 * @brief Category's content
 * @author Paul Barbu
 *
 * @ingroup catFiles
 */

require 'constants.php';
?>

<form action="" method="post">
<table border="0" cellspacing="5">
<tr><td>
<label for="name" title="<?php echo TOOLTIP_NICK_CAT_EV ?>">Name:</label></td><td><input title="<?php echo TOOLTIP_NICK_CAT_EV ?>" type="text" maxlength="20" name="name" id="name" tabindex="1"
 <?php echo isset($_POST['name']) ? 'value="' . $_POST['name'] . '"' : NULL ?> /></td><td>

<label for="desc" title="<?php echo TOOLTIP_DESC ?>">Description:</label></td><td><textarea title="<?php echo TOOLTIP_DESC ?>" tabindex="2" rows="3" cols="23" name="description" id="desc">
<?php echo isset($_POST['description']) ? $_POST['description'] : NULL ?></textarea></td></tr>

<tr><td>
<label for="color">Color:</label></td><td><input type="text" maxlength="7" tabindex="3" name="color" id="color"
 value="<?php echo isset($_POST['color']) ? $_POST['color'] : COLOR_CODE ?>" /></td><td>

<label for="repeat">Repeat:</label></td><td><select tabindex="4" name="repeat" id="repeat">
 <?php arrayToOption(array_values($REPEATS), array_keys($REPEATS), isset($_POST['repeat']) ? $_POST['repeat'] : NULL); ?>
</select></td></tr><tr><td colspan="4"><center>
<input type="submit" name="add" value="Add" tabindex="5" /></center></td></tr>
</table>
</form>

<?php
if(is_array($feedback_pre['rcats'])){
    echo '<h3>';

    foreach($feedback_pre['rcats'] as $err){
        switch($err){
            case C_ERR_NO_NAME: printf('The category must have a name! (#%d)<br />', C_ERR_NO_NAME);
                break;
            case C_ERR_DESC: printf('The description contains invalid characters! (#%d)<br />', C_ERR_DESC);
                break;
            case C_ERR_COLOR: printf('Invalid color code! (#%d)<br />', C_ERR_COLOR);
                break;
        }
    }

    echo '</h3>';
}
else if(is_numeric($feedback_pre['rcats'])){
    echo '<h3>';

    switch($feedback_pre['rcats']){
        case ERR_DB: printf('A database error occured, please contact the admin! (#%d)', C_ERR_DB);
            break;
        case ERR_DB_CONN: printf('A database connection error occured, please contact the admin! (#%d)', C_ERR_DB_CONN);
            break;
        case C_ERR_DUPLICATE: printf('No duplicates allowed! (#%d)', C_ERR_DUPLICATE);
            break;
        case ERR_NONE: printf('Added!');
            break;
        case C_ERR_NO_NAME: printf('The category must have a name! (#%d)<br />', C_ERR_NO_NAME);
            break;
        case C_ERR_DESC: printf('The description contains invalid characters! (#%d)<br />', C_ERR_DESC);
            break;
        case C_ERR_COLOR: printf('Invalid color code! (#%d)<br />', C_ERR_COLOR);
            break;
    }

    echo '</h3>';
}

echo '<hr /><h4>Your categories:</h4>';

arrayToDiv(get_categories($feedback_pre['connect'], $_SESSION['uid']), 'format_cat', NULL, 'cat');
