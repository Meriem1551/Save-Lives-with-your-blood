<?php
function isExiste($id, $email){
    $userInfo = "select * from users where email = '$email' "; 
    $sql = mysqli_query($id, $userInfo);
    if(mysqli_num_rows($sql) > 0){
        return true;
    }else{
        return false;
    }
}
    require_once 'db_connect.php';
        $your_email = $_POST['your_email'];
        $new_passw = $_POST['new_passw'];
        if(isExiste($id, $your_email)){
            $request = "update users set  password= '$new_passw' where email='$your_email' ";
            $sql = mysqli_query($id, $request);
            if($sql) {
                echo "<script>alert('Updated password successfully. Log in now');window.location.href='../pages/login.html';</script>";  
            }
            else{
                echo "<script>alert('failed to update password');window.location.href='../pages/login.html';</script>'";
            }
        }
        else{
            echo "<script>alert('User does not existe');window.location.href='../pages/signIn.html';</script>'";
        }
?>