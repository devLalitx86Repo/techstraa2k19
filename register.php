<?php
session_start();
include 'include/Dbhandler.php';

$db = new Dbhandler();


// define variables and set to empty values
$error_counter = 0;

$_SESSION['name_error'] = $_SESSION['email_error'] = $_SESSION['password_error'] = $_SESSION['cnfPassword_error'] =  '';
$_SESSION['registration_error'] = '';
$name = $email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $_SESSION['name_error'] = "Name is required";
        $error_counter += 1;
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $_SESSION['name_error'] = "Only letters and white space allowed";
            $error_counter += 1;
        }
    }

    if (empty($_POST["email"])) {
        $_SESSION['email_error'] = "Email is required";
        $error_counter += 1;
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['email_error'] = "Invalid email format";
            $error_counter += 1;
        }
    }



    if (empty($_POST["password"])) {
        $_SESSION['password_error'] = "password is required";
        $error_counter += 1;
    } else {

        $password = test_input($_POST["password"]);
        
    }
    $cnf_pwd = test_input($_POST["cnf_pwd"]);

    if (strcmp($cnf_pwd, $password) != 0) {
        $_SESSION['cnfPassword_error'] = "Password doesn't match!";
        $error_counter += 1;
    }
}

$course =$_POST["course"]; 


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if($error_counter==0){
    

    if (!$db->isUserExistsEmail($email)) {


        if ($db->insertStudentData($name, $email, $password ,$course)) {
            include 'include/closeErrors.php';
            $_SESSION['login_note'] =  'Congrats! you are registered LOGIN First.';
             header("location:signin.php");
                exit();

        } else {
            $_SESSION['registration_error'] = 'Something is going wrong';
                header("location:registration.php");
                exit();
        }
    } else {

       $_SESSION['registration_error'] = 'Your Email ID is already Registered.';
       header("location:registration.php");
       exit();
    }


}else{
    $_SESSION['registration_error'] = 'Please fill the right information, It is for your convenient Thank You !';
    header("location:registration.php");
    exit();
}

