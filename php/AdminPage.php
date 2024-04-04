<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/icons8-blood-drop-32.png">
    <title>Admin page</title>
</head>
<body>
    <main>
        <!-- contains persons who registered and he can delete them or serch for them donation between 2 dates -->
        <h1>
            <!-- find a title for that page or just remove it -->
        </h1>
        <!-- add search for users who donate between 2 dates as button and then show a bloc like edit profile-->
        <div id="users">
        <?php
            if( $id = mysqli_connect("localhost:3308", "root","mysql2024") ) {
                if( $id_db = mysqli_select_db($id, "hope_lab") ) {
                    $get_data = "select * from donataire order by family_name"; 
                    $result = mysqli_query($id, $get_data);
                    if(mysqli_num_rows($result) <= 0){
                        echo"Empty data base";
                    }
                    else{
                        while($row = mysqli_fetch_assoc($result)){
                            echo"<div class='singl_user'>";
                                echo"<div>".$row['email']."</div>";
                                echo"<div>".$row['family_name']."</div>";
                                echo"<div>".$row['first_name']."</div>";
                                echo"<div>"."0".$row['Phone_num']."</div>";
                                echo"<form action='' method='post'>";
                                    echo"<input type='submit' value='Delete'>";
                                echo"</input>";
                                // login for delete user
                            echo"</div>";
                        }
                        // add the appropriate infos
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
        </div>
    </main>
</body>
</html>