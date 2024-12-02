<?php

namespace AOC\TwentyTwentyFour;

use AOC\TwentyTwentyFour\Interfaces\Day;

class Day2 implements Day {
	private function get_input() {
		$input = file_get_contents( 'input.txt' );
		$input = explode( "\n", $input );
		return $input;
	}
  
	public function is_report_safe( $report ) {
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
  
	private function is_report_increasing_or_decreasing( $report_as_string, $run_with_dampener = false ) {
		$report = explode( ' ', $report_as_string );
		if ( ! $run_with_dampener ) {
			return $this->is_report_safe( $report );
		}
  
		// Get all variations of the report with one index removed each time.
		$variations = [];
		foreach ( $report as $key => $value ) {
			$variation = $report;
			unset( $variation[ $key ] );
			$variations[] = array_values( $variation );
		}
  
		return array_some( $variations, [ $this, 'is_report_safe' ] );
	}
  
	public function part_1(): void {
		$input = $this->get_input();
		$input = array_map(
			fn( $report ) => $this->is_report_increasing_or_decreasing( $report ) ? $report : 'unsafe',
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
  
	public function part_2(): void {
		$input =$this->get_input();
		$input = array_map(
			fn( $report ) => $this->is_report_increasing_or_decreasing( $report, true ) ? $report : 'unsafe',
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
}
