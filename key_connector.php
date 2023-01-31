<?php
require_once('faker/autoload.php');
require_once('dblib.php');
require_once('config.php');

$limit = 69;

$primary = array(
	'practice_exam' => array( // primary table
		'conditions' => array(
			'id' => array(
				'matching'=>'=',
				'value'=>'',
			),
		),
		'keys' => array(
			'practice_overall_result' => array( // foreign table
				'from_column' => 'practice_exam_id', // primary key in foreign table
				'to_column' => 'id', // foreign key in primary table
				'conditions' => array(
					'id' => array(
						'matching'=>'=',
						'value'=>'',
					),
				),
			),
			'practice_exam_category' => array( // foreign table
				'from_column' => 'name', // primary key in foreign table
				'to_column' => 'exam_category', // foreign key in primary table
				'conditions' => array(
					'id' => array(
						'matching'=>'=',
						'value'=>'',
					),
				),
			),
		),
	),
);

// $primary = array(
	// 'seat' => array( // primary table
		// 'conditions' => array(
			// 'id' => array(
				// 'matching'=>'=',
				// 'value'=>'',
			// ),
		// ),
		// 'keys' => array(
			// 'seat_contacts' => array( // foreign table
				// 'from_column' => 'zaseki_id', // primary key in foreign table
				// 'to_column' => 'id', // foreign key in primary table
				// 'conditions' => array(
					// 'id' => array(
						// 'matching'=>'=',
						// 'value'=>'',
					// ),
				// ),
			// ),
			// 'event_seat' => array( // foreign table
				// 'from_column' => 'zaseki_id', // primary key in foreign table
				// 'to_column' => 'id', // foreign key in primary table
				// 'conditions' => array(
					// 'id' => array(
						// 'matching'=>'=',
						// 'value'=>'',
					// ),
				// ),
			// ),
			// 'between_seat' => array( // foreign table
				// 'from_column' => 'zaseki_id', // primary key in foreign table
				// 'to_column' => 'id', // foreign key in primary table
				// 'conditions' => array(
					// '' => array(
						// 'matching'=>'=',
						// 'value'=>'id',
					// ),
				// ),
			// ),
		// ),
	// ),
// );




// $primary = array(
	// 'seat_contacts' => array( // primary table
		// 'conditions' => array(
			// 'id' => array(
				// 'matching'=>'=',
				// 'value'=>'',
			// ),
		// ),
		// 'keys' => array(
			// 'seat' => array( // foreign table
				// 'from_column' => 'id', // primary key in foreign table
				// 'to_column' => 'zaseki_id', // foreign key in primary table
				// 'conditions' => array(
					// 'id' => array(
						// 'matching'=>'=',
						// 'value'=>'',
					// ),
				// ),
			// ),
		// ),
	// ),
// );
// $primary = array(
	// 'event_seat' => array( // primary table
		// 'conditions' => array(
			// 'id' => array(
				// 'matching'=>'=',
				// 'value'=>'',
			// ),
		// ),
		// 'keys' => array(
			// 'seat' => array( // foreign table
				// 'from_column' => 'id', // primary key in foreign table
				// 'to_column' => 'zaseki_id', // foreign key in primary table
				// 'conditions' => array(
					// 'id' => array(
						// 'matching'=>'=',
						// 'value'=>'',
					// ),
				// ),
			// ),
		// ),
	// ),
// );
// $primary = array(
	// 'between_seat' => array( // primary table
		// 'conditions' => array(
			// 'id' => array(
				// 'matching'=>'=',
				// 'value'=>'',
			// ),
		// ),
		// 'keys' => array(
			// 'seat' => array( // foreign table
				// 'from_column' => 'id', // primary key in foreign table
				// 'to_column' => 'zaseki_id', // foreign key in primary table
				// 'conditions' => array(
					// 'id' => array(
						// 'matching'=>'=',
						// 'value'=>'',
					// ),
				// ),
			// ),
		// ),
	// ),
// );





//$primary = array(
//	'sms_transaction' => array( // primary table
//		'conditions' => array(
//			'deleted' => array(
//				'matching'=>'',
//				'value'=>0,
//			),
//		),
//		'keys' => array(
//			'sms_fee' => array( // foreign table
//				'from_column' => 'id', // primary key in foreign table
//				'to_column' => 'fee_id', // foreign key in primary table
//				'conditions' => array(
//					'deleted' => array(
//						'matching'=>'=',
//						'value'=>'0',
//					),
//				),
//			),
//			'contacts' => array( // foreign table
//				'from_column' => 'id', // primary key in foreign table
//				'to_column' => 'contact_id', // foreign key in primary table
//				'conditions' => array(
//					'deleted' => array(
//						'matching'=>'=',
//						'value'=>'0',
//					),
//				),
//			),
//			'smsevent' => array( // foreign table
//				'from_column' => 'id', // primary key in foreign table
//				'to_column' => 'event_id', // foreign key in primary table
//				'conditions' => array(
//					'deleted' => array(
//						'matching'=>'=',
//						'value'=>'0',
//					),
//				),
//			),
//			'm_shohin' => array( // foreign table
//				'from_column' => 'id', // primary key in foreign table
//				'to_column' => 'm_shohin_id', // foreign key in primary table
//				'conditions' => array(
//					'deleted' => array(
//						'matching'=>'=',
//						'value'=>'0',
//					),
//				),
//			),
//			'sms_transactiontype' => array( // foreign table
//				'from_column' => 'id', // primary key in foreign table
//				'to_column' => 'type_id', // foreign key in primary table
//				'conditions' => array(
//					'deleted' => array(
//						'matching'=>'=',
//						'value'=>'0',
//					),
//				),
//			),
//		),
//	),
//);
//$primary = array(
//	'sms_transaction' => array( // primary table
//		'conditions' => array(
//			'deleted' => array(
//				'matching'=>'',
//				'value'=>0,
//			),
//		),
//		'keys' => array(
//			'contacts' => array( // foreign table
//				'from_column' => 'id', // primary key in foreign table
//				'to_column' => 'contact_id', // foreign key in primary table
//				'conditions' => array(
//					'deleted' => array(
//						'matching'=>'=',
//						'value'=>'0',
//					),
//				),
//			),
//			'sms_transactiontype' => array( // foreign table
//				'from_column' => 'id', // primary key in foreign table
//				'to_column' => 'type_id', // foreign key in primary table
//				'conditions' => array(
//					'deleted' => array(
//						'matching'=>'=',
//						'value'=>'0',
//					),
//				),
//			),
//			'sms_fee' => array( // foreign table
//				'from_column' => 'id', // primary key in foreign table
//				'to_column' => 'fee_id', // foreign key in primary table
//				'conditions' => array(
//					'deleted' => array(
//						'matching'=>'=',
//						'value'=>'0',
//					),
//				),
//			),
//			'smsevent' => array( // foreign table
//				'from_column' => 'id', // primary key in foreign table
//				'to_column' => 'event_id', // foreign key in primary table
//				'conditions' => array(
//					'deleted' => array(
//						'matching'=>'=',
//						'value'=>'0',
//					),
//				),
//			),
//		),
//	),
//	'event_contacts' => array( // primary table
//		'conditions' => array(
//			'deleted' => array(
//				'matching'=>'',
//				'value'=>0,
//			),
//		),
//		'keys' => array(
//			'smsevent' => array( // foreign table
//				'from_column' => 'id', // primary key in foreign table
//				'to_column' => 'event_id', // foreign key in primary table
//				'conditions' => array(
//					'deleted' => array(
//						'matching'=>'=',
//						'value'=>'0',
//					),
//				),
//			),
//		),
//	),
//);
//$primary = array(
//	'manual_transaction' => array( // primary table
//		'conditions' => array(),
//		'keys' => array(
//			'sms_transaction' => array( // foreign table
//				'from_column' => 'salesno', // primary key in foreign table
//				'to_column' => 'salesno', // foreign key in primary table
//				'conditions' => array(
//					'deleted' => array(
//						'matching'=>'=',
//						'value'=>'0',
//					),
//				),
//			),
//		),
//	),
//	'sms_transaction' => array( // primary table
//		'conditions' => array(
//			'deleted' => array(
//				'matching'=>'',
//				'value'=>0,
//			),
//		),
//		'keys' => array(
//			'sms_fee' => array( // foreign table
//				'from_column' => 'salesno', // primary key in foreign table
//				'to_column' => 'salesno', // foreign key in primary table
//				'conditions' => array(
//					'deleted' => array(
//						'matching'=>'=',
//						'value'=>'0',
//					),
//				),
//			),
//			'contacts' => array( // foreign table
//				'from_column' => 'id', // primary key in foreign table
//				'to_column' => 'contact_id', // foreign key in primary table
//				'conditions' => array(
//					'deleted' => array(
//						'matching'=>'=',
//						'value'=>'0',
//					),
//				),
//			),
//			'smsevent' => array( // foreign table
//				'from_column' => 'id', // primary key in foreign table
//				'to_column' => 'event_id', // foreign key in primary table
//				'conditions' => array(
//					'deleted' => array(
//						'matching'=>'=',
//						'value'=>'0',
//					),
//				),
//			),
//		),
//	),
//	'event_contacts' => array( // primary table
//		'conditions' => array(
//			'deleted' => array(
//				'matching'=>'',
//				'value'=>0,
//			),
//		),
//		'keys' => array(
//			'sms_transaction' => array( // foreign table
//				'from_column' => 'event_id', // primary key in foreign table
//				'to_column' => 'event_id', // foreign key in primary table
//				'conditions' => array(
//					'deleted' => array(
//						'matching'=>'=',
//						'value'=>'0',
//					),
//				),
//			),
//		),
//	),
//);
echo json_encode($primary);


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