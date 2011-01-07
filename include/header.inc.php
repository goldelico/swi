<?php

// FIXME:  --

require "include/connect.inc.php";		// load database connection
require "include/login.inc.php";		// login manager

function listapps($query, $info="<p>", $showall=false)
{
	global $_GET;
	global $DB_TABLE;
echo "$info<p>\n";
// echo $query;
$result=query($query);
$rownum=0;
$lastname="";
echo "<table width=\"95%\" cellspacing=0>";
while($row=mysql_fetch_array($result))
{
	if(!$showall && $row['name'] == $lastname)
		continue;	// show first entry only (must be ordered by version/date descending)
	$lastname=$row['name'];
	$rownum++;
	if($rownum % 2 == 0)
		echo "<tr class=\"listing\">";
	else
		echo "<tr class=\"mlisting\">";
	echo "<td width=5%>";
	if(getscreenshot($row['id']))
		{ // screen0 is enabled and exists
		echo "<a href='showdetail.php?app=".$row['id']."'>";	
		echo "<img src='images/image_32.png' width='18' height='18' border='0'>";
		echo "</a>";
		}
	else
		echo "<img src='images/transparent_32.gif' width='18' height='18' border='0'>";
	echo "</td>";
	echo "<td align=left width=30%>";
	echo "<a href='showdetail.php?app=";
	echo rawurlencode($row['id']);
	if($row['updated'])
		echo "&updated=".rawurlencode($row['updated']);
	if($_GET['rom'])
		echo "&rom=".rawurlencode($_GET['rom']);
	if($_GET['model'])
		echo "&model=".rawurlencode($_GET['model']);
	echo "'>";
	echo htmlentities($row['name']);
	if($row['version'])
		echo " - ".htmlentities($row['version']);
	echo "</a>";
	echo "</td>";
	echo "<td>";
	echo htmlentities($row['summary']);
	echo "<td align=right width=10% nowrap><small>";
	if($row['upd'])
		echo "(".htmlentities($row['upd']).")";
	echo "</small></td>";
	echo "</tr>\n";
}
mysql_free_result($result);
echo "</table>";

if($rownum == 0)
	echo "Nothing found.";
}

function getscreenshot($id, $number=0, $slot=-1)
{ // get full file name either by screen$number or $slot
	global $DB_TABLE;
	if($id)
		{
		if($number >= 0)
			{
			$query="select * from ${DB_TABLE} where id=".($id+0);
			$result=query($query);
			$row=mysql_fetch_array($result);
			mysql_free_result($result);
			return getscreenshot($id, -1, $row["screen$number"]-1);
			}
		if($slot >= 0)
			{ // exists (i.e. sequence number is defined)
			$basename=sprintf("screenshots/%05d_%d", $id, $slot);
			if(file_exists($basename.".png"))
				return $basename.".png";
			if(file_exists($basename.".jpg"))
				return $basename.".jpg";
			if(file_exists($basename.".gif"))
				return $basename.".gif";
			}
		}
	return "";
}

function getscreenshots($id)
{ // get array of sequence numbers where a screendhot file exists
	global $DB_TABLE;
	$result=array();
	$handle=opendir('screenshots');
	while(false !== ($file = readdir($handle)))
		{
		preg_match("/^(.*)_(.*)\.(.*)/i", $file, $treffer);
//		echo $file." -> ".$treffer;
		if($treffer[1] == $id)
			$result[]=$treffer[2];
		}
	closedir($handle); 
	return $result;
}

function requestchange($app, $field, $value="", $reason="")
{ // queue change request
	global $DB_TABLE;
	$result=query("select max(number) as next from ${DB_TABLE}_changerequest");
	$row=mysql_fetch_array($result);
	$next=$row['next']+1;
	mysql_free_result($result);
	query("insert into ${DB_TABLE}_changerequest (number, `when`, appid, field, newvalue, requestor, reason) values ($next, now(), $app, ".quote($field).", ".quote($value).", ".quote(loginname()).", ".quote($reason).")");
}

include "include/header2.inc.php";

?>