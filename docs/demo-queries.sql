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

SELECT '!!!FIREWORKS!!!' AS ' ';
