SELECT 'Demo queries for dotophp' AS ' ';

SELECT 'Adding John as a new user, using transactions' AS ' ';

BEGIN;

INSERT INTO user (nick, first_name, name, email, password, security_q, answer, private, phone, birthday, description, sex, tz, country, city)
    VALUES('jonny', 'John', 'Gates', 'john@mail.com', SHA1('asdf42'),
        'Cum o cheama pe sora ta?', 'Emily', 1, '0742424242', '1980-05-21 15:00:00', 'Eu sunt romanul John din Arabia.', 'M', 'Romania/Bucharest', 'RO', 'Sibiu');

INSERT INTO pending (id, code) VALUES(LAST_INSERT_ID(), 'ab42ab42ba');

COMMIT;

SELECT 'Adding john as a new user, using transactions' AS ' ';

BEGIN;

INSERT INTO user (nick, first_name, name, email, password, security_q, answer, private, phone, birthday, description, sex, tz, country, city)
    VALUES('joNny', 'John', 'Gates', 'john@gmail.com', SHA1('asdf42'),
        'Cum o cheama pe sora ta?', 'Emily', 1, '0742424242', '1980-05-21 15:00:00', 'Eu sunt romanul John din Arabia.', 'M', 'Romania/Bucharest', 'RO', 'Sibiu');

INSERT INTO pending (id, code) VALUES(LAST_INSERT_ID(), 'ab42ab42ba');

COMMIT;

SELECT 'Deleting john' AS '';

DELETE FROM user WHERE nick='joNny';

SELECT 'Adding category: birthdays' AS ' ';

INSERT INTO category(id, name, description, repeat_interval, color) 
    VALUES(1, 'Birthdays', "My relative's birthdays", 1, 16777215);

SELECT 'Adding category: other' AS ' ';

INSERT INTO category(id, name, description, repeat_interval, color) 
    VALUES(1, 'Other', "Stuff & Things", 1, 1777215);

SELECT 'Adding \'Mom\' into Birthdays' AS ' ';

INSERT INTO event(category_id, name, priority, repeat_interval, private, start, color) 
    VALUES(1, 'Mom', 5, 4, 1, '2011-11-11 00:06:00',255);

SELECT 'Setting alarm for mom' AS ' ';

INSERT INTO alarm(id, date) VALUES(1, '2011-11-11 00:08:00');

DELETE FROM category WHERE name='Birthdays';

BEGIN;

INSERT INTO user (nick, first_name, name, email, password, security_q, answer, private, phone, birthday, sex, tz, country, city, created)
    VALUES('Foo', 'Bar', 'FooBar', 'barfoo@gmail.com', SHA1('asdf'),
        'Unde locuiesti?', 'La bloc', 1, '0740000000', '1989-03-11 13:00:00', 'M', 'Romania/Bucharest', 'RO', 'Iasi', '2011-05-11 00:00:00');

INSERT INTO pending (id, code) VALUES(LAST_INSERT_ID(), 'ab42ab42ba');

COMMIT;

SELECT 'Deleting un-activated user accounts(7 days passed from the creation without activation)' AS ' ';

DELETE FROM user WHERE activated='0000-00-00 00:00:00' AND (UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(created))/604799 >= 1;

SELECT 'Updating description, and setting avatar for the user with id=1' AS ' ';

UPDATE user SET avatar='srv/http/avatars/img1.png', description='Me, jonny!' WHERE id=1;


SELECT 'New \'Homework\' event!' AS ' ';

INSERT INTO event(category_id, name, priority, repeat_interval, private, start, end, color) 
    VALUES(2, 'Homework', 10, 1, 0, '2011-09-15 09:00:00', '2012-06-15 09:00:00', 255);

SELECT 'Setting one alarm for \'Homework\' event!' AS ' ';

INSERT INTO alarm(id, date) 
    VALUES(2, '2011-10-03 20:00:00');

SELECT '!!!FIREWORKS!!!' AS ' ';
