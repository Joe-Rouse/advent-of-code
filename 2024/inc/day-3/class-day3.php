<?php

namespace AOC\TwentyTwentyFour;

use AOC\TwentyTwentyFour\Interfaces\Day;

class Day3 implements Day {  
	public function part_1(): void {
		$input   = file_get_contents( 'input.txt' );
		$pattern = '/mul\((\d{1,3}),(\d{1,3})\)/';
		preg_match_all( $pattern, $input, $instructions );

		$results = [];
		foreach ( $instructions[0] as $key => $instruction ) {
			$results[] = intval( $instructions[1][$key] ) * intval( $instructions[2][$key] );
		}
		
		echo 'The results of all multiplications is: ' . array_sum( $results ) . PHP_EOL;
	}
  
	public function part_2(): void {
		$input   = file_get_contents( 'input.txt' );
		$pattern = '/(?:(do\(\)|don\'t\(\))|mul\((\d{1,3}),(\d{1,3})\))/';
		preg_match_all( $pattern, $input, $matches, PREG_SET_ORDER );
	
		$results = [];
		$state   = true;
		foreach ( $matches as $match ) {
			if ( $match[ 1 ] === 'do()' ) {
				$state = true;
			} elseif ( $match[ 1 ] === 'don\'t()' ) {
				$state = false;
			} elseif ( $state ) {
				$results[] = $match[ 2 ] * $match[ 3 ];
			}
		}

		echo 'The results of all multiplications is: ' . array_sum( $results ) . PHP_EOL;
	}
}
