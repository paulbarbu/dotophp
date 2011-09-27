1. Clone yaCMS: https://github.com/paullik/yaCMS
2. Clone dotophp https://github.com/paullik/dotophp
3. On your dotophp/src/index.php change the path on lines:
    * 13 - you must point to the dotophp repo in `src` directory, there are the modules you want to load
    * 16 - point this to your `global_functions.php` file in the dotophp repo, `src` directory, 
you'll want these functions made available across all modules
    * 17 - point this to your `modules.php` file in the dotophp repo, `src`
directory, this is the configuration file for the needed modules
    * 20 - path to your `index.php` file in yaCMS' `src` directory, yaCMS must
be called last because all the settings made above to be available

4. Access your dotophp/src/index.php and enjoy!
