<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/request.css">

    <title>Blood Donate | Donation request</title>
</head>
<body>
    <main>
        <h2>Donation Request</h2><br/>
        <form action="" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <select name="date" required>
                <?php
                    if( $id = mysqli_connect("localhost:3308", "root","mysql2024") ) {
                        if( $id_db = mysqli_select_db($id, "hope_lab") ) {
                            $get_date = "select * from dates";  //
                            $result = mysqli_query($id,$get_date);
                            if(mysqli_num_rows($result) <= 0){
                                echo"<option>No available dates.</option>";
                            }
                            else{
                                while($date = mysqli_fetch_assoc($result)){
                                    echo"<option>".$date['aval_donate_date']."</option>";
                                }
                            }
                        }
                        else{
                            die("Echec de connexion a la base");
                        }
                        mysqli_close($id);
                    } 
                    else {
                        die("Erreur de connection au serveur");
                    }
                ?>
            </select>
            <input type="submit" name="donate" value="Donate" />
        </form>
        <?php
          if( $id = mysqli_connect("localhost:3308", "root","mysql2024") ) {
            if( $id_db = mysqli_select_db($id, "hope_lab") ) {
                if (isset($_POST['donate'])){
                    $email = $_POST['email'];
                    $done_date = $_POST['date'];
                    $req = "update users set donation_date = '$done_date', isDonate = true where email = ?";
                    $stmt = mysqli_prepare($id, $req);
                    mysqli_stmt_bind_param($stmt,  's', $email);
                    if(mysqli_stmt_execute($stmt) == 0){
                        echo"can not change dates";
                    }
                    else{
                        header("Location: ../php/comments.php");
                        exit;
                    }
                }
            }
            else{
                die("Echec de connexion a la base");
            }
            mysqli_close($id);
        }  
        else {
            die("Erreur de connection au serveur");
        }
        ?>
        <!-- adding form for admin to set next donation date in an ad and all dates available-->
    </main>
</body>
</html>