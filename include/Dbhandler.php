<?php

class DbHandler
{

    private $conn;

    function __construct()
    {
        require_once dirname(__FILE__) . '/Dbconnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }
    
    

    // public function varifyUser($email, $password)
    // {
        
    //     $stmt = $this->conn->prepare("SELECT * FROM Students WHERE Std_Email = ?");
       
    //     $stmt->bind_param("s", 'test@gmail');
        
    //     if ($stmt->execute() && $user = $stmt->get_result()->fetch_assoc()) {
            
    //         $stmt->close();
            
    //         if ($user['Std_Email'] == $email && $user['Std_Password'] == $password) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     } else {
    //         return null;
    //     }
    // }
    
    /**
     * Checking user varifyUser
     * @param String $email User login email id
     * @param String $password User login password
     */
    
    
    public function getStudentData($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM Students WHERE Std_Email = ?");
        $stmt->bind_param("s", $email);
        echo "no";
    }
    public function isUserExistsEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT Std_Student_Id from Students WHERE Std_Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }
    public function varifyApllication($email,$table_name){

        $str = "SELECT std_name FROM ".$table_name." WHERE std_email = ?";
        
        $stmt = $this->conn->prepare($str);
        $stmt->bind_param("s", $email);
        
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
        

    }
    
    public function insertIntoApplyTable($name,$course,$email,$table_name){

       

        $str = "INSERT INTO ".$table_name."(std_name,std_course,std_email) VALUES (? , ? , ?)";

        
        $stmt = $this->conn->prepare($str);
        $stmt->bind_param("sss", $name, $course, $email);
        $result = $stmt->execute();
        $stmt->close(); 
 
        // Check for successful insertion
        if ($result) {
            // User successfully inserted
            return true;
        } else {
            // Failed to create user
            return false;
        }


    }
    
    
    
    
    
    
    public function insertStudentData($name , $email , $password ,$course)
    {
       

        // insert query
        $stmt = $this->conn->prepare("INSERT INTO Students(Std_Name ,Std_Course, Std_Email , Std_Password ) VALUES (?, ?, ? , ?)");
        $stmt->bind_param("ssss", $name, $course ,$email ,$password);
        $result = $stmt->execute();
        $stmt->close();

        // Check for successful insertion
        if ($result) {
            // User successfully inserted
            return true;
        } else {
            // Failed to create user
            return false;
        }
    }
    
   
    public function getEventCount()
    {
        $sql = "SELECT COUNT(*) FROM Events";
        $result = $this->conn->query($sql);
        
        $row = $result->fetch_assoc();

        return $row["COUNT(*)"];
    }
    
    public function getEventData()
    {
        $sql = "SELECT * FROM Events";
        $result = $this->conn->query($sql);
        
        

        return $result;
    }
    public function getDay2Data()
    {
        $sql = "SELECT * FROM Day2";
        $result = $this->conn->query($sql);
        
        

        return $result;
    }
    public function getCoordinatorDetail($id){
        
         $link = mysqli_connect("localhost", "lalit", "#kings@19997", "techstraa2k19"); 
      
            if($link === false){ 
                die("ERROR: Could not connect. " 
                            . mysqli_connect_error()); 
            } 
        
        $sql = "SELECT * FROM Coordinators WHERE coord_id ='". $id."'";     
        
        
         if($res = mysqli_query($link, $sql)){ 
              if(mysqli_num_rows($res) > 0){ 
           
                while($user = mysqli_fetch_array($res)){ 
                   return $user;
                break;
            } 
            mysqli_free_result($res); 
         }
        }
        mysqli_close($link); 
    }
    
    public function getEventDataWithID($id)
    {   
            $link = mysqli_connect("localhost", "lalit", "#kings@19997", "techstraa2k19"); 
      
            if($link === false){ 
                die("ERROR: Could not connect. " 
                            . mysqli_connect_error()); 
            } 
            $sql = "SELECT * FROM Events WHERE event_id ='". $id."'";     
            if($res = mysqli_query($link, $sql)){ 
              if(mysqli_num_rows($res) > 0){ 
           
                while($user = mysqli_fetch_array($res)){ 
                   return $user;
                break;
            } 
            mysqli_free_result($res); 
         }
        }
        mysqli_close($link); 
    }
    
    
    public function getDay2Count()
    {
        $sql = "SELECT COUNT(*) FROM Day2";
        $result = $this->conn->query($sql);
        
        $row = $result->fetch_assoc();

        return $row["COUNT(*)"];
    }
    
    public function getDay1Data()
    {
        $sql = "SELECT * FROM Day1";
        $result = $this->conn->query($sql);
        
        return $result;
    }
    public function getDay1Count()
    {
        $sql = "SELECT COUNT(*) FROM Day1";
        $result = $this->conn->query($sql);
        
        $row = $result->fetch_assoc();

        return $row["COUNT(*)"];
    }
    public function getDay3Data()
    {
        $sql = "SELECT * FROM Day3";
        $result = $this->conn->query($sql);
        
        return $result;
    }
    public function getDay3Count()
    {
        $sql = "SELECT COUNT(*) FROM Day3";
        $result = $this->conn->query($sql);
        
        $row = $result->fetch_assoc();

        return $row["COUNT(*)"];
    }






    public function getCoordinatorData()
    {
        $sql = "SELECT * FROM `Coordinators`";
        $result = $this->conn->query($sql);
        
        

        return $result;
    }
    public function getCoordinatorCount()
    {
        $sql = "SELECT COUNT(*) FROM `Coordinators`";
        $result = $this->conn->query($sql);
        
        $row = $result->fetch_assoc();

        return $row["COUNT(*)"];
    }
    public function sendStudentResponse($name,$email,$course,$msg,$sub){

        $stmt = $this->conn->prepare("INSERT INTO Messages(std_name , std_email, std_course, msg_text, msg_sub ) VALUES (?, ?, ?,?,?)");
        $stmt->bind_param("sssss", $name, $email , $course , $msg , $sub);
        $result = $stmt->execute();
        $stmt->close();

        // Check for successful insertion
        if ($result) {
            // User successfully inserted
            return true;
        } else {
            // Failed to create user
            return false;
        }


    }
}
 ?>