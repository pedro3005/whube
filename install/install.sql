DROP DATABASE IF EXISTS whube;
CREATE DATABASE whube;
use whube;

CREATE TABLE users (
	uID            INTEGER NOT NULL AUTO_INCREMENT, /* PK */
	real_name      VARCHAR(255),
	username       VARCHAR(255) UNIQUE,
	email          VARCHAR(255),
	locale         VARCHAR(8),
	timezone       VARCHAR(8),
	password       VARCHAR(255), /* HASHED, DUH */
	startstamp     LONG,
	trampstamp     LONG,
	PRIMARY KEY( uID )
);

INSERT INTO users VALUES (
	'',
	'Paul Tagliamonte',
	'paultag',
	'paultag@whube.com',
	'EN',
	'-0500',
	'ae2b1fca515949e5d54fb22b8ed95575',
	1234567890,
	1234567890
);

CREATE TABLE user_rights ( 
	userID         INTEGER NOT NULL, /* FK, users */
	admin          BOOL,
	staff          BOOL,
	doner          BOOL,
	member         BOOL,
	startstamp     LONG,
	trampstamp     LONG,
	PRIMARY KEY( userID )
);

INSERT INTO user_rights VALUES (
	'1',
	TRUE, /* ADMIN */
	TRUE, /* STAFF */
	TRUE, /* DONER */
	TRUE, /* MEMBR */
	1234567890,
	1234567890
);

CREATE TABLE projects ( 
	pID            INTEGER NOT NULL AUTO_INCREMENT, /* PK */
	project_name   VARCHAR(255) UNIQUE, /* like an alias */
	descr          TEXT,
	owner          INTEGER NOT NULL, /* FK, users */
	active         BOOL,
	startstamp     LONG,
	trampstamp     LONG,
	PRIMARY KEY( pID )
);


INSERT INTO projects VALUES (
	'',
	'whube',
	'Whube is this project right here!',
	1,
	1234567890,
	1234567890,
	TRUE
);

CREATE TABLE status (
	statusID       INTEGER NOT NULL AUTO_INCREMENT, /* PK */
	status_name    VARCHAR(255),
	critical       BOOL,
	PRIMARY KEY( statusID )
);

INSERT INTO status VALUES ( '', 'New', FALSE ); /* status 1 ftw */
INSERT INTO status VALUES ( '', 'Bullcrap', FALSE );
INSERT INTO status VALUES ( '', 'Triaged', FALSE );
INSERT INTO status VALUES ( '', 'Reproduced', TRUE );
INSERT INTO status VALUES ( '', 'In Progress', TRUE );
INSERT INTO status VALUES ( '', 'Fix Commited', FALSE );
INSERT INTO status VALUES ( '', 'Fix Released', FALSE );

CREATE TABLE severity (
	severityID     INTEGER NOT NULL AUTO_INCREMENT, /* PK */
	severity_name  VARCHAR(255),
	critical       VARCHAR(255),
	PRIMARY KEY( severityID )
);

INSERT INTO severity VALUES ( '', 'New', FALSE );
INSERT INTO severity VALUES ( '', 'Wishlist', FALSE );
INSERT INTO severity VALUES ( '', 'Low', FALSE );
INSERT INTO severity VALUES ( '', 'Medium', TRUE );
INSERT INTO severity VALUES ( '', 'High', TRUE );
INSERT INTO severity VALUES ( '', 'Critical', TRUE );
INSERT INTO severity VALUES ( '', 'OMGWTFBBQ', TRUE );

CREATE TABLE bugs ( 
	bID            INTEGER NOT NULL AUTO_INCREMENT, /* PK */
	bug_status     INTEGER NOT NULL DEFAULT 1, /* FK, status */
	bug_severity   INTEGER NOT NULL DEFAULT 1, /* FK, severity */
	package        INTEGER NOT NULL, /* FK, project */
	reporter       INTEGER NOT NULL, /* FK, users */
	owner          INTEGER NOT NULL, /* FK, users */
	title          VARCHAR(255),
	descr          TEXT,
	startstamp     LONG,
	trampstamp     LONG,
	PRIMARY KEY ( bID )
);

