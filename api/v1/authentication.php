<?php 
$app->get('/session', function() {
    $db = new DbHandler();
    if(!isset($_SESSION['uid'])){
        if(isset($_COOKIE['user'])){
            $credentials = explode("___", $_COOKIE['user']);
            $rememberIdentifier = $credentials[0];
            $rememberToken = hash('sha256', $credentials[1]);
            $user = $db->getOneRecord("SELECT uid, name, email, remember_token FROM customers_auth WHERE remember_identifier='$rememberIdentifier'");
            if($user){
                if($rememberToken === $user['remember_token']){
                    $_SESSION['uid'] = $user['uid'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['name'] = $user['name'];
                    $session = $db->getSession();
                    echoResponse(200, $session);
                }
            }
        }else{
            $session = $db->getSession();
            echoResponse(200, $session);
        }
    }
});

$app->post('/login', function() use ($app) {
    require_once 'passwordHash.php';
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('email', 'password'),$r->customer);
    $response = array();
    $db = new DbHandler();
    $password = $r->customer->password;
    $email = $r->customer->email;
    $user = $db->getOneRecord("SELECT uid, name, password, email, created FROM customers_auth WHERE email='$email'");
    if ($user) {
        if(passwordHash::check_password($user['password'],$password)){
            $response['status'] = "success";
            $response['message'] = 'Logged in successfully.';
            if(isset($r->customer->remember)){
                /*Create new instance of the Randomlib factory to create randomly generated strings to be used for creating rememberIdentifier and rememberToken*/
                $factory = new RandomLib\Factory;
                $generator = $factory->getGenerator(new SecurityLib\Strength(SecurityLib\Strength::MEDIUM));
                        $rememberIdentifier = $generator->generateString(128); //randomly generated string for rememberIdentifier
                        $rememberToken = $generator->generateString(128); //randomly generated string for rememberToken
                        $db->updateUserCredentials($rememberIdentifier, hash('sha256', $rememberToken), $email); // updating remember_identifier and remember_token
                        $cookie_name = "user";
                        $cookie_value = $rememberIdentifier . '___' . $rememberToken; // value of the cookie created by concatinating identifier and token separated by three underscores '___'
                        setcookie($cookie_name, $cookie_value, time() + 604800, "/"); // The user will be remembered for 7 days 
                        $response['name'] = $user['name'];
                        $response['uid'] = $user['uid'];
                        $response['email'] = $user['email'];
                        $response['createdAt'] = $user['created'];
                    }
                    if (!isset($_SESSION)) {
                        session_start();
                    }
                    $_SESSION['uid'] = $user['uid'];
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $user['name'];
                } else {
                    $response['status'] = "error";
                    $response['message'] = 'Login failed. Incorrect credentials';
                }
            }else {
                $response['status'] = "error";
                $response['message'] = 'No such user is registered';
            }
            echoResponse(200, $response);
        });
$app->post('/signUp', function() use ($app) {
    $response = array();
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('email', 'name', 'password'),$r->customer);
    require_once 'passwordHash.php';
    $db = new DbHandler();
    $name = $r->customer->name;
    $email = $r->customer->email;
    $address = $r->customer->address;
    $password = $r->customer->password;
    $isUserExists = $db->getOneRecord("SELECT 1 FROM customers_auth WHERE email='$email'");
    if(!$isUserExists){
        $r->customer->password = passwordHash::hash($password);
        $tabble_name = "customers_auth";
        $column_names = array('phone', 'name', 'email', 'password', 'city', 'address');
        $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
        if ($result) {
            $response["status"] = "success";
            $response["message"] = "User account created successfully";
            $response["uid"] = $result;
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['uid'] = $response["uid"];
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            echoResponse(200, $response);
        } else {
            $response["status"] = "error";
            $response["message"] = "Failed to create customer. Please try again";
            echoResponse(201, $response);
        }            
    }else{
        $response["status"] = "error";
        $response["message"] = "An user with the provided phone or email exists!";
        echoResponse(201, $response);
    }
});
$app->get('/logout', function() {
    $db = new DbHandler();
    $session = $db->destroySession();
    $response["status"] = "info";
    $response["message"] = "Logged out successfully";
    $email = $_SESSION['email'];
$db->updateUserCredentials('','', $email); //Remove the rememberIdentifier and rememberToken from database for the current user
if(isset($_COOKIE['user'])){
    $cookie_name = 'user';
    $cookie_value = $_COOKIE['user'];
setcookie($cookie_name, $cookie_value, time() - 604800, "/"); // Removing the remember me cookie 
}

echoResponse(200, $response);
});
?>