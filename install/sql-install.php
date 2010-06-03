<?php
require_once('../conf/site.php');
require_once('../model/sql.php');

$sql = new sql;

if($CREATE_DB == 1) {
  echo "DROP DATABASE IF EXISTS whube;\n CREATE DATABASE whube; use whube;";
}
ob_start();
?>
CREATE TABLE <?php echo $TABLE_PREFIX; ?>users (
  uID            INTEGER NOT NULL AUTO_INCREMENT, /* PK */
  real_name      VARCHAR(255),
  username       VARCHAR(255) UNIQUE,
  email          VARCHAR(255),
  locale         VARCHAR(8),
  timezone       VARCHAR(8),
  password       VARCHAR(255), /* HASHED, DUH */
  PRIMARY KEY( uID )
);

INSERT INTO <?php echo $TABLE_PREFIX; ?>users VALUES (
  '',
  'Tom Martin',
  'tenach',
  'tenach@gmail.com',
  'EN',
  '-0900',
  'ae2b1fca515949e5d54fb22b8ed95575'
);

CREATE TABLE <?php echo $TABLE_PREFIX; ?>user_rights ( 
  userID         INTEGER NOT NULL, /* FK, users */
  admin          BOOL,
  staff          BOOL,
  doner          BOOL,
  member         BOOL,
  PRIMARY KEY( userID )
);

INSERT INTO <?php echo $TABLE_PREFIX; ?>user_rights VALUES (
  '1',
  TRUE, /* ADMIN */
  TRUE, /* STAFF */
  TRUE, /* DONER */
  TRUE  /* MEMBR */
);

CREATE TABLE <?php echo $TABLE_PREFIX; ?>projects ( 
  pID            INTEGER NOT NULL AUTO_INCREMENT, /* PK */
  project_name   VARCHAR(255) UNIQUE, /* like an alias */
  descr          TEXT,
  owner          INTEGER NOT NULL, /* FK, users */
  active         BOOL,
  PRIMARY KEY( pID )
);


INSERT INTO <?php echo $TABLE_PREFIX; ?>projects VALUES (
  '',
  'whube',
  'Whube is this project right here!',
  1,
  TRUE
);

INSERT INTO <?php echo $TABLE_PREFIX; ?>projects VALUES (
  '',
  'whube_docs',
  'Whube Docs manages all the documentation for the Whube project, and documents anywhere!',
  1,
  TRUE
);

CREATE TABLE <?php echo $TABLE_PREFIX; ?>status (
  statusID       INTEGER NOT NULL AUTO_INCREMENT, /* PK */
  status_name    VARCHAR(255),
  critical       BOOL,
  PRIMARY KEY( statusID )
);

INSERT INTO <?php echo $TABLE_PREFIX; ?>status VALUES ( '', 'New', FALSE ); /* status 1 ftw */
INSERT INTO <?php echo $TABLE_PREFIX; ?>status VALUES ( '', 'Bullcrap', FALSE );
INSERT INTO <?php echo $TABLE_PREFIX; ?>status VALUES ( '', 'Triaged', FALSE );
INSERT INTO <?php echo $TABLE_PREFIX; ?>status VALUES ( '', 'Reproduced', TRUE );
INSERT INTO <?php echo $TABLE_PREFIX; ?>status VALUES ( '', 'In Progress', TRUE );
INSERT INTO <?php echo $TABLE_PREFIX; ?>status VALUES ( '', 'Fix Commited', FALSE );
INSERT INTO <?php echo $TABLE_PREFIX; ?>status VALUES ( '', 'Fix Released', FALSE );

CREATE TABLE <?php echo $TABLE_PREFIX; ?>severity (
  severityID     INTEGER NOT NULL AUTO_INCREMENT, /* PK */
  severity_name  VARCHAR(255),
  critical       VARCHAR(255),
  PRIMARY KEY( severityID )
);

INSERT INTO <?php echo $TABLE_PREFIX; ?>severity VALUES ( '', 'New', FALSE );
INSERT INTO <?php echo $TABLE_PREFIX; ?>severity VALUES ( '', 'Wishlist', FALSE );
INSERT INTO <?php echo $TABLE_PREFIX; ?>severity VALUES ( '', 'Low', FALSE );
INSERT INTO <?php echo $TABLE_PREFIX; ?>severity VALUES ( '', 'Medium', TRUE );
INSERT INTO <?php echo $TABLE_PREFIX; ?>severity VALUES ( '', 'High', TRUE );
INSERT INTO <?php echo $TABLE_PREFIX; ?>severity VALUES ( '', 'Critical', TRUE );
INSERT INTO <?php echo $TABLE_PREFIX; ?>severity VALUES ( '', 'OMGWTFBBQ', TRUE );

CREATE TABLE <?php echo $TABLE_PREFIX; ?>bugs ( 
  bID            INTEGER NOT NULL AUTO_INCREMENT, /* PK */
  bug_status     INTEGER NOT NULL DEFAULT 1, /* FK, status */
  bug_severity   INTEGER NOT NULL DEFAULT 1, /* FK, severity */
  package        INTEGER NOT NULL, /* FK, project */
  reporter       INTEGER NOT NULL, /* FK, users */
  owner          INTEGER NOT NULL, /* FK, users */
  title          VARCHAR(255),
  descr          TEXT,
  PRIMARY KEY ( bID )
);
<?php
$longQuery = ob_get_contents();
ob_end_clean(); 
echo $longQuery;
//$sql->query($longQuery);
//echo "Complete!";
?>