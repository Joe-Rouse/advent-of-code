<?php

/**
 * Tests whether at least one element in the array passes the test implemented by the provided function. 
 *
 * @param  array    $array_to_check - Array to check.
 * @param  callable $test_fn - Test function.
 * @return boolean
 */
function array_some( array $array_to_check, callable $test_fn ) {
	foreach ( $array_to_check as $value ) {
		if ( $test_fn( $value ) ) {
			return true;
		}
	}
	return false;
}
