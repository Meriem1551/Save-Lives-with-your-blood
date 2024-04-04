<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/icons8-blood-drop-32.png">
    <link rel="stylesheet" href="../styles/adminPage.css">
    <title>Admin page</title>
</head>
<body>
    <main>
        <button onclick="showSearchBloc()">search</button>

        <div id="search_box">
            <h2>Search for a Donataire: </h2><br/>
            <form action="" method="post">
                <input type="date" name="first_date"  required><br>
                <input type="date" name= "second_date" required><br>
                <div id="buttons">
                    <input type="submit" name='search' value='search'>
                    <button onclick="hideSearchBloc()">Cancel</button>
                </div>
            </form>
        </div>
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
                                    echo "<input type='hidden' name='email' value='". $row['email']."'>";
                                    echo"<input type='submit' value='Delete' name='delete'>";
                                echo"</form>";
                            echo"</div>";
                        }
                        if(isset($_POST['delete'])) { 
                            $email = $_POST['email'];
                            $req = "delete from donataire where email= ?";
                            $stmt = mysqli_prepare($id, $req);
                            mysqli_stmt_bind_param($stmt,"s", $email);
                            mysqli_stmt_execute($stmt);
                            header('Location: ../php/AdminPage.php');
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
    <script>
        function showSearchBloc(){
            document.getElementById('search_box').style.display = "block";
        }
        function hideSearchBloc(){
            document.getElementById('search_box').style.display = "none";
        }
    </script>
</body>
</html>