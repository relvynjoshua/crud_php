<?php
    // mySQLi OOP approach
    $servername = 'localhost';
    $username = 'relvyn';
    $password = 'test1234';
    $database = 'student_data';
    
    // create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // check connection
    if($conn->connect_error){
        echo 'Connection error: ' . $conn->connect_error;
    }

    $id = '';
    $school_id = '';
    $first_name = '';
    $last_name = '';
    $date_of_birth = '';
    $gender = '';
    $course = '';
    $year_level = '';

    // functions

    // get students
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        $sql = "";
        
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            switch ($id) {
                case '':
                    $sql = "SELECT * FROM student_details";
                    break;
                default:
                    $sql = "SELECT * FROM student_details WHERE id = '$id'";
                    break;
            }
        } else {
            $sql = "SELECT * FROM student_details";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0){
            echo 'Students Data'. "\n";

            while($row = $result->fetch_assoc()) {
                echo 
                "\n" .
                ' Id: '. $row['id'] . "\n" .
                ' School Id: '. $row['school_id'] . "\n" .
                ' Name: '. $row['first_name'].
                ' '. $row['last_name']. "\n" .
                ' Date of Birth: '. $row['date_of_birth']. "\n" .
                ' Gender: '. $row['gender']. "\n" .
                ' Course: '. $row['course']. "\n" .
                ' Year Level: '. $row['year_level']. "\n" .
                "\n";
            }
        }   else {
            echo 'No Student Data available';
        } 

        $conn->close();
    }
    

    // add student
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $school_id = $_POST['school_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $date_of_birth = $_POST['date_of_birth'];
        $gender = $_POST['gender'];
        $course = $_POST['course'];
        $year_level = $_POST['year_level'];

        $sql = "INSERT INTO student_details (id, school_id, first_name, last_name, date_of_birth,
        gender, course, year_level) VALUES ('$id', '$school_id', '$first_name', '$last_name', 
        '$date_of_birth', '$gender', '$course', '$year_level')";

        if ($conn->query($sql) === TRUE){
            echo 'Student Data ADDED successfully!';
        } else {
            echo "Error adding Student Data: " . $conn->error;
        }

        $conn->close();
    }


    // update student
    if ($_SERVER["REQUEST_METHOD"] == "PUT"){
        $putData = file_get_contents("php://input");
        parse_str($putData, $putVars);

        $id = $putVars['id'];
        $school_id = $putVars['school_id'];
        $first_name = $putVars['first_name'];
        $last_name = $putVars['last_name'];
        $date_of_birth = $putVars['date_of_birth'];
        $gender = $putVars['gender'];
        $course = $putVars['course'];
        $year_level = $putVars['year_level'];

        $sql = "UPDATE student_details SET school_id='$school_id', first_name='$first_name', last_name='$last_name', date_of_birth='$date_of_birth',
        gender='$gender', course='$course', year_level='$year_level' WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo "Student Data UPDATED successfully!";
          } else {
            echo "Error updating Student Data: " . $conn->error;
          }
    }

    // delete student
    if ($_SERVER["REQUEST_METHOD"] == "DELETE"){
        $deleteData = file_get_contents("php://input");
        parse_str($deleteData, $deleteVars);

        $id = $deleteVars['id'];

        $sql = "DELETE FROM student_details WHERE id='$id'";
        
        if ($conn->query($sql) === TRUE) {
            echo "Student Data DELETED successfully!";
          } else {
            echo "Error deleting Student Data: " . $conn->error;
          }

        $conn->close();
    }

    /* MISSING CODE 
    - update
    - explanation of each method
    - database should be observed always
    - familiarize or memorize how to code this
    */
?>
