DROP DATABASE IF EXISTS whube_todo;
CREATE DATABASE whube_todo;
use whube_todo;

CREATE TABLE users (
	uID        VARCHAR(255),
	email      VARCHAR(255),
	real_name  VARCHAR(255),
	descr      TEXT,
	lang       VARCHAR(255),
	passwd     VARCHAR(255),
	PRIMARY KEY( uID )
);

CREATE TABLE defect (
	dID        INTEGER NOT NULL AUTO_INCREMENT,
	owner      VARCHAR(255),
	reporter   VARCHAR(255),
	title      VARCHAR(255),
	descr      TEXT,
	PRIMARY KEY( dID )
);

INSERT INTO users VALUES (
	'paultag',
	'paultag@gmail.com',
	'Paul Tagliamonte',
	'Superhacker of this and that. Also the other thing.',
	'en-us',
	'letmein'
);

INSERT INTO defect VALUES (
	'',
	'paultag',
	'paultag',
	'Fake Defect',
	'This is the descr'
);

INSERT INTO defect VALUES (
	'',
	'paultag',
	'paultag',
	'Fake asfasfasfasfasfDefect',
	'This is the descr'
);

INSERT INTO defect VALUES (
	'',
	'paultag',
	'paultag',
	'Fakasfasfasfasfasfase Defect',
	'This is the descr'
);

INSERT INTO defect VALUES (
	'',
	'paultag',
	'paultag',
	'Fake Desfaasfasfasffect',
	'This is the descr'
);


