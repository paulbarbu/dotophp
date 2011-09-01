SELECT 'Demo queries for dotophp' AS ' ';

SELECT 'Adding John as a new user, using transactions' AS ' ';

BEGIN;

INSERT INTO user (first_name, last_name, description, nick, email, password, security_q, security_a, private, tz, country, city, phone, birthday, sex)
    VALUES('John', 'Gates', 'Eu sunt romanul John din Arabia.', 'jonny', 'john@mail.com', SHA1('asdf42'),
        'Cum o cheama pe sora ta?', 'Emily', 1, 'Romania/Bucharest', 'RO', 'Sibiu', '0742424242', '1980-05-21 15:00:00', 'M');

INSERT INTO pending (user_id, code) VALUES(LAST_INSERT_ID(), 'ab42ab42ba');

COMMIT;

SELECT 'Adding john as a new user, using transactions' AS ' ';

BEGIN;
INSERT INTO user (first_name, last_name, description, nick, email, password, security_q, security_a, private, tz, country, city, phone, birthday, sex)
    VALUES('John', 'Gates', 'Eu sunt romanul John din Arabia.', 'joNny', 'john@gmail.com', SHA1('asdf42'),
        'Cum o cheama pe sora ta?', 'Emily', 1, 'Romania/Bucharest', 'RO', 'Sibiu', '0742424242', '1980-05-21 15:00:00', 'M');

INSERT INTO pending (user_id, code) VALUES(LAST_INSERT_ID(), 'ab42ab42ba');

COMMIT;

SELECT 'Deleting john' AS '';

DELETE FROM user WHERE nick='joNny';

SELECT 'Adding category: birthdays' AS ' ';

INSERT INTO category(user_id, name, description, repeat_interval, color) 
    VALUES(1, 'Birthdays', "My relative's birthdays", 1, 16777215);

SELECT 'Adding category: other' AS ' ';

INSERT INTO category(user_id, name, description, repeat_interval, color)
    VALUES(1, 'Other', "Stuff & Things", 1, 1777215);

SELECT 'Adding \'Mom\' into Birthdays' AS ' ';

INSERT INTO event(category_id, name, repeat_interval,  color, priority, private, start)
    VALUES(1, 'Mom', 5, 255,4, 1, '2011-11-11 00:06:00');

SELECT 'Setting alarm for mom' AS ' ';

INSERT INTO alarm(event_id, date) VALUES(1, '2011-11-11 00:08:00');

DELETE FROM category WHERE name='Birthdays';

BEGIN;

INSERT INTO user (first_name, last_name, nick, email, password, security_q, security_a, created, private, tz, country, city, phone, birthday, sex)
    VALUES('Foo', 'Bar', 'FooBar', 'barfoo@gmail.com', SHA1('asdf'),
        'Unde locuiesti?', 'La bloc', '2011-05-11 00:00:00', 1, 'Romania/Bucharest', 'RO', 'Iasi', '0740000000', '1989-03-11 13:00:00', 'M');

INSERT INTO pending (user_id, code) VALUES(LAST_INSERT_ID(), 'ab42ab42ba');

COMMIT;

SELECT 'Deleting un-activated user accounts(7 days passed from the creation without activation)' AS ' ';

DELETE FROM user WHERE activated='0000-00-00 00:00:00' AND (UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(created))/604799 >= 1;

SELECT 'Updating description, and setting avatar for the user with id=1' AS ' ';

UPDATE user SET avatar='srv/http/avatars/img1.png', description='Me, jonny!' WHERE id=1;


SELECT 'New \'Homework\' event!' AS ' ';

INSERT INTO event(category_id, name, repeat_interval,  color, priority, private, exception, start, end)
    VALUES(2, 'Homework', 1, 255, 1, 0, 1, '2011-09-15 09:00:00', '2012-06-15 09:00:00');

SELECT 'Setting one alarm for \'Homework\' event!' AS ' ';

INSERT INTO alarm(event_id, date) 
    VALUES(2, '2011-10-03 20:00:00');

SELECT '!!!FIREWORKS!!!' AS ' ';
