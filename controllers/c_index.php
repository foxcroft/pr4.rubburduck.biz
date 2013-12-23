<?php

class index_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	} 
		
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index() {	
		
		# Any method that loads a view will commonly start with this
		# First, set the content of the template with a view file
			$this->template->content = View::instance('v_index_index');
			
		# Now set the <title> tag
			$this->template->title = "Ducks of a Different Colour";
	
		# CSS/JS includes
			
			$client_files_head = Array(
				"/css/ducks.css"
				);
	    	$this->template->client_files_head = Utils::load_client_files($client_files_head);

	    	$client_files_body = Array(
	    		"http://code.jquery.com/jquery-1.9.1.js",
	    		"http://code.jquery.com/ui/1.10.3/jquery-ui.js",
	    		"/js/jquery.form.js",
	//    		"/js/users_register.js",
	    		"/js/jquery.timer.js",
	    		"/js/default.js",
	    		"/js/game_post.js"
	    		);
	    	$this->template->client_files_body = Utils::load_client_files($client_files_body);   

        $q = 'SELECT 
                created,
                ducks_left,
                time_elapsed,
                strikes,
                initials
            FROM games
            ORDER BY created DESC
            LIMIT 5';

        $games = DB::instance(DB_NAME)->select_rows($q);

        $this->template->content->games = $games;


		# Render the view
			echo $this->template;

	} # End of method

	public function p_signup() {

        #set up the data
        $_POST['created']   = Time::now();
        $_POST['token']     = $POST['email'].Utils::generate_random_string();

        DB::instance(DB_NAME)->insert('users',$_POST);

    }

    public function p_update() {

        $q = 'SELECT 
                created,
                ducks_left,
                time_elapsed,
                strikes,
                initials
            FROM games
            ORDER BY created DESC
            LIMIT 5';

        $games = DB::instance(DB_NAME)->select_rows($q);

        $this->template->content->games = $games;

    }
	
	
} # End of class
