<!-- adding a user if sign in or check for his existance for log in -->
<?php 
$login_email;

//FUNCTIONS DEFINITION
function isExiste($id, $email, $passw){
    $searchReq = "select * from users where email = ?  and password=?";
    $stmt = mysqli_prepare($id, $searchReq);
    mysqli_stmt_bind_param($stmt, "ss", $email, $passw);
    mysqli_stmt_execute($stmt);
    $searchRes = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($searchRes)> 0) {
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
        $Insrequest = "insert into users (email, password, family_name, first_name, Birth_day, typeBlood, Phone_num) values (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($id, $Insrequest);
        mysqli_stmt_bind_param($stmt, "sssssss", $sign_email, $sign_passw,  $family_name, $first_name, $birthday, $typeBlood, $phone_num);
        mysqli_stmt_execute($stmt);
        if(mysqli_stmt_affected_rows($stmt) <= 0){
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
if( $id = mysqli_connect("localhost:3308", "root","mysql2024") ) {
    if( $id_db = mysqli_select_db($id, "hope_lab") ) {
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
    else {
        die("Echec de connexion à la base.");
    }
    mysqli_close($id);
    } 
    else {
        die("Echec de connexion au serveur de base de données.");
    }
}
Connect();
?>

