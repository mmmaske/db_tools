<script>
function toggleDisplay(tablename) {
	var activate_table	=	document.getElementsByClassName(tablename);
	for(var i = 0; i < activate_table.length; i++){
		is_visible = activate_table[i].style.display;
		activate_table[i].style.display = is_visible==='none' ? '' : "none";
	}
}
</script>
<?php
$table	=	quickquery("SHOW TABLES");
foreach($table as $t) {
	$tablename	=	$t['Tables_in_'.$_GET['dbname']];
	$structure	=	quickquery("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='".$tablename."' AND TABLE_SCHEMA='".$_GET['dbname']."'");
	$tbl		=	"<table border=1><tr><th colspan=99 id='{$tablename}' class='dialog'><a onclick='javascript: toggleDisplay(\"class_".$tablename."\")'>".$tablename."</a></th></tr>";
	$tbl		.=	"<tr class='class_".$tablename."' style='display:none;'><th>Column Name</th><th>Data Type</th></tr>";
	foreach($structure as $s) {
		$bgcolor	=	"#000000";
		if($s['COLUMN_KEY']=="PRI") $bgcolor="#222200";
		elseif($s['COLUMN_KEY']!="" && $s['COLUMN_KEY']!="PRI") $bgcolor="#223322";
		$colname	=	$s['COLUMN_NAME'];
		$datatype	=	$s['DATA_TYPE'];
		$maxlength	=	$s['CHARACTER_MAXIMUM_LENGTH'];
		$tbl		.=	"<tr class='class_".$tablename."' style='display:none;'><td style='background-color:$bgcolor;'>{$colname}</td><td style='background-color:$bgcolor;'>{$datatype} ({$maxlength})</td><td style='background-color:$bgcolor;'>".$s['COLUMN_KEY']."</td></tr>";
	}
	$count		=	quickquery("SELECT COUNT(id) AS cnt FROM ".$tablename);
	$tbl		.=	"<tr><td colspan=99>".$count[0]['cnt']." rows in table</td></tr>";
	$tbl		.=	"</table>";
	echo "<div style='float:left; margin:10px;'>".$tbl."</div>";
}
?>
