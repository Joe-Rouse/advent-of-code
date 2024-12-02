<?php

namespace AOC\TwentyTwentyFour;

use AOC\TwentyTwentyFour\Interfaces\Day;

class Day1 implements Day {
	private function sort_inputs() {
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
  
	public function part_1(): void {
		$lists       = $this->sort_inputs();
		$first_list  = $lists[0];
		$second_list = $lists[1];
  
		$distances = array_map(
			function ( $first_list_number, $second_list_number ) {
				return abs( $first_list_number - $second_list_number );
			},
			$first_list,
			$second_list 
		);
	
		$total_distance = array_sum( $distances );
		echo 'The total distance is: ' . $total_distance . PHP_EOL;
	}
  
	public function part_2(): void {
		$lists       = $this->sort_inputs();
		$first_list  = $lists[0];
		$second_list = $lists[1];
  
		$similarity_scores = array_map(
			function ( $number ) use ( $second_list ) {
				$second_list_occurrences = array_count_values( $second_list )[ $number ] ?? 0;
				return $number * $second_list_occurrences;
			},
			$first_list
		);
  
		$total_similarity_score = array_sum( $similarity_scores );
		echo 'The total similarity score is: ' . $total_similarity_score . PHP_EOL;
	}
}
