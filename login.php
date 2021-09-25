<?php
session_start();

$email = test_input($_POST["email"]); 
$password = test_input($_POST["password"]); 

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



$link = mysqli_connect("localhost", "lalit", "#kings@19997", "techstraa2k19"); 
  
if($link === false){ 
    die("ERROR: Could not connect. " 
                . mysqli_connect_error()); 
} 

//varifying user///////////////////////////////////////////////////////////////////////
 
$sql = "SELECT * FROM Students WHERE Std_Email ='". $email."'"; 

if($res = mysqli_query($link, $sql)){ 
    if(mysqli_num_rows($res) > 0){ 
       
        while($user = mysqli_fetch_array($res)){ 
           if ($user['Std_Email'] == $email && $user['Std_Password'] == $password) {
                //true area section
                $_SESSION['std_name'] = $user['Std_Name'];
                $_SESSION['std_email'] = $user['Std_Email'];
                $_SESSION['std_course'] = $user['Std_Course'];
                $_SESSION['login_error'] = '';
                
                header("location:events.php");

                exit();
                
                
                
                
                
                
                
                
            } else {
                //false area section
                $_SESSION["login_error"]="Username or Passsword is Incorrect!";

                header("location:signin.php");

                exit();
                
            }
            break;
        } 
        
        mysqli_free_result($res); 
    } else{ 
        //false area section
        $_SESSION["login_error"]="Username or Passsword is Incorrect!";

                header("location:signin.php");

                exit();
        
        
        
        
    } 
} else{ 
    echo "ERROR: Could not able to execute $sql. "  
                                . mysqli_error($link); 
} 

//////////////////////////////////////////////////////////////////////////////////////////////


































  
mysqli_close($link); 
?> 