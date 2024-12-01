<?php

function sort_inputs() {
	$input = file_get_contents( 'input.txt' );
	$input = explode( "\n", $input );

	$first_list  = [];
	$second_list = [];
	foreach ( $input as $key => $value ) {
		$value         = explode( '   ', $value );
		$first_list[]  = $value[0];
		$second_list[] = $value[1];
	}

	sort( $first_list );
	sort( $second_list );

	return [ $first_list, $second_list ];
}

function value_frequency( $values, $value ) {
	$occurences = array_filter(
		$values,
		function ( $a ) use ( $value ) {
			return $a == $value;
		}
	);
	return count( $occurences );
}

function day_1_part_1() {
	$lists       = sort_inputs();
	$first_list  = $lists[0];
	$second_list = $lists[1];

	$distances = array_map(
		function ( $a, $b ) {
			return abs( $a - $b );
		},
		$first_list,
		$second_list 
	);
  
	$total_distance = array_sum( $distances );
	echo 'The total distance is: ' . $total_distance . PHP_EOL;
}

function day_1_part_2() {
	$lists       = sort_inputs();
	$first_list  = $lists[0];
	$second_list = $lists[1];

	$similarity_scores = array_map(
		function ( $a ) use ( $second_list ) {
			$second_list_occurences = value_frequency( $second_list, $a );
			return $a * $second_list_occurences;
		},
		$first_list
	);

	$total_similarity_score = array_sum( $similarity_scores );
	echo 'The total similarity score is: ' . $total_similarity_score . PHP_EOL;
}

day_1_part_1();
day_1_part_2();
