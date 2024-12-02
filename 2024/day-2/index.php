<?php

require_once __DIR__ . '/../utils.php';

function get_input() {
	$input = file_get_contents( 'input.txt' );
	$input = explode( "\n", $input );
	return $input;
}

function is_report_safe( $report ) {
	$increasing  = true;
	$decreasing  = true;
	$report_size = count( $report );

	for ( $i = 0; $i < $report_size - 1; $i++ ) {
		if ( $report[ $i ] > $report[ $i + 1 ] ) {
			$increasing = false;
		}
		if ( $report[ $i ] < $report[ $i + 1 ] ) {
			$decreasing = false;
		}

		$difference = abs( $report[ $i ] - $report[ $i + 1 ] );
		if ( $difference < 1 || $difference > 3 ) {
			$increasing = false;
			$decreasing = false;
		}
	}

	return $increasing || $decreasing;
}

function is_report_increasing_or_decreasing( $report_as_string, $run_with_dampener = false ) {
	$report = explode( ' ', $report_as_string );
	if ( ! $run_with_dampener ) {
		return is_report_safe( $report );
	}

	// Get all variations of the report with one index removed each time.
	$variations = [];
	foreach ( $report as $key => $value ) {
		$variation = $report;
		unset( $variation[ $key ] );
		$variations[] = array_values( $variation );
	}

	return array_some( $variations, 'is_report_safe' );
}

function day_2_part_1() {
	$input = get_input();
	$input = array_map(
		fn( $report ) => is_report_increasing_or_decreasing( $report ) ? $report : 'unsafe',
		$input 
	);
  
	$number_of_safe_reports = count(
		array_filter(
			$input,
			fn( $report ) => $report !== 'unsafe'
		) 
	);

	echo 'There are ' . $number_of_safe_reports . ' safe reports.' . PHP_EOL;
}

function day_2_part_2() {
	$input = get_input();
	$input = array_map(
		fn( $report ) => is_report_increasing_or_decreasing( $report, true ) ? $report : 'unsafe',
		$input 
	);
  
	$number_of_safe_reports = count(
		array_filter(
			$input,
			fn( $report ) => $report !== 'unsafe'
		) 
	);

	echo 'There are ' . $number_of_safe_reports . ' safe reports.' . PHP_EOL;
}

day_2_part_1();
day_2_part_2();
