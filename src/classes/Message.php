<?php 
/**
* 
*/
class Message
{	
	/**
	 * Contains text of the message.
	 *
	 * @var string
	 */

	public $text;

	/**
	 * Contains time of the message.
	 *
	 * @var int
	 */

	public $time;

	/**
	 * Contains time of the message.
	 * 
	 * @var string
	 */

	public $type;

	/**
	 * Create a new Message instance.
	 *
	 * @param string $text 
	 * @param int $time
	 * @param string $type
	 * @return void
	 */

	function __construct($text,$time,$type)
	{
		$this->text = $text;
		$this->time = $time;
		$this->type = $type;
	}

}