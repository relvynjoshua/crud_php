<?php
    $servername = 'localhost';
    $username = 'relvyn';
    $password = 'test1234';
    $database = 'student_data';
    
    // create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // check connection
    if(!$conn){
        echo 'Connection error: ' . mysqli_connect_error();
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
        $sql = 'SELECT * FROM student_details';
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0){
            echo 'Students Data'. "\n";

            while($row = mysqli_fetch_assoc($result)) {
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

        mysqli_close($conn);
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

        if (mysqli_query($conn, $sql)){
            echo 'Student Data ADDED successfully!';
        } else {
            echo "Error adding Student Data: " . mysqli_error($conn);
        }

        mysqli_close($conn);
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

        if (mysqli_query($conn, $sql)) {
            echo "Student Data UPDATED successfully!";
          } else {
            echo "Error updating Student Data: " . mysqli_error($conn);
          }
    }

    // delete student
    if ($_SERVER["REQUEST_METHOD"] == "DELETE"){
        $deleteData = file_get_contents("php://input");
        parse_str($deleteData, $deleteVars);

        $id = $deleteVars['id'];

        $sql = "DELETE FROM student_details WHERE id='$id'";
        
        if (mysqli_query($conn, $sql)) {
            echo "Student Data DELETED successfully!";
          } else {
            echo "Error deleting Student Data: " . mysqli_error($conn);
          }

        mysqli_close($conn);
    }

    /* MISSING CODE 
    - update
    - explanation of each method
    - database should be observed always
    - familiarize or memorize how to code this
    */
?>
