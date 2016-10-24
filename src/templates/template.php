
<? if ($condition): ?>
<? endif; ?>
<?php 
/*	reset($match->teams);
	$team1 = current($match);
	end($match->teams);
	$team2 = $match->teams[key($match)];
*/
	$arrKeys = array_keys($match->teams);
	$firstKey = $arrKeys[0];
	$lastKey = $arrKeys[count($arrKeys)-1];
	$team1 = $match->teams[$firstKey];
	$team2 = $match->teams[$lastKey];

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Football</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo FOOTBALL_ASSETS_DIR?>/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo FOOTBALL_ASSETS_DIR?>/main.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
				  <div class="panel-body">
				    <div class="row">
				    	<div class="team-1 col-md-2">
				    		<div class="startingLineup">
				    			<p>Стартовый состав</p>

				    			<?php foreach ($team1->players as $player): ?>
									<? if ($player->start_time === 0): ?>
				    					<div class="playerCard">
				    						<p class="name"><?php echo $player->name ?></p>
				    						<div class="number"><?php echo $player->number ?></div>
				    						<div class="details">
				    							<div class="playerName"><b>Имя: </b> <?php echo $player->name ?></div>
				    							<div class="playerNumber"><b>Номер: </b><?php echo $player->number ?></div>
				    							<div class="playerTotalTime"><b>Время на поле:</b> <?php echo $player->getTotalTime(); ?> мин</div>
				    							<div class="playerGoals">
				    								<b>Голы:</b>
				    								<?php foreach ($player->goals as $goal): ?>
														<i class="fa fa-futbol-o" aria-hidden="true"></i> <?php echo $goal ?> мин ,
				    								<?php endforeach; ?>
				    							</div>
				    							<div class="playerAssists">
				    								<b>Голевые передачи:</b>
				    								<?php foreach ($player->goal_assists as $assist): ?>
														<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <?php echo $assist ?> мин ,
				    								<?php endforeach; ?>
				    							</div>
				    							<div class="playerCards">
				    								<b>Карточки:</b>
				    								<?php foreach ($player->cards as $card): ?>
														<div class="<?php echo $card['color'] ?>Card"></div> <?php echo $card['time']?> мин ,
				    								<?php endforeach; ?>
				    							</div>
				    						</div>
				    					</div>
									<? endif; ?>
				    			<?php endforeach; ?>								
				    		</div>
							<div class="otherPlayers">
								<p>Запасные игроки</p>
				    			<?php foreach ($team1->players as $player): ?>
									<? if ($player->start_time !== 0): ?>
				    					<div class="playerCard">
				    						<p class="name"><?php echo $player->name ?></p>
				    						<div class="number"><?php echo $player->number ?></div>
				    						<div class="details">
				    							<div class="playerName"><b>Имя: </b> <?php echo $player->name ?></div>
				    							<div class="playerNumber"><b>Номер: </b><?php echo $player->number ?></div>
				    							<div class="playerTotalTime"><b>Время на поле:</b> <?php if($player->start_time !== -1)echo $player->getTotalTime().' мин'; ?> </div>
				    							<div class="playerGoals">
				    								<b>Голы:</b>
				    								<?php foreach ($player->goals as $goal): ?>
														<i class="fa fa-futbol-o" aria-hidden="true"></i> <?php echo $goal ?> мин ,
				    								<?php endforeach; ?>
				    							</div>
				    							<div class="playerAssists">
				    								<b>Голевые передачи:</b>
				    								<?php foreach ($player->goal_assists as $assist): ?>
														<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <?php echo $assist ?> мин ,
				    								<?php endforeach; ?>
				    							</div>
				    							<div class="playerCards">
				    								<b>Карточки:</b>
				    								<?php foreach ($player->cards as $card): ?>
														<div class="<?php echo $card['color'] ?>Card"></div> <?php echo $card['time']?> мин ,
				    								<?php endforeach; ?>
				    							</div>
				    						</div>
				    					</div>
									<? endif; ?>
				    			<?php endforeach; ?>
							</div>
				    	</div>
				    	<div class="preview col-md-8">
				    		<!-- <div class="stadium">
				    			<p class="stadium_country">Страна : Россия</p>
				    			<p class="stadium_city">Город : Москва</p>
				    			<p class="stadium_name">Стадион : Лужники</p>
				    		</div> -->
				    		<div class="teams">
				    			<div class="row">
				    				<div class="col-md-12">
				    					<p class="title">Итог встречи</p>
				    					<hr>
				    				</div>
				    				<div class="col-md-6"><p class="teamEntry"><?php echo $team1->title; ?></p></div>
				    				<div class="col-md6"><p class="teamEntry"><?php echo $team2->title; ?></p></div>
				    			</div>
				    		</div>
				    		<div class="finalScore">
				    			<div class="divisor">:</div>
				    			<div class="row">
				    				<div class="col-md-6"><p class="scoreEntry"><?php  echo count($team1->goals); ?></p></div>
				    				<div class="col-md-6"><p class="scoreEntry"><?php  echo count($team2->goals); ?></p></div>
				    			</div>
				    		</div>
				    		<div class="goals">
				    			<div class="row">
				    				<div class="col-md-6">
				    					<?php foreach ($team1->goals as $goal): ?>
				    					    <div class="goalEntry">
				    					    	<?php echo $goal['author']->name ?> <i class="fa fa-futbol-o" aria-hidden="true"></i> <?php echo $goal['time'] ?> мин
				    					    </div>
				    					<?php endforeach; ?>
				    				</div>
				    				<div class="col-md-6">
				    					<?php foreach ($team2->goals as $goal): ?>
				    					    <div class="goalEntry">
				    					    	<?php echo $goal['author']->name ?> <i class="fa fa-futbol-o" aria-hidden="true"></i> <?php echo $goal['time'] ?> мин
				    					    </div>
				    					<?php endforeach; ?>
				    				</div>
				    			</div>
				    		</div>

				    		<div class="replacements">
				    			<div class="row">
				    				<div class="col-md-12">
				    					<p class="title">Замены</p>
				    					<hr>
				    				</div>
				    				<div class="col-md-6 team-1">
				    					<?php foreach ($team1->replacements as $replacement): ?>
				    					    <div class="replacement">
				    					    	<div class="in playerCard">
				    					    		<p class="name"><?php echo $replacement['in_player']->name ?></p>
				    					    		<div class="number"><?php echo $replacement['in_player']->number ?></div>
				    					    	</div>
				    					    	<div class="inTriangle"></div>
				    					    	<div class="out playerCard">
				    					    		<p class="name"><?php echo $replacement['out_player']->name ?></p>
				    					    		<div class="number"><?php echo $replacement['out_player']->number ?></div>
				    					    	</div>
				    					    	<div class="outTriangle"></div>
				    					    	<div class="replaceTime"><i class="fa fa-refresh" aria-hidden="true"></i> <b><?php echo $replacement['time'] ?> мин</b></div>
				    					    </div>
				    					<?php endforeach; ?>
				    				</div>
				    				<div class="col-md-6 team-2">
				    					<?php foreach ($team2->replacements as $replacement): ?>
				    					    <div class="replacement">
				    					    	<div class="in playerCard">
				    					    		<p class="name"><?php echo $replacement['in_player']->name ?></p>
				    					    		<div class="number"><?php echo $replacement['in_player']->number ?></div>
				    					    	</div>
				    					    	<div class="inTriangle"></div>
				    					    	<div class="out playerCard">
				    					    		<p class="name"><?php echo $replacement['out_player']->name ?></p>
				    					    		<div class="number"><?php echo $replacement['out_player']->number ?></div>
				    					    	</div>
				    					    	<div class="outTriangle"></div>
				    					    	<div class="replaceTime"><i class="fa fa-refresh" aria-hidden="true"></i> <b><?php echo $replacement['time'] ?> мин</b></div>
				    					    </div>
				    					<?php endforeach; ?>
				    				</div>
				    			</div>
				    		</div>
				    	</div>
				    	<div class="team-2 col-md-2">
				    		<div class="startingLineup">
				    			<p>Стартовый состав</p>
				    			<?php foreach ($team2->players as $player): ?>
									<? if ($player->start_time === 0): ?>
				    					<div class="playerCard">
				    						<p class="name"><?php echo $player->name ?></p>
				    						<div class="number"><?php echo $player->number ?></div>
				    						<div class="details">
				    							<div class="playerName"><b>Имя: </b> <?php echo $player->name ?></div>
				    							<div class="playerNumber"><b>Номер: </b><?php echo $player->number ?></div>
				    							<div class="playerTotalTime"><b>Время на поле:</b> <?php echo $player->getTotalTime(); ?> мин</div>
				    							<div class="playerGoals">
				    								<b>Голы:</b>
				    								<?php foreach ($player->goals as $goal): ?>
														<i class="fa fa-futbol-o" aria-hidden="true"></i> <?php echo $goal ?> мин ,
				    								<?php endforeach; ?>
				    							</div>
				    							<div class="playerAssists">
				    								<b>Голевые передачи:</b>
				    								<?php foreach ($player->goal_assists as $assist): ?>
														<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <?php echo $assist ?> мин ,
				    								<?php endforeach; ?>
				    							</div>
				    							<div class="playerCards">
				    								<b>Карточки:</b>
				    								<?php foreach ($player->cards as $card): ?>
														<div class="<?php echo $card['color'] ?>Card"></div> <?php echo $card['time']?> мин ,
				    								<?php endforeach; ?>
				    							</div>
				    						</div>
				    					</div>
									<? endif; ?>
				    			<?php endforeach; ?>	
				    		</div>
				    		<div class="otherPlayers">
				    			<p>Запасные игроки</p>
				    			<?php foreach ($team2->players as $player): ?>
									<? if ($player->start_time !== 0): ?>
				    					<div class="playerCard">
				    						<p class="name"><?php echo $player->name ?></p>
				    						<div class="number"><?php echo $player->number ?></div>
				    						<div class="details">
				    							<div class="playerName"><b>Имя: </b> <?php echo $player->name ?></div>
				    							<div class="playerNumber"><b>Номер: </b><?php echo $player->number ?></div>
				    							<div class="playerTotalTime"><b>Время на поле:</b> <?php if($player->start_time !== -1)echo $player->getTotalTime().' мин'; ?> </div>
				    							<div class="playerGoals">
				    								<b>Голы:</b>
				    								<?php foreach ($player->goals as $goal): ?>
														<i class="fa fa-futbol-o" aria-hidden="true"></i> <?php echo $goal ?> мин ,
				    								<?php endforeach; ?>
				    							</div>
				    							<div class="playerAssists">
				    								<b>Голевые передачи:</b>
				    								<?php foreach ($player->goal_assists as $assist): ?>
														<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <?php echo $assist ?> мин ,
				    								<?php endforeach; ?>
				    							</div>
				    							<div class="playerCards">
				    								<b>Карточки:</b>
				    								<?php foreach ($player->cards as $card): ?>
														<div class="<?php echo $card['color'] ?>Card"></div> <?php echo $card['time']?> мин ,
				    								<?php endforeach; ?>
				    							</div>
				    						</div>
				    					</div>
									<? endif; ?>
				    			<?php endforeach; ?>
				    		</div>
				    	</div>
				    </div>
				  </div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
				  <div class="panel-heading">События</div>
				  <div class="panel-body">
				    <table class="table table-condensed">
				      <tbody>
				      	<?php foreach ($match->messages as $message): ?>
					      	<tr>
					      		<td><b><?php echo $message->time ;?></b></td>
					      		<td><p class="<?php echo $message->type.'-message'; ?>"><?php echo $message->text ;?></p></td>
					      		<td class="icon">
					      		<?php 
					      			switch ($message->type) {
					      			    case 'goal':
					      			        echo "<i class='fa fa-futbol-o' aria-hidden='true'></i>";
					      			        break;
					      			    case 'yellowCard':
					      			        echo "<div class='yellowCard'></div>";
					      			        break;
					      			    case 'redCard':
					      			        echo "<div class='redCard'></div>";
					      			        break;
					      			    case 'replacePlayer':
					      			        echo "<i class='fa fa-refresh' aria-hidden='true'></i>";
					      			        break;
					      			}
					      		 ?>	
					      		</td>
					      	</tr>    
				      	<?php endforeach; ?>
				      </tbody>
				    </table>
				  </div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>