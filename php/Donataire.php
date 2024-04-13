<!-- adding a user if sign in or check for his existance for log in -->
<?php 

//FUNCTIONS DEFINITION
function isExiste($id, $email, $passw){
    $searchReq = "select * from users where email = '$email'  and password='$passw'";
    $res = mysqli_query($id, $searchReq);
    if (mysqli_num_rows($res)> 0) {
        return true;
    }
    else{
        return false;
    }
}

function addUser($id, $sign_email,  $sign_passw, $family_name,  $first_name, $birthday, $typeBlood, $phone_num) { 
    if(isExiste($id, $sign_email, $sign_passw)) {
        echo "<script>";
        echo "alert('This user is already existe. Try to login');";
        echo "window.location.href='../pages/login.html';";
        echo "</script>";
    }
    else{
        $Insrequest = "insert into users (email, password, family_name, first_name, Birth_day, typeBlood, Phone_num) values ('$sign_email','$sign_passw', '$family_name', '$first_name', '$birthday', '$typeBlood', '$phone_num')";
        $res = mysqli_query($id, $Insrequest);
        if($res == 0){
            echo "<script>";
            echo "alert('Can not add this user try later');";
            echo "window.location.href='../index.html';";
            echo "</script>";   
        }
        else{
            echo "<script>";
            echo "alert('User had been added successfully. Login now');";
            echo "window.location.href='../pages/login.html';";
            echo "</script>";
        }
    }
}
function Connect(){
    require_once 'db_connect.php';
        if(isset($_POST['sign_in'])){
            $sign_email = $_POST['sign_email']; 
            $sign_passw = $_POST['sign_passw'];
            $family_name = $_POST['family_name'];
            $first_name = $_POST['first_name'];
            $birthday = $_POST['birthday'];
            $typeBlood = $_POST['typeBlood'];
            $phone_num = $_POST['phone_num'];
            addUser($id, $sign_email, $sign_passw, $family_name,  $first_name, $birthday, $typeBlood, $phone_num);
        }
        else if(isset($_POST['login'])){
            $login_email = $_POST['login_email'];
            $login_passw = $_POST['login_passw'];
            if(isExiste($id, $login_email, $login_passw)){
                session_start();
                $_SESSION['login_email'] = $login_email;
                header("Location: ../php/comments.php");
                exit(); 
            }
            else{
                echo "<script>";
                echo "alert('Incorrect email or password');";
                echo "window.location.href='../pages/login.html';";
                echo "</script>";
            }
        }
}
Connect();
?>

