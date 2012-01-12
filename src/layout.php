<?php
/**
 * @file layout.php
 * @brief HTML main file
 * @author paullik
 * @ingroup kernelFiles
 */

$proceed = NULL;

if(isset($modules[$module]) && !empty($modules[$module]) &&
   file_exists(MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $modules[$module]['VL']['content']) &&
   is_readable(MODULES_ROOT . $module . DIRECTORY_SEPARATOR . $modules[$module]['VL']['content'])){
    $proceed = TRUE;
}
else{
    $proceed = FALSE;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="./css/style.css" />

<title><?php echo $proceed ? $modules[$module]['VL']['title'] : NULL?></title>

</head>
<body>
<div id="menu">
<?php echo build_menu_from_modules($modules, $module, 'isLoggedIn')?>
</div>
    <div id="content">
        <h3><?php echo $proceed ? $modules[$module]['VL']['title'] : NULL?></h3>
        <?php
            if($proceed){
                include MODULES_ROOT . $module . DIRECTORY_SEPARATOR
                    . $modules[$module]['VL']['content'];
            }
            else{
                echo '<h3>' , ERR_LOAD_FILE , '</h3>';
            }
        ?>
    </div>
</body>
</html>
