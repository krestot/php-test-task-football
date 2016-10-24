<?php 
function __autoload($class_name){

	require_once FOOTBAL_CLASSES_DIR."/{$class_name}.php";
}
