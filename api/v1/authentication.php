<?php 
$app->get('/session', function() {
    $db = new DbHandler();
    if(!isset($_SESSION['uid'])){
        if(isset($_COOKIE['user'])){
            $fulltoken = explode("___", $_COOKIE['user']);
            $rememberIdentifier = $fulltoken[0];
            $rememberToken = $fulltoken[1];
            $user = $db->getOneRecord("SELECT uid, name, password, email, created FROM customers_auth WHERE remember_identifier='$rememberIdentifier'");
            $_SESSION['uid'] = $user['uid'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['name'];
            $session = $db->getSession();
            echoResponse(200, $session);
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
    $user = $db->getOneRecord("select uid,name,password,email,created from customers_auth where phone='$email' or email='$email'");
    if ($user != NULL) {
        if(passwordHash::check_password($user['password'],$password)){
            $response['status'] = "success";
            $response['message'] = 'Logged in successfully.';
            if(isset($r->customer->remember)){
$rememberIdentifier = "thisisrememberidentifier"; //this should be randomly generated string
$rememberToken = "thisisremembertoken"; //this should be randomly generated string
$updateUser = $db->updateUserCredentials("UPDATE customers_auth SET remember_identifier='$rememberIdentifier', remember_token='$rememberToken' WHERE name='$email'");
$remember = $r->customer->remember;
$response['rememberinfo'] = $rememberIdentifier;
$cookie_name = "user";
$cookie_value = $rememberIdentifier . '___' . $rememberToken;
setcookie($cookie_name, $cookie_value, time() + 3600, "/"); // 86400 = 1 day
}else{
    $response['rememberinfo'] = false;
}
$response['name'] = $user['name'];
$response['uid'] = $user['uid'];
$response['email'] = $user['email'];
$response['createdAt'] = $user['created'];
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
    $phone = $r->customer->phone;
    $name = $r->customer->name;
    $email = $r->customer->email;
    $address = $r->customer->address;
    $password = $r->customer->password;
    $isUserExists = $db->getOneRecord("select 1 from customers_auth where phone='$phone' or email='$email'");
    if(!$isUserExists){
        $r->customer->password = passwordHash::hash($password);
        $tabble_name = "customers_auth";
        $column_names = array('phone', 'name', 'email', 'password', 'city', 'address');
        $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
        if ($result != NULL) {
            $response["status"] = "success";
            $response["message"] = "User account created successfully";
            $response["uid"] = $result;
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['uid'] = $response["uid"];
            $_SESSION['phone'] = $phone;
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
    $updateUser = $db->updateUserCredentials("UPDATE customers_auth SET remember_identifier='', remember_token='' WHERE name='$email'");
    if(isset($_COOKIE['user'])){
        $cookie_name = 'user';
        $cookie_value = $_COOKIE['user'];
setcookie($cookie_name, $cookie_value, time() - 3600, "/"); // 86400 = 1 day
}

echoResponse(200, $response);
});
?>