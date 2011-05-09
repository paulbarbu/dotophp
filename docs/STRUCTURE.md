DOTOPHP - FOLDER STRUCTURE
===========================

* src/    _source code for the app_
    * webroot/    _static files and VIEW LOGIC_                    
        * index.php 
        * img/    _images for default template_
        * css/    _style sheets for default template_
        * avatars/    _users avatars_
    * functions/    _WILL CONTAIN BUSNIESS LOGIC_
        * users.php    _users related functions: i.e. userCreate()_
        * category.php    _category related functions: i.e. catNew()_
        * events.php    _events related functions: i.e. evDel()_
        * plugins.php    _this will handle plugin related functions: i.e.
	  plgNew()_
        * acp.php _acp related functions_
    * actions/    _different parts of the BL (like "controllers")_
        examples:
        * new_category.php
        * ...
    * plugins/    _all available plugins will lay here_
        * services/
        * formats/
    * config/    _configuration files: i.e. database configuration files_
        * cfg_mysql.php _configuration file for mysql connection_

**The functions names are not set yet, the names are used only for example.
Will discuss this mater after we will define the folder structures**