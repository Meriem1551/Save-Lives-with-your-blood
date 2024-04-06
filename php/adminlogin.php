<?php
function connect($admin_email, $admin_passw){
    if( $id = mysqli_connect("localhost:3308", "root","mysql2024") ) {
        if( $id_db = mysqli_select_db($id, "hope_lab") ) {
            $searchReq = "select * from admin where email = ?  and password=?";
            $stmt = mysqli_prepare($id, $searchReq);
            mysqli_stmt_bind_param($stmt, "ss", $admin_email, $admin_passw );
            mysqli_stmt_execute($stmt);
            $searchRes = mysqli_stmt_get_result($stmt);
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
        else {
            die("Echec de connexion à la base.");
        }
    mysqli_close($id);
    } 
    else {
        die("Echec de connexion au serveur de base de données.");
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
    <main>
        <h1>Admin log In</h1>
        <form action="" method="post">
            <label for="email">Email: </label><br/>
            <input type="email" name="admin_email"  required><br>
            <label for="password">Password: </label><br/>
            <input type="password" name="admin_passw" required><br>
            <input type="submit" name="login" value="Login" class="btn">
        </form>
        <?php
        if(isset($_POST['login'])) {
            $admin_email = $_POST['admin_email'];
            $admin_passw = $_POST['admin_passw'];
            connect($admin_email,$admin_passw);
        }
        ?>
    </main>

</body>
</html>