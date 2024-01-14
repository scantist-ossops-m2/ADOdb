<?php
/**
* This is the format of the logging object, that is encoded into the log record
* If JSON logging is used
*
* This file is part of the ADOdb package.
*
* @copyright 2023 Mark Newnham
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/
namespace ADOdb\LoggingPlugin;

class ADOjsonLogFormat
{
	/*
	* The ADOdb log format version
	*/
	public string $version = '1.0';

	/*
	* The current AODdb version
	*/
	public ?string $ADOdbVersion = '';

	/*
	* THe required logging level
	*/
	public string $level = '0';
	
	/*
	* Standard non-error message
	*/
	public string $shortMessage = '';

	/*
	* The SQL statement and bind statement
	*/
	public array $sqlStatement = array('sql'=>'','params'=>'');

	/*
	* Any error code generated
	*/
	public int $errorCode = 0;
	
	/*
	* Any error message generated
	*/
	public string $errorMessage = '';

	/*
	* Any meta-error code generated
	*/
	public int $metaErrorCode = 0;
	
	/*
	* Any meta-error message generated
	*/
	public string $metaErrorMessage = '';

    /*
    * Extended data, such as a backtrace
    */
    public ?array $callStack;

    /****************************************************
     * Information below is identical no matter which
     * type of message is sent
     ****************************************************/

    /*
	* The host name
	*/
	public string $host = '';

	/*
	* Whether it is CLI or CGI
	*/
	public string $source = '';

	/*
	* The ADOdb driver
	*/
	public string $driver = '';

	/*
	* The PHP version
	*/
	public string $php = '';

	/*
	* The OS Version
	*/
	public string $os  = '';


	/**
	* Constructor
	*
	* @param ADOConnection $connection
	*/
    public function __construct(?object $connection)
	{
		global $ADODB_vers;

		$this->php    		= PHP_VERSION;
		$this->os     		= PHP_OS;
		$this->ADOdbVersion = $ADODB_vers;

		$this->source = isset($_SERVER['HTTP_USER_AGENT']) ? 'cgi' : 'cli';
        $this->host    = gethostname();

		if ($connection)
		{
			$this->driver       = $connection->databaseType;
			$this->ADOdbVersion	= $connection->version();
		}
	}


}