<!DOCTYPE html>

<html>

	<div id="title"><h1>DUCKS OF A DIFFERENT COLOUR</h1></div>

	<div id="frame">
		
		<div id="board">
			<div id="game_board">
				<?php include 'squares.php'; ?>
			</div>

			<div>
				<br>
				<div id="message" style="clear: both;">&nbsp;</div>
				<br>

				<!-- Set buttons for starting and hiding -->
				<div id="buttons">
					<input type='button' id='restart' value='START OVER'>
					<input type='button' id='suit' value='GET SUITED!'>
					<input type='button' id='start_timer' value='START TIMER'>
				</div>
			</div>

	 	</div>

		<div id='stats'>
			<div id='defense' style='font-size:13px;'>
				<div><h3>Limey! These ducks are having a party!</h3>
					It's one of those new parties you've been hearing about: ducks arrive
					in their own clothes, and then at the party, they change!</div>
				<div>These ducks have strict rules:
					every 2 seconds, ducks must change clothes. Problem is, some are too
					lazy to change every 2 seconds.<br>
					As chaperone of the duck party, it is your sworn duty to kick out
					rule-breakers. If you see a duck wearing the same color outfit
					two turns in a row, click him (or her) out!</div><br>
				<div>Be careful not to click on a duck who obeyed the rules though. There's a 
					strict five strike policy, after which, you'll be <em>fired.</em></div><br>
				<div>Click <strong>GET SUITED!</strong> to get all the ducks dressed up!
					Then click START TIMER to start catching cheaters.</div><br>
				<div>See how quickly you can catch them all cheating! <em>Everyone cheats eventually...</em></div><br>
			</div>
			<div id="duck_number">How many ducks are still hanging out at the party?</div><div id='ducks_left'></div>
			<br>
			<div style="font-size: 28px;">PARTY TIMER: <span id="party_timer"></span></div>
		</div>

		<div style="clear: both;">&nbsp;</div>
		<div id="endform" style="display: none;">
			<div>
				<div style="text-align:center; font-size: 24px;">HOW DID YOU DO?</div><br>
				<form id="end_form">
					<label for='ducks'>Ducks left</label>
					<input type='text' id='duckies' name='ducks_left' maxlength="2">
					<label for='strikes'>Strikes</label>
					<input type='text' id='strikies' name='strikes' maxlength="1">
					<label for='time'>Party Timer</label>
					<input type='text' id='timies' name='time_elapsed' maxlength="3">
					<label for='initials'>Your Initials</label>
					<input type='text' id='inities' name='initials' maxlength="3">
					<input type='submit' value='POST UP!'>
				</form>
			</div>
			<div id="end_results">&nbsp;</div>
		</div>

		<div id="posting">
			<br>
			<h1>RECENT PARTIES</h1>
			<div id="post_reel"><br>
				<?php foreach($games as $game): ?>

					<div style="font-size: 24px; text-transform:uppercase;"><?=$game['initials']?></div>
					<?php $game_time = Time::display($game['created']);?>
					<span id="game_time"><?php echo $game_time;?></span><br>

					<span id="ducksleft"><strong>Ducks left: <?=$game['ducks_left']?></strong>&nbsp;&nbsp;&nbsp;
					Time: <?=$game['time_elapsed']?></span>&nbsp;&nbsp;&nbsp;

					Strikes: <?=$game['strikes']?>
					<br><br>

				<?php endforeach; ?>
			</div>
		</div>

	</div>

</html>