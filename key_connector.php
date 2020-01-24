<?php
require_once('faker/autoload.php');
require_once('dblib.php');
require_once('config.php');

$db		=	new mysqli($connect_params['dbhost'],$connect_params['dbuser'],$connect_params['dbpass'],$connect_params['dbname']);
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

$limit = 10;
$foreign = array(
	'sms_transactiontype' => array(
		'from_column' => 'id',
		'to_column' => 'type_id',
		'conditions' => array(
			'deleted' => array(
				'matching'=>'',
				'value'=>0,
			),
		),
	),
	'contacts' => array(
		'from_column' => 'id',
		'to_column' => 'contact_id',
		'conditions' => array(
			'deleted' => array(
				'matching'=>'',
				'value'=>0,
			),
		),
	),
);

$primary = array(
	'sms_fee' => array(
		'conditions' => array(
			'deleted' => array(
				'matching'=>'',
				'value'=>0,
			),
		),
	),
);



foreach($primary as $to=>$params) {
	$mastercondition		=	"";
	if(!empty($params['conditions'])) {
		$mastercondition			=	create_sql_condition($params['conditions']);
		$mastercondition	=	"WHERE ".implode(", ",$mastercondition);
	}
	foreach($foreign as $from=>$fromparams) {
		$subcondition			=	create_sql_condition($fromparams['conditions']);
		$subcondition			=	"WHERE ".implode(", ",$subcondition);
		$mastergetter			=	"SELECT ".$fromparams['from_column']." FROM ".$from." ".$subcondition." ORDER BY RAND() LIMIT 1";
		$queries[$from]		=	"UPDATE ".$to." SET ".$fromparams['to_column']."=(".$mastergetter.") ".$mastercondition."; ";
	}
}


//foreach($from as $subtable=>$subparams) {
//	$mastergetter			=	"SELECT ".$from['column']." FROM ".$from['table']." ".$mastercondition." ORDER BY RAND() LIMIT 1";
//	$subcondition		=	"";
//	if(!empty($subparams['conditions'])) {
//		$subconditions	=	create_sql_condition($subparams['conditions']);
//		$subcondition	=	"WHERE ".implode(", ",$subconditions);
//	}
//	$queries[$subtable]		=	"UPDATE ".$subtable." SET ".$subparams['column']."=(".$mastergetter.") ".$subcondition."; ";
//}
debug($queries);
