<?php 
/**
* 
*/
class Team
{
	/**
	 * Contains title of the Team.
	 *
	 * @var string
	 */

	public $title;

	/**
	 * Contains country of the Team.
	 *
	 * @var string
	 */

	public $country;

	/**
	 * Contains name of Teams coach .
	 *
	 * @var string
	 */

	public $coach;

	/**
	 * Contains Teams goals.
	 *
	 * @var array
	 */

	public $goals = [];

	/**
	 * Contains Team Players.
	 *
	 * @var array
	 */

	public $players = [];

	/**
	 * Contains Teams replacement in Match.
	 *
	 * @var string
	 */

	public $replacements = [];

	/**
	 * Create a new Team inctance.
	 *
	 * @param  string $title
	 * @param  string $country 
	 * @param  string $coach
	 * @param  array $players
	 * @param  array $starting_lineup_numbers
	 * @return void
	 */

	function __construct($title,$country,$coach,$players,$starting_lineup_numbers)
	{
		$this->title = $title;
		$this->coach = $coach;
		$this->country = $country;
		$this->makeTeam($players);
		$this->makeStartingLineup($starting_lineup_numbers);
	}

	/**
	 * Fill players property with Player instances.
	 *
	 * @param  array $players
	 * @return void
	 */

	private function makeTeam(array $players)
	{
		foreach ($players as $player) {
			$this->players[$player->number] = new Player($player->name,$player->number);

		}
	}

	/**
	 * Set starting lineup players start time to 0;
	 *
	 * @param  array $starting_lineup_numbers
	 * @return void
	 */

	private function makeStartingLineup(array $starting_lineup_numbers)
	{
		foreach ($this->players as $player) {
			if(in_array($player->number,$starting_lineup_numbers) ){
				$player->setStartTime(0);
			}
		}
	}
	
	/**
	 * Replace $out_player by $in_player.
	 * Sets their end_time and start time to the proper value.
	 * Store new replace entry to the replace property.
	 *
	 * @param  int $in_player_number
	 * @param  int $out_player_number
	 * @param  int $time
	 * @return void
	 */

	public function replaceTeamPlayer($in_player_number,$out_player_number,$time)
	{
		$in_player = $this->players[$in_player_number];
		$out_player = $this->players[$out_player_number];
		$out_player->setEndTime($time);
		$in_player->setStartTime($time);
		$this->replacements[] = ['in_player'=>$in_player,'out_player'=>$out_player,'time'=>$time];
	}

	/**
	 * Store new goal entry to the Team goals, Player goals and Player goal_assissts properties.
	 *
	 * @param  int $author_number
	 * @param  int $assistant_number
	 * @param  int $time
	 * @return void
	 */

	public function writeGoalToTeam($author_number,$assistant_number,$time){
		$author = $this->players[$author_number];
		$author->writeGoalToPlayer($time);
		if($assistant_number != null){
			$assistant = $this->players[$assistant_number];
			$assistant->writeGoalAssist($time);
		}else{
			$assistant = $assistant_number;
		}
		$this->goals[] = ['author' => $author ,"assistant"=> $assistant ,"time" => $time];
	}

	/**
	 * Store card entry to the Players and Teams property.
	 *
	 * @param  int $player_number
	 * @param  int $time
	 * @param  bool $red
	 * @return void
	 */

	public function giveCardToTeam($player_number,$time,$red = false)
	{
		$player = $this->players[$player_number];
		$player->giveCardToPlayer($time);
	}

	/**
	 * Set all Teams Players end time property to the end game time.
	 *
	 * @param  int $time
	 * @return void
	 */

	public function endOfGame($time)
	{
		foreach ($this->players as $player) {
			if(!isset($player->end_time)){
				$player->setEndTime($time);
			}
		}
	}

}