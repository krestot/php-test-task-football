<?php 
/**
* 
*/
class MatchMaker
{	
	/**
	 * Return a new Match instance
	 *
	 * @param  array $raw_data
	 * @return Match 
	 */

	static private function makeMatch(array $raw_data){
		foreach ($raw_data as $entry) {
			
			if(($entry->type == 'startPeriod')&&($entry->time = 1)){
				$match = new Match($entry->details->stadium->county,$entry->details->stadium->city,$entry->details->stadium->stadium,$entry->details->team1,$entry->details->team2);
				return $match;
			}
		}
	}

	/**
	 * Fill a Match instance with the messages.
	 *
	 * @param  Match $match
	 * @param  array $raw_data
	 * @return void
	 */

	static private function fillMatch(Match $match,array $raw_data){
		foreach ($raw_data as $key => $entry) {
			$match->saveMessage($entry);
			if($entry->type == 'goal'){
				$match->teams[$entry->details->team]->writeGoalToTeam($entry->details->playerNumber,$entry->details->assistantNumber,$entry->time);
			}
			if($entry->type == 'yellowCard'){
				$match->teams[$entry->details->team]->giveCardToTeam($entry->details->playerNumber,$entry->time);
			}
			if($entry->type == 'redCard'){
				$match->teams[$entry->details->team]->giveCardToTeam($entry->details->playerNumber,$entry->time,true);
			}
			if($entry->type == 'replacePlayer'){
				$match->teams[$entry->details->team]->replaceTeamPlayer($entry->details->inPlayerNumber,$entry->details->outPlayerNumber,$entry->time); 
			}
			if(!isset($raw_data[++$key])){
				foreach($match->teams as $team){
					$team->endOfGame($entry->time);
				}
			}
		}
	}

	/**
	 * Return a Match instance with all filled Data
	 *
	 * @param  array $raw_data
	 * @return Match
	 */

	static public function makeReadyMatch(array $raw_data)
	{
		$match = self::makeMatch($raw_data);
		self::fillMatch($match,$raw_data);
		return $match;
	}
}