<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style>
		body {
			color: #FFF;
			background-color: #000;
		}
		h1, h2, h3, h4, h5 {
			color: #666;
		}
		input {
			margin:5px;
		}
		*.unselectable {
			-moz-user-select: -moz-none;
			-khtml-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
	</style>
</head>
<?php
require_once('faker/autoload.php');
require_once('dblib.php');
require_once('config.php');

$db		=	new mysqli($connect_params['dbhost'],$connect_params['dbuser'],$connect_params['dbpass'],$connect_params['dbname']);
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

$tables	=	array();
	if(empty($_GET)) {
		unset($connect_params['dbuser']);
		unset($connect_params['dbpass']);
		echo "<pre class='unselectable'>";print_r($connect_params);echo "</pre>";
		include("table_input.html");
	}
	else {
		echo "<pre class='unselectable'>";print_r($_GET);echo "</pre>";
		
		// refactor this shit
		$encoded_tables = explode(",", $_GET['csv_tables']);
		if(!empty($_GET['csv_tables'])) $encoded_tables = explode(",", $_GET['csv_tables']);
		else $encoded_tables = array();
		if(empty($populate['tables']) && !empty($encoded_tables)) $sqltables = $encoded_tables;
		elseif(!empty($populate['tables']) && empty($encoded_tables)) $sqltables = $populate['tables'];
		elseif(!empty($populate['tables']) && !empty($encoded_tables))  $sqltables = array_merge($encoded_tables, $populate['tables']);
		else {
			if(!empty($populate['table'])) $sqltables = $populate['table'];
			else {
				debug('wtf, no tables were specified');
			}
		}
		// default to one
		$populate['count']	=	($_GET['quantity']>1) ? $_GET['quantity'] : $populate['count'];
	}

if(!empty($sqltables)) {
	foreach($sqltables as $table) {
		$valuestring	=	'';
		$ctr	=	$populate['count'];
		if(isset($table['Tables_in_'.$connect_params['dbname']])) { $table_name	=	$table['Tables_in_'.$connect_params['dbname']]; }
		else { $table_name	=	$table; }
		$columns=$values				=	array();
		$tables[$table_name]			=	array();
		$tables[$table_name]['columns']	=	quickquery("DESC ".$table_name);
		if(empty($tables[$table_name]['columns'])) continue; // no columns found(?) are you sure that table exists?
		foreach($tables[$table_name]['columns'] as $dbcolumn) {
			$columns[]	=	'`'.$dbcolumn['Field'].'`';
			$ctr	=	$populate['count'];
		}
		$ctr	=	$populate['count'];
		while($ctr>0) {
			foreach($tables[$table_name]['columns'] as $dbcolumn) {
				$fakedvalue	=	generate_faker_by_column($dbcolumn);
				$values[$ctr][]	=	$fakedvalue;
				$debug[$table_name][$ctr][$dbcolumn['Field']]			=	$dbcolumn;
				$debug[$table_name][$ctr][$dbcolumn['Field']]['value']	=	$fakedvalue;
			}
			$tables[$table_name]['values'][]	=	"(".implode(',', $values[$ctr]).")";
			$ctr--;
		}
		$tables[$table_name]['columns']	=	implode(',', $columns);

		$sql = "INSERT INTO ".$table_name." <br/>(".$tables[$table_name]['columns'].") <br/>VALUES <br/>".implode(",<br/>", $tables[$table_name]['values'])."; ";
		$clean_sql = "INSERT INTO ".$table_name." (".$tables[$table_name]['columns'].") VALUES ".implode(",", $tables[$table_name]['values'])."; ";

		echo "<h1 class='unselectable'>Generating query for ".$table_name."</h1>";
		if($output['debug']) {
			echo "<h3 class='unselectable'>Debug variable</h3>";
			debug($debug);
			echo "<h3 class='unselectable'>Table variable</h3>";
			debug($tables);
		}
		if($output['echo']) {
			echo "<pre>".$sql."</pre>";
		}
		if($output['autoquery']) {
			$db->query($clean_sql);
			if($db->error != "") debug($db->error);
			else echo "<p class='unselectable'>".$populate['count']." rows inserted to ".$table_name."</p>";
		}
		echo "<br/><hr/><br/>";
	}
}
