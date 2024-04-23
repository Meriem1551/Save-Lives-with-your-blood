<?php
function connect($admin_email, $admin_passw){
    
        require_once 'db_connect.php';
            $searchReq = "select * from admin where email = '$admin_email'  and password= '$admin_passw'";
            $searchRes = mysqli_query($id, $searchReq);
            if(mysqli_num_rows($searchRes) <= 0) {
                echo "<script>";
                echo "alert('Your are not an admin.');";
                echo "</script>";
            }
            else{
                echo "<script>";
                echo "window.location.href='../php/AdminPage.php';";
                echo "</script>";
            }
    
}

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/icons8-blood-drop-32.png">
    <link rel="stylesheet" href="../styles/admin.css">
    <title>Admin login</title>
</head>
<body>
    <div class="admin-form">
    <img src="../assets/images/admin/login-admin.png" alt="">
    <main>
        <h1>Admin log In</h1>
        <form action="" method="post">
            <input type="email" name="admin_email" placeholder="Email" required><br>

            <input type="password" name="admin_passw" placeholder="Password" required><br>
            <input type="submit" name="login" value="Login" class="btn">
        </form>
        <?php
        if(isset($_POST['login'])) {
            $admin_email = $_POST['admin_email'];
            $admin_passw = $_POST['admin_passw'];
            connect($admin_email,$admin_passw);
        }
        ?>
    </main></div>
        
</body>
</html>