<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        Router::redirect('/users/profile');
    }

    public function p_post() {
        #set up the data
        $_POST['created']   = Time::now();
        if ($_POST['strikes'] > 3) {
            $_POST['strikes'] = 3;
        }

        DB::instance(DB_NAME)->insert('games',$_POST);


// beginning of section I'm adding in to see if it will work
        $crtd = $_POST['created'];
        $crtd = Time::display($crtd);
        $dkslft = $_POST['ducks_left'];
        $tmlpsd = $_POST['time_elapsed'];
        $strks = $_POST['strikes']; 
        $intls = $_POST['initials'];

        $q = 'SELECT 
                created,
                ducks_left,
                time_elapsed,
                strikes
            FROM games
            ORDER BY created DESC
            LIMIT 1';


        $games = DB::instance(DB_NAME)->select_rows($q);

        $new_div = "<br><div style='font-size: 24px; text-transform:uppercase;''>".$intls."</div>
                <span id='game_time'>".$crtd."</span><br>
                <span id='ducksleft'><strong>Ducks left: ".$dkslft.
                "&nbsp;&nbsp;&nbsp;&nbsp;</strong>Time: ".$tmlpsd."</span>&nbsp;&nbsp;&nbsp;&nbsp;Strikes: ".$strks."<br>";
// this is the end of the section I mean


        echo $new_div;
    }


/*
    public function signup($error = NULL) {


        # Set up the view
        $this->template->content = View::instance('v_users_signup');
        $this->template->title   = "Sign Up";
    
        $client_files_body = Array(
                "/js/jquery.form.js",
                "/js/users_register.js"
            );

        $this->template->client_files_body = Utils::load_client_files($client_files_body);

        if($error) {
            $this->template->error_msg = "All fields are required";
        };

        # Render the view
        echo $this->template;


    }

    public function p_signup() {

        #set up the data
        $_POST['created']   = Time::now();
        $_POST['token']     = $POST['email'].Utils::generate_random_string();

        DB::instance(DB_NAME)->insert('users',$_POST);

        echo "Your post was added";

    }

    public function login($error = NULL) {

        # Set up the view
        $this->template->content = View::instance('v_users_login');

        if($error) {
            $this->template->error_msg = "All fields are required";
        }
    
        # Render the view
        echo $this->template;
    }

    public function p_login() {

        if(!$_POST['email'])
        {
            Router::redirect('/users/login/error');
        }
        elseif (!$_POST['password']) {
            Router::redirect('/users/login/error');
        }


        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);


        #commented out, because echoing is interfering with setcookie
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";


        $qry = 'SELECT token
                FROM users
                WHERE email = "'.$_POST['email'].'"
                AND password = "'.$_POST['password'].'"';

        // echo $qry1;

        $token = DB::instance(DB_NAME)->select_field($qry);

        # commented out, because echoing is interfering with setcookie    
        // echo 'token = '.$token;
        // echo '<br>';

        #success
        if($token) {
            setcookie('token',$token,strtotime('+1 year'),'/');
        }
        #failure
        else {
            echo "<br>You are a failure. Stay out.<br><br>
                Or why not <a href='/users/login'>try again!</a>";
        }

        $qry = 'SELECT first_name
                FROM users
                WHERE email = "'.$_POST['email'].'"
                AND password = "'.$_POST['password'].'"';

        $first_name = DB::instance(DB_NAME)->select_field($qry);

        Router::redirect('/users/profile/'.$first_name);
    }

    public function logout() {

        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        $data = Array('token' => $new_token);

        DB::instance(DB_NAME)->update('users', $data, 'WHERE user_id ='. $this->user->user_id);

        setcookie('token', '', strtotime('-1 year'), '/');

        Router::redirect('/');

    }

    public function profile($user_name = NULL) {
        
        // # Create a new View instance
        // # Do *not* include .php with the view name
        // $view = View::instance('v_users_profile');
        
        
        # verify the user
        if (!$this->user) {
        
            # trying to sneak in without being logged in, route to homepage
            Router::redirect('/');

            // die('Not getting in that way! <br> <a href="/users/login">Log in</a>');

        }


        if (!$user_name) {
            $q = 'SELECT first_name
                    FROM users
                    WHERE users.user_id = '.$this->user->user_id;

            $name = DB::instance(DB_NAME)->select_field($q);

            # to reroute to profile of user
            Router::redirect('/users/profile/'.$name);

            # if the page dies instead of rerouting
            // die('Not getting in that way! <br> <a href="/users/profile/'.$name.'">Log in</a>');
        }


        # Set up the View
        $this->template->content = View::instance('v_users_profile');
        
        # Pass the data to the View
        $this->template->content->user_name = $user_name;

        # Set the title
        $this->template->title = $user_name."'s Profile";

        # Set Client files Head
        $client_files_head = Array(
            '/css/profile.css', 
            '/css/master.css'
            ); # end of array

        $this->template->client_files_head = Utils::load_client_files($client_files_head);

        # Set Client files Body
        $client_files_body = Array(
            '/js/profile.js'
            ); # end of array

        $this->template->client_files_body = Utils::load_client_files($client_files_body);

        #get info for listing posts from database
        $q = 'SELECT 
                posts.content,
                posts.created,
                posts.user_id,
                posts.post_id,
                users.first_name,
                users.last_name
            FROM posts
            INNER JOIN users
                ON posts.user_id = users.user_id
            WHERE posts.user_id = '.$this->user->user_id;

        $posts = DB::instance(DB_NAME)->select_rows($q);

        $this->template->content->posts = $posts;
        

        # Display the View
        echo $this->template;
        
    }
*/

} # end of the class