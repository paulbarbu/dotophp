<?php
/**
 * @file src/alarm/content.php
 * @brief View of the alarm page
 * @author Paul Barbu
 *
 * @ingroup alarmFiles
 */

/**
 * @defgroup alarmFiles Alarm files
 */
?>

<form action="" method="post" >
<fieldset id="addalarm"><legend><?php echo ucfirst($feedback['alarm']['action']) ?> an alarm</legend>
<table border="0">
<tr><td><label for="ev">Event:</label></td><td><select name="event_id" id="ev" tabindex="1">
<?php arrayToOption($feedback['alarm']['ev_names'], $feedback['alarm']['ev_ids'], isset($feedback['alarm']['event_id']) ? $feedback['alarm']['event_id'] : NULL) ?>
</select></td></tr>
<tr><td>
<label for="date" title="<?php echo TOOLTIP_DATETIME ?>">Notification date:</label></td><td><input title="<?php echo TOOLTIP_DATETIME ?>" type="text" name="date" id="date" tabindex="2" maxlength="16"
 <?php echo isset($feedback['alarm']['date']) ? 'value="' . $feedback['alarm']['date'] . '"' : 'value="' . DATETIME_TOUSER . '"' ?> />
</td></tr>
<tr><td colspan="2"><center>
<?php
echo isset($feedback['alarm']['alarm_id']) ? '<input type="hidden" name="alarm_id" value="' . $feedback['alarm']['alarm_id'] . '" />' : NULL ?>
<input type="submit" name="<?php echo $feedback['alarm']['action'] ?>" value="<?php echo ucfirst($feedback['alarm']['action']) ?> alarm" tabindex="3"/>
</center></td></tr>
</table>
</fieldset>
</form>

<?php

if(is_numeric($feedback_pre['rcats'])){
    echo '<h3>';

    switch($feedback_pre['rcats']){
        case A_ERR_DATETIME: printf('You must specify a valid date! (#%d)', A_ERR_DATETIME);
            break;
        case A_ERR_ALARM_DATE: printf('The alarm date must occur earlier then the event\'s due date! (#%d)', A_ERR_ALARM_DATE);
            break;
        case ERR_NONE: printf('Added!');
            break;
        case MODIFIED: printf('Modified!');
            break;
        case ERR_DB: printf('A database error occured, please contact the admin! (#%d)', ERR_DB);
            break;
        case ERR_DB_CONN: printf('A database connection error occured, please contact the admin! (#%d)', ERR_DB_CONN);
            break;
    }

    echo '</h3>';
}
else if(is_numeric($feedback['alarm']['code'])){
    echo '<h3>';

    switch($feedback['alarm']['code']){
        case ERR_DB: printf('A database error occured, please contact the admin! (#%d)', ERR_DB);
            break;
        case ERR_DB_CONN: printf('A database connection error occured, please contact the admin! (#%d)', ERR_DB_CONN);
            break;
    }

    echo '</h3>';
}
else if(is_array($feedback['alarm']['code'])){
    echo '<h3>';

    switch($feedback['alarm']['code'][0]){
        case DELETED: printf('Deleted %d alarm(s)!', $feedback['alarm']['code'][1]);
            break;
    }

    echo '</h3>';
}

if(isset($feedback['alarm']['alarms']) && !empty($feedback['alarm']['alarms'])){
    echo <<<'buttons'
<hr /><h4>Your alarms:</h4><form action="" method="post">
<input type="submit" name="del" value="Delete" tabindex="15" />

buttons;

    $name = 'modify-sel';
    $value = 'Modify selected';

    if(isset($feedback['alarm']['alarm_id'])){
        $name = 'stop';
        $value = 'Finish editing';
    }
    echo '<input type="submit" name="' . $name . '" value="' . $value . '" tabindex="4" />';

    foreach($feedback['alarm']['ev_ids'] as $ev_id){
        $ev_alarms = array();

        foreach($feedback['alarm']['alarms'] as $alarm){
            if($alarm['event_id'] == $ev_id){
                $ev_alarms[] = $alarm;
            }
        }

        if(!empty($ev_alarms)){
            echo '<div class="cat">&#9698;&nbsp;' , $alarm['name'];

            pag(arrayToDiv($ev_alarms, 'formatAlarm'), '?show=alarm',
                isset($_GET['p']) ? (int)$_GET['p'] : 1, 2, 3);

            echo '</div>';
        }
    }

    echo '</form>';
}
/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/
