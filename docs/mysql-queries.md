List of MySQL requests
======================

* Delete
    * user by name: `DELETE FROM user WHERE first_name='<f_name>' AND name='<name>';`
    * user by e-mail: `DELETE FROM user WHERE email='<email>';`
    * category: `DELETE FROM category WHERE id='<owners_id>' AND name='<name>' AND desc='<desc>';`
    * event: `DELETE FROM event WHERE event_id='<ev_id>' AND name='<name>' AND desc='<desc>';`

* Add
    * user: `INSERT INTO user 
    (nick, first_name, name, email, pass, security_q, answer, private, phone, birthday, desc, sex, tz, country, city)
    VALUES('<nick>', '<f_name>', '<name>', '<email>', SHA1('<pass>'),
    '<security_q>', '<answer>', <bool>, '<phone_number>', '<birthday>', '<desc>', <M/F>, '<region>/<city>', '<country>', '<city>');`
    `INSERT INTO pending (id, activation_code) VALUES(LAST_INSERT_ID(), '<random_10_alfanum_chars>');`
    * category: `INSERT INTO category (id, name, desc, repeat, color)
    VALUES('<users_id_who_created_the_cat>', '<cat_name>', '<desc>', '<value>''<color_code>');`
    * event: `INSERT INTO event (cat_id, name, desc, priority, repeat, private, start, end, color)
    VALUES('<cat_id>', '<name>', '<desc>', '<priority>', '<repeat>', <bool>, '<timestamp>', '<timestamp>', '<color_code>');`
    * ban: `INSERT INTO bans (ip) VALUES('<ip_int>');`

* Set:
    * avatar and description: `UPDATE user SET avatar='<avatar_path>', desc='<desc>' WHERE id='<users_id>';`
    * event description and private-ness; `UPDATE event SET desc='<desc>', private=<bool> WHERE event_id='<ev_id>';`
