<?php 
/**
* 
*/
class Match 
{	
	/**
	 * Contains country of the Match stadium.
	 *
	 * @var string
	 */

	public $country;

	/**
	 * Contains city of the Match stadiun.
	 *
	 * @var string
	 */

	public $city;

	/**
	 * Contains name of the Match stadium.
	 *
	 * @var string
	 */

	public $stadium;

	/**
	 * Contains Matchs teams.
	 *
	 * @var array
	 */

	public $teams=[];

	/**
	 * Contains Matchs messages.
	 *
	 * @var array
	 */

	public $messages = [];

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  string $country
	 * @param  string $city
	 * @param  string $stadium
	 * @param  stdClass $team1
	 * @param  stdClass $team2
	 * @return void
	 */

	function __construct($country,$city,$stadium,$team1,$team2)
	{
		$this->country = $country;
		$this->city = $city;
		$this->stadium = $stadium;
		$this->makeTeam($team1);
		$this->makeTeam($team2);
	}

	/**
	 * Create a new Team instance and store it to the teams property
	 *
	 * @param  stdClass $team
	 * @return void
	 */

	private function makeTeam(stdClass $team)
	{	
		$this->teams[$team->title] = new Team($team->title,$team->country,$team->coach,$team->players,$team->startPlayerNumbers);
	}

	/**
	 * Create a new Message instance and store it in the messages property.
	 *
	 * @param  stdClass $message
	 * @return void
	 */

	public function saveMessage(stdClass $message)
	{
		$this->messages[] = new Message($message->description,$message->time,$message->type);
	}
}