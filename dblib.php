<?php
function debug($var) {
	echo "<pre>";
	$debug = debug_backtrace();
	$file = $debug[0]['file'];
	$line = $debug[0]['line'];
	echo "Debug function call in " . $file . " at " . $line . "<br/>";
	print_r($var);
	echo "</pre>";
}
function quickquery($sql) {
	global $db;
	$result = $db->query($sql);
	if($db->query($sql)) {
		if($result->num_rows > 0) {
			$data = array();
			while($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			$result->free();
			return $data;
		}
		else{
			return false;
		}
	}
	else {
		return false;
	}
}
function generate_faker_by_column($col) {
//	$faker = Faker\Factory::create();
	$faker = Faker\Factory::create('ja_JP');
	preg_match('/(?<=\()(.+)(?=\))/is', $col['Type'], $length);
	if($col['Null']=='YES' && rand(0,10)==1) { // generate null
		return 'NULL';
	}
	if($col['Key']=="PRI") {
		return "'".substr($faker->unique()->uuid,0,$length[0])."'";
	}
	if(strpos($col['Type'], 'varchar')!== false || strpos($col['Type'], 'char')!== false) {
		if(strpos($col['Field'], '_id') !== false) {
			return "'".substr($faker->unique()->uuid,0,$length[0])."'";
		}
		else {
			$faked = (rand(0,1)==1) ? $faker->sentence : $faker->kanaName;
			return "'".substr($faked, 0, $length[0])."'";
		}
	}
	if(strpos($col['Type'], 'float')!== false) {
		return number_format($faker->randomFloat,2,'.','');
	}
	if(strpos($col['Type'], 'double')!== false) {
		return number_format($faker->randomFloat,2,'.','');
	}
	if(strpos($col['Type'], 'tinyint')!== false) {
		return $faker->numberBetween(0,9);
	}
	if(strpos($col['Type'], 'int')!== false) {
		return $faker->numberBetween(0,99);
	}
	if(strpos($col['Type'], 'datetime')!== false) {
		return "'".date("Y-m-d H:i:s", strtotime($faker->iso8601))."'";
	}
	if(strpos($col['Type'], 'date')!== false) {
		return "'".date("Y-m-d", strtotime($faker->iso8601))."'";
	}
	if(strpos($col['Type'], 'text')!== false) {
		return "'".$faker->paragraph."'";
	}
	debug("if you see this then i fucced up AYYY LMAO");
}
function create_sql_condition($table, $master_conditions) {
	foreach($master_conditions as $condition=>$params) {
		if($params['matching']=='') $conditions[]	=	$table.".".$condition." = '".$params['value']."'";
		elseif($params['matching']=='%') $conditions[]	=	$table.".".$condition." LIKE '%".$params['value']."'";
		elseif($params['matching']=='>') $conditions[]	=	$table.".".$condition." > ".$params['value'];
		elseif($params['matching']=='<') $conditions[]	=	$table.".".$condition." < ".$params['value'];
		else $conditions[]	=	$table.".".$condition." LIKE '%".$params['value']."%'";
	}
	return $conditions;
}
