<?php
/**
 * @file layout.php
 * @brief HTML main file
 * @author paullik
 * @ingroup kernelFiles
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="./css/style.css" />

<title><?php echo $modules[$module]['VL']['title'];?></title>

</head>
<body>
    <div id="header">

    </div>
    <div id="menu">
        <?php echo build_menu_from_modules($modules, $module)?>
    </div>

    <div id="content">
        <h3><?php echo $modules[$module]['VL']['title'];?></h3>
        <?php
            if(file_exists(MODULES_ROOT . $module . DIRECTORY_SEPARATOR
                            . $modules[$module]['VL']['content']) &&
                is_readable(MODULES_ROOT . $module . DIRECTORY_SEPARATOR
                . $modules[$module]['VL']['content'])){
        ?>
            <p>
        <?php
                    include MODULES_ROOT . $module . DIRECTORY_SEPARATOR
                        . $modules[$module]['VL']['content'];
            }
            else{
                echo '<h3>' , ERR_LOAD_FILE , '</h3>';
            }
        ?>

            </p>
    </div>
</body>
</html>
