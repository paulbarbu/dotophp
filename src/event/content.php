<?php
/**
 * @file src/event/content.php
 * @brief Manage events content
 * @author Paul Barbu
 *
 * @ingroup eventFiles
 */

/**
 * @defgroup eventFiles Manage events
 */

require 'constants.php';

?>
<form action="" method="post">
<fieldset id="q-add"> <legend>Quick add an event</legend>
<input type="text" maxlength="20" name="quickadd" id="quick-add" tabindex="1"
 <?php echo isset($_POST['quickadd']) ? 'value="' . $_POST['quickadd'] . '"' : NULL ?> />
<input type="submit" name="quick-add" value="Add" tabindex="2" />
</fieldset>

<fieldset id="d-add"> <legend>Add an event specifying details</legend>
<table  border="0" cellspacing="5"><tr><td>

<label for="name" title="<?php echo TOOLTIP_NICK_CAT_EV ?>"> Name:</label></td><td><input title="<?php echo TOOLTIP_NICK_CAT_EV ?>" type="text" maxlength="20" name="name" id="name" tabindex="3"
 <?php echo isset($_POST['name']) ? 'value="' . $_POST['name'] . '"' : NULL ?> />
</td><td>
<label for="color">Color:</label></td><td><input type="text" maxlength="7" tabindex="7" name="color" id="color"
value="<?php echo isset($_POST['color']) ? $_POST['color'] : '#RRGGBB' ?>" />
</td></tr><tr><td rowspan="2">
<label for="desc" title="<?php echo TOOLTIP_DESC ?>">Description:</label></td><td rowspan="2"><textarea title="<?php echo TOOLTIP_DESC ?>" tabindex="4" rows="3" cols="23" name="description" id="desc">
<?php echo isset($_POST['description']) ? $_POST['description'] : NULL ?></textarea>
</td><td>
<label for="startdate">Start date:</label></td><td><input type="text" name="startdate" id="startdate" tabindex="8" maxlength="10"
 <?php echo isset($_POST['startdate']) ? 'value="' . $_POST['startdate'] . '"' : 'value="' . DATE_TOUSER . '"' ?> />
</td></tr><tr><td>
<label for="enddate">Due for:</label></td><td><input type="text" name="enddate" id="enddate" tabindex="9" maxlength="10"
 <?php echo isset($_POST['enddate']) ? 'value="' . $_POST['enddate'] . '"' : 'value="' . DATE_TOUSER . '"' ?> />
</td></tr><tr><td>
<label for="repeat">Repeat:</label></td><td><select tabindex="5" name="repeat" id="repeat">
 <?php echo arrayToOption(array_values($REPEATS), array_keys($REPEATS), isset($_POST['repeat']) ? $_POST['repeat'] : NULL); ?>
</select>
</td><td>
<label for="priv">Private event:</label></td><td><input id="priv" type="checkbox" name="private" tabindex="10" value="1"
 <?php echo isset($_POST['private']) ? 'checked="checked"' : NULL ?> />
</td></tr><tr><td>
<label for="priority">Priority:</label></td><td><select tabindex="6" name="priority" id="priority">
 <?php echo arrayToOption(array_values($PRIORITIES), array_keys($PRIORITIES), isset($_POST['priority']) ? $_POST['priority'] : NULL); ?>
</select>
</td><td>
<label for="exception">Exception:</label></td><td><input id="exception" type="checkbox" name="exception" tabindex="11" value="1"
 <?php echo isset($_POST['exception']) ? 'checked="checked"' : NULL ?> />
</td></tr><tr><td colspan="4"><center>
<input type="submit" name="add" value="Add event" tabindex="12"/>
</center></td></tr></table>
</fieldset>
</form>
