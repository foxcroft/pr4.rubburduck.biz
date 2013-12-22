<!DOCTYPE html>

<html>

<!--
	<div class="drop_menu" id="signin_div" style="display: none;">
		<form id='signin_form'>
			<label for='name'>You are?</label>
			<input type='text' id='name' name='name'>
			<input type='submit' value='TAKE ME IN!'>
		</form>
		<span id='signin_results'>nada</span>
	</div>
	<div class="drop_menu" id="register_div" style="display: none;">
		<form id='reg_form' action="/users/p_signup">
			<label for='name'>You are?</label>
			<input type='text' id='name' name='name'>
			<input type='submit' value='SIGN ME UP!'>
		</form>
		<span id='reg_results'>nada</span>
	</div>
-->

	<br>
	<div id="title"><h1>DUCKS OF A DIFFERENT COLOUR</h1></div>
	
	<div id="patches">
		<div style="float: left; margin-left: 200px; margin-right: 20px;">COLOR KEY:: </div>
		<div class="patch" style="background-color: #FFFF11"></div>
		<div style="float: left;">HIDING SPOT</div>
		<div class="patch" style="background-color: #FF3333"></div>
		<div style="float: left;">NO DUCKS</div>
		<div class="patch" style="background-color: #CC88FF"></div>
		<div style="float: left;">2-DUCK CHAIN</div>
		<div class="patch" style="background-color: #99FF11"></div>
		<div style="float: left;">3-DUCK CHAIN</div>
		<div class="patch" style="background-color: #33CCFF"></div>
		<div style="float: left;">4-DUCK CHAIN</div>
		<div class="patch" style="background-color: #FFAA11"></div>
		<div style="float: left;">5-DUCK CHAIN</div>
	</div>

	<div id="frame">
		
		<div id="board">
			<div>
				<?php include 'squares.php'; ?>
			</div>

			<div>
				<br>
				<div id="message" style="clear: both;">&nbsp;</div>
				<br>

				<!-- Set buttons for starting and hiding -->
				<div id="buttons">
					<input type='button' id='start' value='START OVER'>
					<input type='button' id='suit' value='GET SUITED!'>
					<input type='button' id='reveal' value='START TIMER'>
				</div>
				<a href="/users/signup">SIGN UP</a>
			</div>
			<!-- 
			<div class="square open" id="e1"></div>
			<div class="square open" id="e2"></div>
			<div class="square open" id="e3"></div>
			<div class="square open" id="e4"></div>
			<div class="square open" id="e5"></div>
			-->

	 	</div>

		<div id='stats'>
			<div id='defense' style='font-size:13px;'>
				<div><h3>Limey! These ducks are having a party!</h3>
					It's one of those new parties you've been hearing about: ducks arrive
					in their own clothes, and then at the party, they change!</div>
				<div>These ducks have strict rules:
					every 3 seconds, ducks must change clothes. Problem is, some are too
					lazy to change every 3 seconds.<br>
					As chaperone of the duck party, it is your sworn duty to kick out
					rule-breakers. If you see a duck wearing the same color outfit
					two turns in a row, click him (or her) out!</div><br>
				<div>Be careful not to click on a duck who obeyed the rules though. There's a 
					three strike policy, after which, you'll be <em>fired.</em></div><br>
				<div>Click <strong>GET SUITED!</strong> to get all the ducks dressed up!
					Then click START TIMER to start catching cheaters.</div><br>
				<div>See how quickly you can catch them all cheating! <em>Everyone cheats eventually...</em></div><br>
			</div>
			<div id="duck_number">How many ducks are still at the party?</div><div id='ducks_left'></div>
			<br>
			<div style="font-size: 20px;">PARTY TIMER: <span id="party_timer"></span></div>
			<div id="bann_status"></div>
			<div id="badelynge_hit"></div>
		</div>

		<div id="endform">
			<div>
				How did you do?
				<form id="end_form">
					<label for='ducks'>Ducks left</label>
					<input type='text' id='duckies' name='ducks_left'>
					<label for='strikes'>Strikes</label>
					<input type='text' id='strikies' name='strikes'>
					<label for='time'>Party Timer</label>
					<input type='text' id='timies' name='time_elapsed'>
					<input type='submit' value='POST UP!'>
				</form>
			</div>
			<div id="end_results">END RESULTS</div><br><br>

			<div id="post_reel">POST REEL<br>
				<?php foreach($games as $game): ?>

					<?php $game_time = Time::display($game['created']);?>
					<span id="game_time"><?php echo $game_time;?></span><br>

					<span id="ducksleft"><strong>Ducks left: <?=$game['ducks_left']?></strong>:::
					Elapsed Time: <?=$game['time_elapsed']?></span>:::

					Strikes: <?=$game['strikes']?>
					<br><br>

				<?php endforeach; ?>
			</div>
		</div>

	</div>

</html>