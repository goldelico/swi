<?php

// this is a sample configuration file
// please modify as needed
// and make sure that it is not accessible externally
// having this file piped through PHP (i.e. if some user accesses $URL/config/filename.php) creates an empty page 

$HOST="example.org"
$SERVER="projects/softwareindex";	// link where SWI resides on the host server - i.e. www.example.org/projects/softwareindex

// database connection

$DB_HOST="mysql.$HOST";
$DB_DATABASE="database-name";
$DB_USER="database-user";
$DB_PASSWORD="database-password";	// make sure that the config directory is not world-readable!
$DB_TABLE="swi";	// if you install multiple copies of software index sharing a database server you can use separate tables

// general config

$URL="http://www.$HOST/$SERVER";		// URL where SWI resides
$TITLE="EXAMPLE Software Index";		// the TITLE
$FROM="swi@$HOST";				// where mails originate
$MAIN="<h1><img src=\"http://www.$HOST/images/Logo.png\"><br/>Software<br/>Index</h1>";
$CONTENT="<b>The Example Software Index</b>";
$KEYWORDS="Example, Software, Applications";

$MAX_FILE_SIZE=100*1024;

// bottom line

$CONTACT="Comments: <a href=\"mailto:$FROM\">$FROM</a>";
$IMPRESSUM="<a href=\"http://www.$HOST/index.html\">Example Home</a>";
$HINT="<a href=\"http://wiki.$HOST\">Example Wiki</a>";

	$ROM_VARIANTS=array("Any"
											//"---",
											//"Other",
											);
	
	$MODEL_VARIANTS=array("Any"
												//"---",
												//"Other",
												);

	$CATEGORIES_MENU=array("Application",
						   "Commercial",
						   "Developer Tool",
						   "Distribution",
						   "Framework",
						   "Game",
						   "Preference",
						   "System Tool",
						   "Tool"
						  );
	
?>
