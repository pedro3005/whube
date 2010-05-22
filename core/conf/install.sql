DROP DATABASE IF EXISTS whube;
CREATE DATABASE whube;
use whube;

CREATE TABLE projects (
	pID      INTEGER NOT NULL AUTO_INCREMENT,
	title    VARCHAR(255),
	PRIMARY KEY( pID )
);

CREATE TABLE project_aliases (
	pName    VARCHAR(255),
	pID      INTEGER NOT NULL UNIQUE, /* FK projects */
	PRIMARY KEY( pName )
);

CREATE TABLE status (
	status   INTEGER NOT NULL AUTO_INCREMENT,
	sTitle   VARCHAR(255),
	PRIMARY KEY(status)
);

INSERT INTO status VALUES ('', 'Incoming');
INSERT INTO status VALUES ('', 'Filed');
INSERT INTO status VALUES ('', 'In Progress');
INSERT INTO status VALUES ('', 'Testing');
INSERT INTO status VALUES ('', 'Fix Commited');
INSERT INTO status VALUES ('', 'Fix Released');

CREATE TABLE priority (
	priority   INTEGER NOT NULL AUTO_INCREMENT,
	prTitle    VARCHAR(255),
	PRIMARY KEY(priority)
);

INSERT INTO priority VALUES ('', 'New');
INSERT INTO priority VALUES ('', 'Wishlist');
INSERT INTO priority VALUES ('', 'Low');
INSERT INTO priority VALUES ('', 'Medium');
INSERT INTO priority VALUES ('', 'High');
INSERT INTO priority VALUES ('', 'Critical');
INSERT INTO priority VALUES ('', 'OMGWTFBBQ');

CREATE TABLE bugs (
	bID      INTEGER NOT NULL AUTO_INCREMENT,
	pID      INTEGER NOT NULL, /*FK Projects*/
	title    VARCHAR(255),
	reporter INTEGER NOT NULL, /*FK Users*/
	assignee INTEGER NOT NULL, /*FK Users*/
	status   INTEGER NOT NULL, /*FK Status*/
	priority INTEGER NOT NULL, /*FK Priority*/
	PRIMARY KEY( bID )
);

CREATE TABLE users (
	uID      INTEGER NOT NULL AUTO_INCREMENT,
	name     VARCHAR(255),
	email    VARCHAR(255),
	bio      TEXT,
	timezone VARCHAR(8),
	lang     VARCHAR(8),
	passwd   VARCHAR(255),
	PRIMARY KEY( uID )
);

INSERT INTO users VALUES (
	'',
	'Paul Tagliamonte',
	'paultag@whube.com',
	'It\'s Me!',
	'EST',
	'US_EN',
	'2c1743a391305fbf367df8e4f069f9f9'
);

CREATE TABLE user_aliases (
	uAlias   VARCHAR(255),
	uID      INTEGER NOT NULL UNIQUE,
	PRIMARY KEY( uAlias )
);

INSERT INTO user_aliases VALUES ( '1', 'paultag' );


