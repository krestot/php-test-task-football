<?php 
/**
* 
*/
class Football
{
	/**
	 * Conduct a json decode
	 *
	 * @param  string $url_to_json
	 * @return array $raw_data
	 */
	static private function parse($url_to_json)
	{
		$string = file_get_contents($url_to_json);
		$raw_data = json_decode($string);
		return $raw_data;

	}
	/**
	 * Builds a view of the specific json-log.
	 *
	 * @param string  $source_file
	 * @param string  $result_directory_url
	 * @return void
	 */

	static public function buildDirectLog($source_file, $result_directory_url = FOOTBALL_RESULT_DIR )
	{
		$raw_data = self::parse($source_file);
		$basename = basename($source_file,".json");
		$match = MatchMaker::makeReadyMatch($raw_data);
		ob_start();
		require FOOTBALL_TEMPLATES_DIR.'/template.php';

		$file_string = ob_get_contents();
		ob_clean();
		$f = fopen("{$result_directory_url}/{$basename}.html","w");
		fwrite($f ,"{$file_string}");
		fclose($f);

	}

	/**
	 * Builds a views of json-logs for the specific period of time.
	 * @param  int $time_limit
	 * @param  string $source_directory_url
	 * @param  string $result_directory_url
	 * @return int $count
	 */

	static public function buildLatestLogs(int $time_limit, string $source_directory_url = FOOTBALL_SOURCE_DIR, string $result_directory_url = FOOTBALL_RESULT_DIR)
	{
		$source_directory_url .= "/*.json";
		$files = glob($source_directory_url);
		$times = [];		
		$currentTime = time();
		$time_ago = $currentTime - ($time_limit*3600);		
		$count = 0;
		foreach ($files as $file) {
			$times[] = filemtime($file);
		}
		for($i = 0;$i<count($times);$i++){
			if($times[$i] >= $time_ago){
				self::buildDirectLog($files[$i],$source_directory_url);
				$count++;
			}
		}
		return $count;
	}

	/**
	 * Builds a views of all json-logs.
	 *
	 * @param  string $source_directory_url
	 * @param  string $result_directory_url
	 * @return int $count
	 */

	static public function buildAllLogs($source_directory_url = FOOTBALL_SOURCE_DIR, $result_directory_url = FOOTBALL_RESULT_DIR)
	{	
		$source_directory_url .= "/*.json";
		$files = glob($source_directory_url);		
		$count = 0;
		foreach ($files as $file) {
			self::buildDirectLog($file,$result_directory_url);
			$count++;
		}
		return $count;
	}
	static public function returnDirectLogView($source_directory_url)
	{

	}
}