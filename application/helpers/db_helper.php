<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/***********************************************************************
 * By Agus Prasetyo
 * email : agusprasetyo811@gmail.com
 ***********************************************************************/

# Read column in database
function show_table_column($query) {
	$field = json_decode(json_encode($query), true);
	return array_keys($field);
}

# Read column in json data
function show_json_column($json) {
	$field = json_decode($json, true);
	return array_keys($field);
}

# Convert Json to String
function show_json_column_text($json, $sparator, $sort_desc) {
	$field = json_decode($json, true);
	if ($sort_desc == false) {
		return implode($sparator, array_keys($field));
	} else {
		return implode($sparator, array_reverse(array_keys($field)));
	}
}

# Sorting Array
function sort_array_by_column(&$arr, $col, $dir = SORT_ASC) {
	$arr = json_decode(json_encode($arr), TRUE);
	$sort_col = array();
	foreach ($arr as $key=> $row) {
		$sort_col[$key] = $row[$col];
	}
	array_multisort($sort_col, $dir, $arr);
	return json_decode(json_encode($arr));
}

# Merge Array
function array_merge_assoc($array1, $array2) {
	if (sizeof($array1)>sizeof($array2)) {
		$size = sizeof($array1);
	} else {
		$a = $array1;
		$array1 = $array2;
		$array2 = $a;
		$size = sizeof($array1);
	}

	$keys2 = array_keys($array2);
	for($i = 0;$i<$size;$i++) {
		@$array1[$keys2[$i]] = $array1[$keys2[$i]] + $array2[$keys2[$i]];
	}
	$array1 = array_filter($array1);
	return $array1;
}


# Get unique array by sub key and return unique array
function array_uniqe_by_subkey($array, $key) {
	$indexAggregates = array();
	foreach ( $array as $idx => $subArray ) {
		$indexAggregates[$subArray[$key]][] = $idx;
	}

	foreach ($indexAggregates as $originalIndexes ) {
		$numOriginals = count( $originalIndexes );
		if ( 1 == $numOriginals ) {
			continue;
		}
		for ( $i = 1; $i < $numOriginals; $i++ ) {
			unset($array[$originalIndexes[$i]]);
		}
	}
	return array_values($array);
}

# Remove an empty value
function array_empty_remove($array, $remove_null_number = true) {
	$new_array = array();
	$null_exceptions = array();
	foreach ($array as $key => $value) {
		$value = trim($value);
		if($remove_null_number) {
			$null_exceptions[] = '0';
		}
		if(!in_array($value, $null_exceptions) && $value != "") {
			$new_array[] = $value;
		}
	}
	return $new_array;
}

# Remove varian by index
function array_remove_by_index($array, $index) {
	if (is_array($index)) {
		for($i=0; $i<count($array); $i++) {
			foreach ($index as $id) {
				unset($array[$id]);
			}
		}	
	} else {
		for($i=0; $i<count($array); $i++) {
			unset($array[$index]);
		}
	}
	return array_values($array);
}

# Array Search in multidimention and return ID of an array
function array_search_multidimention($value_search, $key_in, $array) {
	foreach ($array as $key => $val) {
		if ($val[$key_in] === $value_search) {
			return $key;
		}
	}
	return null;
}

# Sorting Array of Object
function sort_array_object_by_property( $array, $property ) {
	$cur = 1;
	$stack[1]['l'] = 0;
	$stack[1]['r'] = count($array)-1;
	do {
		$l = $stack[$cur]['l'];
		$r = $stack[$cur]['r'];
		$cur--;
		do {
			$i = $l;
			$j = $r;
			$tmp = $array[(int)( ($l+$r)/2 )];

			// split the array in to parts
			// first: objects with "smaller" property $property
			// second: objects with "bigger" property $property
			do {
				while( $array[$i]->{$property} < $tmp->{$property} ) $i++;
				while( $tmp->{$property} < $array[$j]->{$property} ) $j--;

				// Swap elements of two parts if necesary
				if( $i <= $j) {
					$w = $array[$i];
					$array[$i] = $array[$j];
					$array[$j] = $w;

					$i++;
					$j--;
				}
			} while ( $i <= $j );
			if( $i < $r ) {
				$cur++;
				$stack[$cur]['l'] = $i;
				$stack[$cur]['r'] = $r;
			}
			$r = $j;
		} while ( $l < $r );
	} while ( $cur != 0 );
	return $array;
}