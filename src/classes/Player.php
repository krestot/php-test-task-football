<?php 
/**
* 
*/
class Player
{	
	/**
	 * Contains name of the Player.
	 *
	 * @var string
	 */

	public $name;
	/**
	 * Contains number of the Player.
	 *
	 * @var int
	 */

	public $number;
	/**
	 * Contains player start time or -1 if the player hasn't been in the game.
	 *
	 * @var int
	 */

	public $start_time = -1;
	/**
	 * Contains player end time
	 *
	 * @var int
	 */

	public $end_time;
	/**
	 * Contains players goals.
	 *
	 * @var array
	 */

	public $goals = [];
	/**
	 * Contains players assists.
	 *
	 * @var array
	 */

	public $goal_assists = [];
	/**
	 * Contains players cards.
	 *
	 * @var array
	 */

	public $cards = [];

	/**
	 * Create a new Player instance.
	 *
	 * @param string $name
	 * @param int $number
	 * @return void
	 */

	function __construct($name,$number)
	{
		$this->name = $name;
		$this->number = $number;
	}

	/**
	 * Write new card to the cards property.
	 *
	 * @param  int $time
	 * @param  bool $red
	 * @return void
	 */

	public function giveCardToPlayer($time,$red = false)
	{
		if($red){
		$this->cards[] = ['color'=>'red','time'=>$time];
		$this->setEndTime($time);
		}else{
		$this->cards[] = ['color'=>'yellow','time'=>$time];
			if(count($this->cards)>1){
				$this->setEndTime($time);
			}
		}	
	}

	/**
	 * Set start_time property.
	 *
	 * @param  int $time
	 * @return void
	 */

	public function setStartTime($time){
		$this->start_time = $time;
	}

	/**
	 * Set end_time property.
	 *
	 * @param  int $time
	 * @return void
	 */

	public function setEndTime($time){
		$this->end_time = $time;
	}

	/**
	 * Write new goal to the goals property.
	 *
	 * @param  int $time
	 * @return void
	 */

	public function writeGoalToPlayer($time)
	{
		$this->goals[] = $time;
	}

	/**
	 * Write new goal assist to the goal_assists property.
	 *
	 * @param  int $time
	 * @return void
	 */

	public function writeGoalAssist($time)
	{
		$this->goal_assists[] = $time;
	}

	/**
	 * Return players total time.
	 *
	 * @return int 
	 */

	public function getTotalTime()
	{
		return $this->end_time - $this->start_time;
	}
}