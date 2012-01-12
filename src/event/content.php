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
 <?php echo isset($event['quickadd']) ? 'value="' . $event['quickadd'] . '"' : NULL ?> />
<input type="submit" name="quick-add" value="Add" tabindex="2" />
</fieldset>

<fieldset id="d-add"> <legend><?php echo ucfirst($feedback['event']['action']) ?> an event specifying details</legend>
<table  border="0" cellspacing="5"><tr><td>

<label for="name" title="<?php echo TOOLTIP_NICK_CAT_EV ?>"> Name:</label></td><td><input title="<?php echo TOOLTIP_NICK_CAT_EV ?>" type="text" maxlength="20" name="name" id="name" tabindex="3"
 <?php echo isset($feedback['event']['name']) ? 'value="' . $feedback['event']['name'] . '"' : NULL ?> />
</td><td>
<label for="color" title="<?php echo TOOLTIP_COLOR ?>">Color:</label></td><td><input title="<?php echo TOOLTIP_COLOR ?>" type="text" maxlength="7" tabindex="8" name="color" id="color"
 value="<?php echo isset($feedback['event']['color']) ? $feedback['event']['color'] : '#RRGGBB' ?>" />
</td></tr><tr><td>
<label for="desc" title="<?php echo TOOLTIP_DESC ?>">Description:</label></td><td><textarea title="<?php echo TOOLTIP_DESC ?>" tabindex="4" rows="2" cols="23" name="description" id="desc">
<?php echo isset($feedback['event']['description']) ? $feedback['event']['description'] : NULL ?></textarea>
</td><td>
<label for="startdate" title="<?php echo TOOLTIP_DATETIME ?>">Start date:</label></td><td><input title="<?php echo TOOLTIP_DATETIME ?>" type="text" name="startdate" id="startdate" tabindex="9" maxlength="16"
 <?php echo isset($feedback['event']['startdate']) ? 'value="' . $feedback['event']['startdate'] . '"' : 'value="' . DATETIME_TOUSER . '"' ?> />
</td></tr><tr>
<td><label for='cat'>Category: </label></td><td><select name="cat" id ="cat" tabindex="5" >
<?php arrayToOption($feedback['event']['cat_names'], $feedback['event']['cat_ids'], isset($feedback['event']['cat']) ? $feedback['event']['cat'] : NULL ); ?>
</select></td>
<td>
<label for="enddate" title="<?php echo TOOLTIP_DATETIME ?>">Due for:</label></td><td><input title="<?php echo TOOLTIP_DATETIME ?>" type="text" name="enddate" id="enddate" tabindex="10" maxlength="16"
 <?php echo isset($feedback['event']['enddate']) ? 'value="' . $feedback['event']['enddate'] . '"' : 'value="' . DATETIME_TOUSER . '"' ?> />
</td></tr><tr><td>
<label for="repeat">Repeat:</label></td><td><select tabindex="6" name="repeat" id="repeat">
 <?php arrayToOption(array_values($REPEATS), array_keys($REPEATS), isset($feedback['event']['repeat']) ? $feedback['event']['repeat'] : '-1'); ?>
</select>
</td><td>
<label for="priv">Private event:</label></td><td><input id="priv" type="checkbox" name="private" tabindex="11" value="1"
 <?php echo isset($feedback['event']['private']) ? 'checked="checked"' : NULL ?> />
</td></tr><tr><td>
<label for="priority">Priority:</label></td><td><select tabindex="7" name="priority" id="priority">
 <?php arrayToOption(array_values($PRIORITIES), array_keys($PRIORITIES), isset($feedback['event']['priority']) ? $feedback['event']['priority'] : NULL); ?>
</select>
</td><td>
<label for="exception">Exception:</label></td><td><input id="exception" type="checkbox" name="exception" tabindex="12" value="1"
 <?php echo isset($feedback['event']['exception']) ? 'checked="checked"' : NULL ?> />
</td></tr><tr><td colspan="4"><center>
<?php
echo isset($feedback['event']['event_id']) ? '<input type="hidden" name="event_id" value="' . $feedback['event']['event_id'] . '" />' : NULL ?>
<input type="submit" name="<?php echo $feedback['event']['action'] ?>" value="<?php echo ucfirst($feedback['event']['action']) ?> event" tabindex="13"/>
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
        case MODIFIED: printf('Modified!');
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
else if(is_numeric($feedback['event']['code'])){
    echo '<h3>';

    switch($feedback['event']['code']){
        case ERR_DB: printf('A database error occured, please contact the admin! (#%d)', ERR_DB);
            break;
        case ERR_DB_CONN: printf('A database connection error occured, please contact the admin! (#%d)', ERR_DB_CONN);
            break;
    }

    echo '</h3>';
}
else if(is_array($feedback['event']['code'])){
    echo '<h3>';

    switch($feedback['event']['code'][0]){
        case DELETED: printf('Deleted %d event(s)!', $feedback['event']['code'][1]);
            break;
        case DONE: printf('Marked as done %d event(s)!', $feedback['event']['code'][1]);
            break;
    }

    echo '</h3>';
}

if(isset($feedback['event']['events']) && !empty($feedback['event']['events'])){
echo <<<'PHP'
<hr /><h4>Your events:</h4><form action="" method="post">
<input type="submit" name="done" value="Mark as done" tabindex="14" />
<input type="submit" name="del" value="Delete" tabindex="15" />
<input type="submit" name="view-done" value="View the completed events" tabindex="16" />

PHP;

    $name = 'modify-sel';
    $value = 'Modify selected';

    if(isset($feedback['event']['event_id'])){
        $name = 'stop';
        $value = 'Finish editing';
    }
    echo '<input type="submit" name="' . $name . '" value="' . $value . '" tabindex="17" />';

    foreach($feedback['event']['cat_ids'] as $cat_id){

        $cat_events = array();

        foreach($feedback['event']['events'] as $ev){
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

    if(isset($feedback['event']['done_ev']) &&
        !empty($feedback['event']['done_ev'])){
        echo '<br /><hr /><h4>Your completed events:</h4>';

        arrayToDiv($feedback['event']['done_ev'], 'formatDoneEvent', NULL, 'cat');
    }
}
