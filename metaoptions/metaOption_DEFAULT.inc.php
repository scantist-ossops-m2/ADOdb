<?php
/**
* Base Class for handling DEFAULT
*/
class metaOption_DEFAULT extends metaOption
{
	/*
	* We use this to get ANSI SQL ordering when used with
	* NOT NULL
	*/
	protected $priority = 5;
	
	function __construct()
	{
		$args         = func_get_args();
		$dict         = $args[0];
		$defaultValue = $args[1];
		
		if (!preg_match('/^[0-9\.]+$/',$defaultValue))
		{
			$defaultValue = $dict->NameQuote($defaultValue); 
			$defaultValue = "'$defaultValue'"; 
		}
		
		$this->text = 'DEFAULT ' . $defaultValue;
	}
}
?>
	