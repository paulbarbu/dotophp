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
<label for="name">Name:</label></td><td><input type="text" maxlength="20" name="name" id="name" tabindex="1"
 <?php echo isset($_POST['name']) ? 'value="' . $_POST['name'] . '"' : NULL ?> /></td><td>

<label for="desc">Description:</label></td><td><textarea tabindex="2" rows="3" cols="23" name="description" id="desc">
<?php echo isset($_POST['description']) ? $_POST['description'] : NULL ?></textarea></td></tr>

<tr><td>
<label for="color">Color:</label></td><td><input type="text" maxlength="7" tabindex="3" name="color" id="color"
value="<?php echo isset($_POST['color']) ? $_POST['color'] : COLOR_CODE ?>" /></td><td>

<label for="repeat">Repeat:</label></td><td><select tabindex="4" name="repeat" id="repeat">
 <?php echo arrayToOption(array_values($REPEATS), array_keys($REPEATS), isset($_POST['repeat']) ? $_POST['repeat'] : NULL); ?>
</select></td></tr><tr><td colspan="4"><center>
<input type="submit" name="add" value="Add" tabindex="5" /></center></td></tr>
</form>
