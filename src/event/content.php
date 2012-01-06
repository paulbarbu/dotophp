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

$result = mysqli_query($feedback_pre['connect'], 'SELECT c.name AS cname, c.color AS ccolor, event_id, e.category_id, e.name AS ename,
    e.description, e.repeat_interval, e.color, priority, private, exception,
    start, end  FROM event AS e JOIN category AS c USING (category_id) WHERE user_id = 1');

$events = mysqli_fetch_all($result, MYSQLI_ASSOC);

$cat = getDbData($feedback_pre['connect'], 'category', array('name', 'category_id'), array('user_id' => $_SESSION['uid']));

$cat_names = array();
$cat_ids = array();

foreach($cat as $i){
    $cat_names[] = $i['name'];
    $cat_ids[] = $i['category_id'];
}

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
<label for="color" title="<?php echo TOOLTIP_COLOR ?>">Color:</label></td><td><input title="<?php echo TOOLTIP_COLOR ?>" type="text" maxlength="7" tabindex="8" name="color" id="color"
 value="<?php echo isset($_POST['color']) ? $_POST['color'] : '#RRGGBB' ?>" />
</td></tr><tr><td>
<label for="desc" title="<?php echo TOOLTIP_DESC ?>">Description:</label></td><td><textarea title="<?php echo TOOLTIP_DESC ?>" tabindex="4" rows="2" cols="23" name="description" id="desc">
<?php echo isset($_POST['description']) ? $_POST['description'] : NULL ?></textarea>
</td><td>
<label for="startdate" title="<?php echo TOOLTIP_DATETIME ?>">Start date:</label></td><td><input title="<?php echo TOOLTIP_DATETIME ?>" type="text" name="startdate" id="startdate" tabindex="9" maxlength="16"
 <?php echo isset($_POST['startdate']) ? 'value="' . $_POST['startdate'] . '"' : 'value="' . DATETIME_TOUSER . '"' ?> />
</td></tr><tr>
<td><label for='cat'>Category: </label></td><td><select name="cat" id ="cat" tabindex="5" >
<?php arrayToOption($cat_names, $cat_ids, isset($_POST['cat']) ? $_POST['cat'] : NULL ); ?>
</select></td>
<td>
<label for="enddate" title="<?php echo TOOLTIP_DATETIME ?>">Due for:</label></td><td><input title="<?php echo TOOLTIP_DATETIME ?>" type="text" name="enddate" id="enddate" tabindex="10" maxlength="16"
 <?php echo isset($_POST['enddate']) ? 'value="' . $_POST['enddate'] . '"' : 'value="' . DATETIME_TOUSER . '"' ?> />
</td></tr><tr><td>
<label for="repeat">Repeat:</label></td><td><select tabindex="6" name="repeat" id="repeat">
 <?php arrayToOption(array_values($REPEATS), array_keys($REPEATS), isset($_POST['repeat']) ? $_POST['repeat'] : '-1'); ?>
</select>
</td><td>
<label for="priv">Private event:</label></td><td><input id="priv" type="checkbox" name="private" tabindex="11" value="1"
 <?php echo isset($_POST['private']) ? 'checked="checked"' : NULL ?> />
</td></tr><tr><td>
<label for="priority">Priority:</label></td><td><select tabindex="7" name="priority" id="priority">
 <?php arrayToOption(array_values($PRIORITIES), array_keys($PRIORITIES), isset($_POST['priority']) ? $_POST['priority'] : NULL); ?>
</select>
</td><td>
<label for="exception">Exception:</label></td><td><input id="exception" type="checkbox" name="exception" tabindex="12" value="1"
 <?php echo isset($_POST['exception']) ? 'checked="checked"' : NULL ?> />
</td></tr><tr><td colspan="4"><center>
<input type="submit" name="add" value="Add event" tabindex="13"/>
</center></td></tr></table>
</fieldset>
</form>
<?php
if(is_array($feedback_pre['rcats'])){
    echo '<h3>';

    foreach($feedback_pre['rcats'] as $err){
        switch($err){
            case E_ERR_DESC: printf('Invalid description! (#%d)', E_ERR_DESC);
                break;
            case E_ERR_COLOR: printf('Invalid color! (#%d)', E_ERR_COLOR);
                break;
            case E_ERR_DATETIME: printf('Invalid date! (#%d)', E_ERR_DATETIME);
                break;
        }
    }

    echo '</h3>';
}
else if(is_numeric($feedback_pre['rcats'])){
    echo '<h3>';

    switch($feedback_pre['rcats']){
        case E_ERR_DESC: printf('Invalid description! (#%d)', E_ERR_DESC);
            break;
        case E_ERR_COLOR: printf('Invalid color! (#%d)', E_ERR_COLOR);
            break;
        case E_ERR_DATETIME: printf('Invalid date! (#%d)', E_ERR_DATETIME);
            break;
        case E_ERR_INVALID_ENDDATE: printf('Due date must occur later in time than the start date! (#%d)', E_ERR_INVALID_ENDDATE);
            break;
        case ERR_NONE: printf('Added!');
            break;
        case E_ERR_NAME: printf('Invalid name! (#%d)', E_ERR_NAME);
            break;
        case E_ERR_DUPLICATE: printf('Duplicate name inside category! (#%d)', E_ERR_DUPLICATE);
            break;
        case ERR_DB: printf('A database error occured, please contact the admin! (#%d)', ERR_DB);
            break;
        case ERR_DB_CONN: printf('A database connection error occured, please contact the admin! (#%d)', ERR_DB_CONN);
            break;
    }

    echo '</h3>';
}

echo '<hr /><h4>Your events:</h4><form action="" method="post">';

foreach($cat_ids as $cat_id){

    $cat_events = array();

    foreach($events as $ev){
        if($ev['category_id'] == $cat_id){
            $cat_events[] = $ev;
        }
    }

    if(!empty($cat_events)){
        $catColor = colorCodeFromInt($cat_events[0]['ccolor']);

        echo '<div class="cat"><div style="background-color:#' , $catColor , ';color:#' ,
            getContrastColor($catColor) , '">&#9698;&nbsp;' , $cat_events[0]['cname'] , '</div>';

        arrayToDiv($cat_events, 'formatEvent', NULL, 'cat');

        echo '</div>';
    }
}

echo '</form>';
