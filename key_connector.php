<?php
require_once('faker/autoload.php');
require_once('dblib.php');
require_once('config.php');

$limit = 69;

$primary = array(
	'contacts' => array( // primary table
		'conditions' => array(
			'deleted' => array(
				'matching'=>'',
				'value'=>0,
			),
		),
		'keys' => array(
			'resources' => array( // foreign table
				'from_column' => 'id', // primary key in foreign table
				'to_column' => 'school_id', // foreign key in primary table
				'conditions' => array(
					'category' => array(
						'matching'=>'',
						'value'=>'school',
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
$queries	=	array();
foreach($primary as $to=>$params) {
	$mastercondition		=	"";
	if(!empty($params['conditions'])) {
		$mastercondition			=	create_sql_condition($to, $params['conditions']);
		$mastercondition	=	"WHERE ".implode("AND ",$mastercondition);
	}
	if(!empty($params['keys'])) {
		foreach($params['keys'] as $from=>$fromparams) {
			$subcondition			=	create_sql_condition($from, $fromparams['conditions']);
			$subcondition			=	"WHERE ".implode("AND ",$subcondition);
			$mastergetter			=	"SELECT ".$from.".".$fromparams['from_column']." FROM ".$from." ".$subcondition." ORDER BY RAND() LIMIT 1";
			$queries[]		=	"UPDATE ".$to." SET ".$fromparams['to_column']."=(".$mastergetter.") ".$mastercondition." ORDER BY RAND() LIMIT ".$limit."; ";
		}
	}
}
debug($queries);