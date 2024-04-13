<?php
function isExiste($id, $email){
    $userInfo = "select * from users where email = ?"; 
    $stmt = mysqli_prepare($id, $userInfo);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $GetUserInfo = mysqli_stmt_get_result($stmt);  
    
    if(mysqli_num_rows($GetUserInfo) > 0){
        return true;
    }else{
        return false;
    }
}

if( $id = mysqli_connect("localhost:3308", "root","") ) {
    if( $id_db = mysqli_select_db($id, "hope_lab") ) {
        $your_email = $_POST['your_email'];
        $new_passw = $_POST['new_passw'];
        if(isExiste($id, $your_email)){
            $request = "update users set  password=? where email=?";
            $stmt = mysqli_prepare($id,$request);
            mysqli_stmt_bind_param($stmt,"ss",$new_passw,$your_email);
            if(mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Updated password successfully. Log in now');window.location.href='../pages/login.html';</script>";  
            }
            else{
                echo "<script>alert('failed to update password');window.location.href='../pages/login.html';</script>'";
            }
        }
        else{
            echo "<script>alert('User does not existe');window.location.href='../pages/signIn.html';</script>'";
        }
    }
}
?>