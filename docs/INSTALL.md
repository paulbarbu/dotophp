1. Clone yaCMS: https://github.com/paullik/yaCMS
2. Clone dotophp https://github.com/paullik/dotophp (if you haven't already)
3. Create `index.php` inside your DocumentRoot, in which you define the
   constant YACMS_PATH with the right path to `yaCMS/src/` (with the trailing
   slash) and include `dotophp/src/index.php`
4. Create a new database
5. `cd` into dotophp/docs and type the following command to populate the database:
`source ./schema.sql`
6. `cd` into dotophp/src/mysql and edit `connect.php` according to your
connection details
7. `crontab -e` add `@weekly ID=dotophp_expired_cleanup php -f dotophp/bin/expired.php`
8. That's it, access it through the web browser
