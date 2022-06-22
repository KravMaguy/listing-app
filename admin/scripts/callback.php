<?php
session_start();
//include vendor packages
include '../vendor/autoload.php';

// Include Hybridauth's basic autoloader
// include '../vendor/hybridauth/hybridauth/src/autoload.php';

//load the hybridauth plugin
include 'config.php';

//database connector
require '../../scripts/pdocon.php';

//hybridauth initialization
use Hybridauth\Exception\Exception;
use Hybridauth\Hybridauth;
use Hybridauth\HttpClient;
use Hybridauth\Storage\Session;

try {
    /**
     * Feed configuration array to Hybridauth.
     */
    $hybridauth = new Hybridauth($config);

    $user_id=null;

    /**
     * Initialize session storage.
     */
    $storage = new Session();

    /**
     * Hold information about provider when user clicks on Sign In.
     */
    if (isset($_GET['provider'])) {
        $storage->set('provider', $_GET['provider']);
    }

    /**
     * When provider exists in the storage, try to authenticate user and clear storage.
     *
     * When invoked, `authenticate()` will redirect users to provider login page where they
     * will be asked to grant access to your application. If they do, provider will redirect
     * the users back to Authorization callback URL (i.e., this script).
     */
    if ($provider = $storage->get('provider')) {
        $hybridauth->authenticate($provider);
        $storage->set('provider', null);
    }

    /**
     * This will erase the current user authentication data from session, and any further
     * attempt to communicate with provider.
     */
    if (isset($_GET['logout'])) {
        $adapter = $hybridauth->getAdapter($_GET['logout']);
        $adapter->disconnect();

        setcookie('email', null, -1, "/", 'listing-app.com');
    	setcookie('provider', null, -1, "/", 'listing-app.com');

       
        HttpClient\Util::redirect('https://listing-app.com/all_buildings.php');

    }
    
    else{
    
        /**
         * Redirects user to home page (i.e., index.php in our case)
         */
        //HttpClient\Util::redirect('https://ticket-mining.com/test.php');
        $adapters = $hybridauth->getConnectedAdapters();
        foreach ($adapters as $name => $adapter){
        
            //print_r($adapter->getUserProfile());
            $firstName = $adapter->getUserProfile()->firstName; //user first name
            $lastName = $adapter->getUserProfile()->lastName; //user last name
            $email = $adapter->getUserProfile()->email; //user email
            $profilepic = $adapter->getUserProfile()-> photoURL;
            $sessionTimeout = $adapter->getAccessToken()["expires_in"];// get session lifespan
            
            if($name == "LinkedIn"){
                $provider = "LinkedIn";
            }
            
            if($name == "Facebook"){
                $provider = "Facebook";
                //print_r($sessionTimeout);
            }
            
            if($name == "Google"){
                $provider = "Google";
                //print_r($sessionTimeout);
            }

            if($name == "Microsoft"){
                $provider = "Microsoft";
                //print_r($sessionTimeout);
            }

        }
              
        
        //check if user exists in the registration database. If user does not exists create record, otherwise login (update profile if necessary)
            
        $stmt = $db->query('SELECT user_id,email FROM tbl_users WHERE email="'.$email.'"');
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        $row_count = $stmt->rowCount();

        if($row_count <= 0){
            //insert user into the database
            $stmt = $db->prepare("INSERT INTO tbl_users(fname, lname, email) VALUES(:fname, :lname, :email)");
            $stmt->execute(array(':fname' => $firstName , ':lname' => $lastName, ':email' => $email));
            //get last insert id
            $insertId = $db->lastInsertId();
            $user_id = $insertId;

    	} else { 
            $user_id = $res['user_id'];
        }
    	
    	//setcookie(name, value, expiration, path, domain, secure);
    	 // then store it in a cookie
    	setcookie('email', $email, time() + $sessionTimeout, "/", 'listing-app.com');
    	setcookie('provider', $provider, time() + $sessionTimeout, "/", 'listing-app.com');

        $_SESSION["email"] = $email;
        $_SESSION["user_id"] = $user_id;
        
        $_SESSION["fname"] = $firstName;
        $_SESSION["lname"] = $lastName;
        $_SESSION["profile_pic"] = $profilepic;
        // $_SESSION["user_level"] = $row["user_level"];
             
        //redirect to profile page
       header("Location: https://listing-app.com/admin/");     
    }
    
} catch (Exception $e) {
    echo $e->getMessage();
}