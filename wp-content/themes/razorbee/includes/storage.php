<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage GREENTHUMB
 * @since GREENTHUMB 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('greenthumb_storage_get')) {
	function greenthumb_storage_get($var_name, $default='') {
		global $GREENTHUMB_STORAGE;
		return isset($GREENTHUMB_STORAGE[$var_name]) ? $GREENTHUMB_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('greenthumb_storage_set')) {
	function greenthumb_storage_set($var_name, $value) {
		global $GREENTHUMB_STORAGE;
		$GREENTHUMB_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('greenthumb_storage_empty')) {
	function greenthumb_storage_empty($var_name, $key='', $key2='') {
		global $GREENTHUMB_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($GREENTHUMB_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($GREENTHUMB_STORAGE[$var_name][$key]);
		else
			return empty($GREENTHUMB_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('greenthumb_storage_isset')) {
	function greenthumb_storage_isset($var_name, $key='', $key2='') {
		global $GREENTHUMB_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($GREENTHUMB_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($GREENTHUMB_STORAGE[$var_name][$key]);
		else
			return isset($GREENTHUMB_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('greenthumb_storage_inc')) {
	function greenthumb_storage_inc($var_name, $value=1) {
		global $GREENTHUMB_STORAGE;
		if (empty($GREENTHUMB_STORAGE[$var_name])) $GREENTHUMB_STORAGE[$var_name] = 0;
		$GREENTHUMB_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('greenthumb_storage_concat')) {
	function greenthumb_storage_concat($var_name, $value) {
		global $GREENTHUMB_STORAGE;
		if (empty($GREENTHUMB_STORAGE[$var_name])) $GREENTHUMB_STORAGE[$var_name] = '';
		$GREENTHUMB_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('greenthumb_storage_get_array')) {
	function greenthumb_storage_get_array($var_name, $key, $key2='', $default='') {
		global $GREENTHUMB_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($GREENTHUMB_STORAGE[$var_name][$key]) ? $GREENTHUMB_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($GREENTHUMB_STORAGE[$var_name][$key][$key2]) ? $GREENTHUMB_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('greenthumb_storage_set_array')) {
	function greenthumb_storage_set_array($var_name, $key, $value) {
		global $GREENTHUMB_STORAGE;
		if (!isset($GREENTHUMB_STORAGE[$var_name])) $GREENTHUMB_STORAGE[$var_name] = array();
		if ($key==='')
			$GREENTHUMB_STORAGE[$var_name][] = $value;
		else
			$GREENTHUMB_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('greenthumb_storage_set_array2')) {
	function greenthumb_storage_set_array2($var_name, $key, $key2, $value) {
		global $GREENTHUMB_STORAGE;
		if (!isset($GREENTHUMB_STORAGE[$var_name])) $GREENTHUMB_STORAGE[$var_name] = array();
		if (!isset($GREENTHUMB_STORAGE[$var_name][$key])) $GREENTHUMB_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$GREENTHUMB_STORAGE[$var_name][$key][] = $value;
		else
			$GREENTHUMB_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('greenthumb_storage_merge_array')) {
	function greenthumb_storage_merge_array($var_name, $key, $value) {
		global $GREENTHUMB_STORAGE;
		if (!isset($GREENTHUMB_STORAGE[$var_name])) $GREENTHUMB_STORAGE[$var_name] = array();
		if ($key==='')
			$GREENTHUMB_STORAGE[$var_name] = array_merge($GREENTHUMB_STORAGE[$var_name], $value);
		else
			$GREENTHUMB_STORAGE[$var_name][$key] = array_merge($GREENTHUMB_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('greenthumb_storage_set_array_after')) {
	function greenthumb_storage_set_array_after($var_name, $after, $key, $value='') {
		global $GREENTHUMB_STORAGE;
		if (!isset($GREENTHUMB_STORAGE[$var_name])) $GREENTHUMB_STORAGE[$var_name] = array();
		if (is_array($key))
			greenthumb_array_insert_after($GREENTHUMB_STORAGE[$var_name], $after, $key);
		else
			greenthumb_array_insert_after($GREENTHUMB_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('greenthumb_storage_set_array_before')) {
	function greenthumb_storage_set_array_before($var_name, $before, $key, $value='') {
		global $GREENTHUMB_STORAGE;
		if (!isset($GREENTHUMB_STORAGE[$var_name])) $GREENTHUMB_STORAGE[$var_name] = array();
		if (is_array($key))
			greenthumb_array_insert_before($GREENTHUMB_STORAGE[$var_name], $before, $key);
		else
			greenthumb_array_insert_before($GREENTHUMB_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('greenthumb_storage_push_array')) {
	function greenthumb_storage_push_array($var_name, $key, $value) {
		global $GREENTHUMB_STORAGE;
		if (!isset($GREENTHUMB_STORAGE[$var_name])) $GREENTHUMB_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($GREENTHUMB_STORAGE[$var_name], $value);
		else {
			if (!isset($GREENTHUMB_STORAGE[$var_name][$key])) $GREENTHUMB_STORAGE[$var_name][$key] = array();
			array_push($GREENTHUMB_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('greenthumb_storage_pop_array')) {
	function greenthumb_storage_pop_array($var_name, $key='', $defa='') {
		global $GREENTHUMB_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($GREENTHUMB_STORAGE[$var_name]) && is_array($GREENTHUMB_STORAGE[$var_name]) && count($GREENTHUMB_STORAGE[$var_name]) > 0) 
				$rez = array_pop($GREENTHUMB_STORAGE[$var_name]);
		} else {
			if (isset($GREENTHUMB_STORAGE[$var_name][$key]) && is_array($GREENTHUMB_STORAGE[$var_name][$key]) && count($GREENTHUMB_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($GREENTHUMB_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('greenthumb_storage_inc_array')) {
	function greenthumb_storage_inc_array($var_name, $key, $value=1) {
		global $GREENTHUMB_STORAGE;
		if (!isset($GREENTHUMB_STORAGE[$var_name])) $GREENTHUMB_STORAGE[$var_name] = array();
		if (empty($GREENTHUMB_STORAGE[$var_name][$key])) $GREENTHUMB_STORAGE[$var_name][$key] = 0;
		$GREENTHUMB_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('greenthumb_storage_concat_array')) {
	function greenthumb_storage_concat_array($var_name, $key, $value) {
		global $GREENTHUMB_STORAGE;
		if (!isset($GREENTHUMB_STORAGE[$var_name])) $GREENTHUMB_STORAGE[$var_name] = array();
		if (empty($GREENTHUMB_STORAGE[$var_name][$key])) $GREENTHUMB_STORAGE[$var_name][$key] = '';
		$GREENTHUMB_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('greenthumb_storage_call_obj_method')) {
	function greenthumb_storage_call_obj_method($var_name, $method, $param=null) {
		global $GREENTHUMB_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($GREENTHUMB_STORAGE[$var_name]) ? $GREENTHUMB_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($GREENTHUMB_STORAGE[$var_name]) ? $GREENTHUMB_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('greenthumb_storage_get_obj_property')) {
	function greenthumb_storage_get_obj_property($var_name, $prop, $default='') {
		global $GREENTHUMB_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($GREENTHUMB_STORAGE[$var_name]->$prop) ? $GREENTHUMB_STORAGE[$var_name]->$prop : $default;
	}
}
?>