1. Clone yaCMS: https://github.com/paullik/yaCMS
2. Clone dotophp https://github.com/paullik/dotophp (if you haven't already)
3. In `dotophp/src/index.php` you must fill in YACMS_PATH's value with the right
path to `yaCMS/src/` (with the trailing slash)
4. Create a new database
5. `cd` into `dotophp/docs` and from the mysql prompt type the following
command to populate the database: `source ./schema.sql`
6. `cd` into dotophp/src/mysql and edit `connect.php` according to your
connection details
7. Fill the timezone tables in MySQL: http://dev.mysql.com/doc/refman/5.0/en/time-zone-support.html
8. You must edit the user's crontab under which LAMP will be run otherwise
permission errors will occur:
`crontab -e -u http` add `@weekly ID=dotophp_expired_cleanup php -f dotophp/bin/expired.php` 
and `@daily ID=dotophp_sess_cleanup php -f dotophp/bin/sess_cleanup.php`
9. If you see fit you can change the logging path(s) in `dotophp/src/config.php`
10. For security change your `session.save_path` setting in php.ini to a directory
where only the LAMP user will have privileges.
11. You must install the GD extension for PHP otherwise the captcha won't be
created, also you need the `mysqli` extension
12. That's it, access dotophp/src/index.php through the web browser
