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

);

$primary = array(
	'event_contacts' => array(
		'conditions' => array(
			'deleted' => array(
				'matching'=>'',
				'value'=>0,
			),
		),
		'keys' => array(
			'contacts' => array(
				'from_column' => 'id', // primary key in foreign table
				'to_column' => 'contact_id', // foreign key in primary table
				'conditions' => array(
					'deleted' => array(
						'matching'=>'',
						'value'=>0,
					),
				),
			),
			'smsevent' => array(
				'from_column' => 'id', // primary key in foreign table
				'to_column' => 'event_id', // foreign key in primary table
				'conditions' => array(
					'deleted' => array(
						'matching'=>'',
						'value'=>0,
					),
				),
			),
		),
	),
);


/**
 * Key Collection
 *
 * Takes the value of from_column and updates primary table's to_column
 */
foreach($primary as $to=>$params) {
	debug($params);
	$mastercondition		=	"";
	if(!empty($params['conditions'])) {
		$mastercondition			=	create_sql_condition($to, $params['conditions']);
		$mastercondition	=	"WHERE ".implode(", ",$mastercondition);
	}
	if(!empty($params['keys'])) {
		foreach($params['keys'] as $from=>$fromparams) {
			$subcondition			=	create_sql_condition($from, $fromparams['conditions']);
			$subcondition			=	"WHERE ".implode(", ",$subcondition);
			$mastergetter			=	"SELECT ".$from.".".$fromparams['from_column']." FROM ".$from." ".$subcondition." ORDER BY RAND() LIMIT 1";
			$queries[$from]		=	"UPDATE ".$to." SET ".$fromparams['to_column']."=(".$mastergetter.") ".$mastercondition."; ";
		}
	}
}
debug($queries);

/**
 * Key Distribution
 *
 * Takes the value of primary table's to_column and updates from.from_column
 */

$foreign = array(
	'contacts' => array(
		'from_column' => 'id', // primary key in foreign table
		'to_column' => 'contact_id', // foreign key in primary table
		'conditions' => array(
			'deleted' => array(
				'matching'=>'',
				'value'=>0,
			),
		),
	),
	'smsevent' => array(
		'from_column' => 'id', // primary key in foreign table
		'to_column' => 'event_id', // foreign key in primary table
		'conditions' => array(
			'deleted' => array(
				'matching'=>'',
				'value'=>0,
			),
		),
	),
);

$primary = array(
	'event_contacts' => array(
		'conditions' => array(
			'deleted' => array(
				'matching'=>'',
				'value'=>0,
			),
		),
		'keys' => $foreign,
	),
);

foreach($foreign as $from=>$fromparams) {
	$mastercondition		=	"";
	if(!empty($params['conditions'])) {
		$mastercondition			=	create_sql_condition($from, $fromparams['conditions']);
		$mastercondition	=	"WHERE ".implode(", ",$mastercondition);
	}
	foreach($primary as $to=>$params) {
		$subcondition			=	create_sql_condition($to, $params['conditions']);
		$subcondition			=	"WHERE ".implode(", ",$subcondition);
		$mastergetter			=	"SELECT ".$to.".".$fromparams['to_column']." FROM ".$to." ".$subcondition." ORDER BY RAND() LIMIT 1";
		$queries[$from]		=	"UPDATE ".$from." SET ".$fromparams['from_column']."=(".$mastergetter.") ".$mastercondition."; ";
	}
}
debug($queries);
