var grid_width = 7;
var grid_height = 7;
var grid_size = grid_height * grid_width;


var ducks_suited = "FALSE";
var strikes = 3;
var game_lost = "FALSE";
var hide_color = '#EEEFFF';

// total number of ducks hiding
var my_ducks = grid_height * grid_width;
var party_time = 0;

// colors for different suits
var color_array = Array(
	'#CC88FF',
	'#99FF11',
	'#33CCFF',
	'#FFAA11'
);

$('#ducks_left').html(my_ducks);
$('#party_timer').html(party_time);

var duck_timer = $.timer(function() {
	$('#party_timer').html(++party_time);
});
duck_timer.set({time: 1000, autostart: false});

var change_timer = $.timer(function() {
	set_colors();
});
change_timer.set({time: 3000, autostart: false});


// start afresh, reload the page
$('#start').click(function() {
	location.reload();
});

//reveal all of the duck locations
$('#reveal').click(function() {

	// if (ducks_hidden == "FALSE") {
	// 	$('#message').css("color", "#FF3333");
	// 	$('#message').html("You haven't hidden them yet...");
	// }
	// reveal_ducks();

	console.log("REVEAL clicked");
	duck_timer.play();
	change_timer.play();

});

// show the location of all the ducks hidden among the available squares
function reveal_ducks() {

	// check each square to see if it has the 'target' class
	for (var i = 0; i < grid_height; i++) {
		
		for (var j = 1; j <= grid_width; j++) {
			var square_id = '#' + row_array[i] + j;

			if($(square_id).hasClass("target")) {
				var square_class = $(square_id).attr('class');
				var bg_color = grab_color(square_class);
				
				$('#' + row_array[i] + j).css('background-color', bg_color);
			}

		}

	}

}

// add duck class to certain squares
$('#suit').click(function() {
	$('#message').html('&nbsp;');

	if (game_lost == "TRUE") {
		$('#message').css("color", "black");
		$('#message').html("Sorry Charly, you lost.");
	}
	else {
		set_colors();

		ducks_suited = "TRUE";
		$('#ducks_left').html(my_ducks);

		$('#message').css("color", "black");
		$('#message').html("OK, the ducks have chosen colors!");
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

//hide the ducks based on the index in the duck_array
function hide_ducks(badelynge_index) {

	// determine whether to place the duck horizontally or vertically
	var orientation = Math.floor( (Math.random() * 2) );

	var chain_length = duck_array[badelynge_index];
	var duck_color = color_array[badelynge_index];

	// if orientation generates to 0, place ducks horizontally.
	if (orientation == 0) {
		horizontal_duck(chain_length, duck_color);
	}
	else if (orientation == 1) {
		vertical_duck(chain_length, duck_color);
	}

}


// place a duck among available squares horizontally, if called upon to do so
function horizontal_duck(chain_length, duck_color) {

	// select the row
	function set_row() {
		var row_index = Math.floor( (Math.random() * grid_height) + 0);
		var row = row_array[row_index];
	
		return row;
	}

	var row = set_row();
	var row_open = "FALSE";


	// determine how many squares are open
	var open_squares = 0;

	// evaluate whether the random row has enough available squares, otherwise switch it
	while (row_open == "FALSE") {

		for (var j = 1; j <= grid_width; j++) {
			var square_class = $('#' + row + j).attr('class');
			var is_a_duck = check_square(square_class);

			if (is_a_duck == "NO") {
				open_squares++;
			}
		}

		// if there aren't even available squares to fit the full chain length,
		// then randomly select a different row to test
		if (open_squares < chain_length) {
			row = set_row();
			open_squares = 0;
		}
		else {
			row_open = "TRUE";
		}

	}


	// determine which squares it can start on
	var start_range = open_squares - (chain_length - 1);

	// randomly select the starting square
	var start_square = Math.floor( (Math.random() * start_range) + 1 );

	// set all the ducks down
	for (var j = start_square; j < (start_square + chain_length) ; j++) {
	
		var square_class = $('#' + row + j).attr('class');

		// if the square being checked doesn't already have a duck in it, set one down
		if (check_square(square_class) == "NO") {
			$('#' + row + j).removeClass("open").addClass("target").addClass(duck_color);
		}
		else {
			start_square++;
		}

	}

}


// check what's going on with a certain hiding square, and change its background accordingly
$('.square').click(function() {

	if (game_lost == "TRUE") {
		$('#message').css("color", "black");
		$('#message').html("Sorry Charly, you lost.");
	}
	else {
		// if you haven't hidden the ducks yet
		if (ducks_suited == "FALSE") {
			$('#message').css("color", "#FF3333");
			$('#message').html("You've got to tell them ducks to suit up first!");
		}
		// if you've already found all the ducks
		else if (my_ducks == 0) {
			$('#message').css({"color":"black", "font-weight":"bold"});
			$('#message').html("You found them first! All the ducks are safe.<br>You can cuddle them in your backyard.");
		}
		// otherwise, check to see if there is a duck in this hiding square
		else {
			var duck_id = $(this).attr('id');
			var duck_class = $(this).attr('class');
			
			var redress = check_duck(duck_class);

			// if it's a duck, grab the color from the array, otherwise set to red.
			if (redress == "NO") {

				$(this).css('background-color', hide_color);
				my_ducks--;
				$('#ducks_left').html(my_ducks);

				if (my_ducks == 0) {
					$('h1').html("YOU WON!");
				}
			
			}
			else {
			
				$(this).css('background-color', 'red');
				strikes--;
				console.log("Strikes at: " + strikes);
			}

			$(this).attr('class', 'dead');

			if (strikes == 0) {
				game_lost = "TRUE";
			}

			$('#message').css("color", "black");
			$('#message').html('You still need to find ' + my_ducks + ' ducks');

		}
	}

});

// check the square's classes to see if it contains 'target' (meaning a duck is hiding here)
function check_duck(duck_class) {

		// split the ID's by the nbsp delimiter
		var class_array = duck_class.split(" ");

		// check the ID: if it is a duck, change the background color.
		// var redress = "NO";

		if (class_array.length == 2) {
			return "NO";
		}
		else {
			return "YES";
		}
		// for (i in class_array) {
		// 	if (class_array[i] == 'target') {
		// 		is_a_duck = "YES";
		// 		break;
		// 	}
		// }

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



