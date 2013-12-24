var grid_width = 8;
var grid_height = 8;
var grid_size = grid_height * grid_width;


var ducks_suited = "FALSE";
var strikes = 5;
var game_lost = "FALSE";
var pend_post = "FALSE";
var hide_color = '#EEEFFF';

// total number of ducks hiding
var my_ducks = grid_height * grid_width;
var party_time = 0;
var wait_time = 0;

// colors for different suits
var color_array = Array(
	'#CC88FF',
	'#99FF11',
	'#33CCFF',
	'#FFAA11'
);

$('#ducks_left').html(my_ducks);
$('#party_timer').html(party_time);

// set the party timer to update every 1 second, which also affects
// what time the game board becomes active (after 3 seconds)
var duck_timer = $.timer(function() {
	$('#party_timer').html(++party_time);

	if (++wait_time >= 2 && wait_time < 6) {
		$('#game_board').css({'opacity':'1', 'color':'black'});
		$('#message').html('OK, catch the rule-breakers!');
	}
});
duck_timer.set({time: 1000, autostart: false});

// the colors change every 3 seconds
var change_timer = $.timer(function() {
	set_colors();
});
change_timer.set({time: 2000, autostart: false});


// start afresh, reload the page
$('#restart').click(function() {
	if (pend_post == "TRUE") {
		$('#message').css("color", "red");
		$('#message').html("Post your stats first - because sharing is cool!");
	}
	else {
		location.reload();
	}
});


// add duck class to certain squares
$('#suit').click(function() {
	$('#message').html('&nbsp;');

	if (pend_post == "TRUE") {}
	else if (game_lost == "TRUE") {
		$('#message').css("color", "black");
		$('#message').html("Sorry Charly, you lost.");
	}
	else if(ducks_suited == "TRUE") {
		$('#message').css("color", "red");
		$('#message').html("C'mon, look: they're already suited! Now START timer!");
	}
	else {
		set_colors();

		ducks_suited = "TRUE";
		$('#ducks_left').html(my_ducks);

		$('#message').css("color", "black");
		$('#message').html("OK, the ducks have chosen colors!");

		$('#suit').css("box-shadow", "0px 0px 0px #000");
		$('#start_timer').css("box-shadow", "0px 0px 10px #FFAA11");
	}

});


//reveal all of the duck locations
$('#start_timer').click(function() {

	if (pend_post == "TRUE") {}
	else if (ducks_suited == "FALSE") {
		$('#message').css("color", "#FF3333");
		$('#message').html("You've got to tell them ducks to suit up first!");
	}
	else {
		console.log("REVEAL clicked");
		duck_timer.play();
		change_timer.play();

		$('#game_board').css('opacity', '0.6');
		$('#message').html('Wait for it...');
	}
});


function set_colors() {

	for (var i = 0; i <= 7; i++) {
		for (var j = 0; j <= 7; j++) {
			if ($('#' + i + j).attr("class") == 'dead') {
				continue;
			}
			else {
				var duck_class = $('#' + i + j).attr('class');
				var curr_color = grab_color(duck_class);

				$('#' + i + j).attr("class", "square " + curr_color);

				var color_index = Math.floor(Math.random() * 3);
				var duck_color = color_array[color_index];

				$('#' + i + j).css('background-color', duck_color);
				$('#' + i + j).addClass(duck_color);
			}
		}
	}
}


// check what's going on with a certain hiding square, and change its background accordingly
$('.square').click(function() {

	// if you already lost the game, unclickable
	if (game_lost == "TRUE") {
		$('#message').css("color", "black");
		$('#message').html("Sorry Charly, you lost.");
	}
	// if you haven't hidden the ducks yet, unclickable
	else if (ducks_suited == "FALSE") {
		$('#message').css("color", "#FF3333");
		$('#message').html("You've got to tell them ducks to suit up first!");
	}
	// if you've already found all the ducks, unclickable
	else if (my_ducks == 0) {
		$('#message').css({"color":"black", "font-weight":"bold"});
		$('#message').html("You found them first! All the ducks are safe.<br>You can cuddle them in your backyard.");
	}
	else if (wait_time < 2) {}
	else if ($(this).attr("class") == 'dead') {}

	// otherwise, check to see if there is a duck in this hiding square
	else {
		var duck_id = $(this).attr('id');
		var duck_class = $(this).attr('class');
		
		var redress = check_duck(duck_class);

		// if the duck doesn't change, make him disappear, otherwise set to red.
		if (redress == "NO") {

			$(this).css('background-color', hide_color);
			my_ducks--;
			$('#ducks_left').html(my_ducks);

			// if there aren't any ducks left to find, end the game
			if (my_ducks == 0) {
				$('h1').html("YOU WON!");
				stop_game();
			}
			else {
				$('#message').css("color", "black");
				$('#message').html("Caught another rule-breakin' duck!");
			}		
		}

		// if the duck DID change clothes, Red out the square
		else {

			$('#message').css("color", "black");
			$('#message').html("Oof, not that one");
		
			my_ducks--;
			$('#ducks_left').html(my_ducks);

			$(this).css('background-color', 'red');				

			if (--strikes == 0) {
				$('h1').html("YOU LOSE.");
				stop_game();
			}

			console.log("Strikes at: " + strikes);
		}

		$(this).attr('class', 'dead');

		if (strikes == 0) {
			game_lost = "TRUE";
		}

	}

});

// stop the program when something completes
function stop_game() {
	// show the form for submitting results
	$('#endform').fadeToggle();
	$('#duckies').val($('#ducks_left').val());
	$('#game_board').css("opacity", "0.6");
	$('#start_timer').css('box-shadow', '0px 0px 0px');
	$('#restart').css({"opacity":"1", "box-shadow": "0px 0px 10px #FFAA11"});

	//turn off the timers
	duck_timer.stop();
	change_timer.stop();
	pend_post = "TRUE";
};

// check the square's classes to see if it contains 'target' (meaning a duck is hiding here)
function check_duck(duck_class) {

		// split the ID's by the nbsp delimiter
		var class_array = duck_class.split(" ");

		if (class_array.length == 2) {
			return "NO";
		}
		else {
			return "YES";
		}

};

//get the color for the hiding duck, which is the last term set in its list of classes
function grab_color(square_class) {

		// split the classess by the nbsp delimiter
		var class_array = square_class.split(" ");

		// set the duck's color to last term in class, which is the background color.
		var duck_color = "";

		for (i in class_array) {

			duck_color = class_array[i];

		}

		return duck_color;

}



