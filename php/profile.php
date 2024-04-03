<!-- can modify infos -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/images/icons8-blood-drop-32.png" type="image/png">
    <link rel="stylesheet" href="../styles/profile.css">
    <title>Profile</title>
</head>
<body>
<header>
        <img src="../assets/images/Home/icons8-blood-donation-64.png" alt="Blood Donation Icon"/>
        <nav>
            <ul>
                <li><a href="../index.html">Home</a></li>  
                <li><a href="./comments.php">Donataire</a></li> 
                <li><button onclick="showAlert()">Log out</button></li>
            </ul>
        </nav>
    </header>
    <main>
        <div  class="userinfo">
            <?php
                if( $id = mysqli_connect("localhost:3308", "root","mysql2024") ) {
                    if( $id_db = mysqli_select_db($id, "hope_lab") ) {
                        session_start();
                        if(isset($_SESSION['login_email'])) {
                            $email = $_SESSION['login_email'];
                            $searchReq = "select * from donataire where email = ?";
                            $stmt = mysqli_prepare($id, $searchReq);
                            mysqli_stmt_bind_param($stmt, "s", $email);
                            mysqli_stmt_execute($stmt);
                            $searchRes = mysqli_stmt_get_result($stmt);
                            if (mysqli_num_rows($searchRes)> 0) {
                               $data = mysqli_fetch_assoc($searchRes);
                               echo "<div>".$data['email']."</div>";
                               echo "<div>".$data['Birth_day']."</div>";
                               echo "<div>".$data['typeBlood']."</div>";
                               echo "<div>".$data['Phone_num']."</div>";
                            }
                            else{
                                echo "Can not extract data";
                            }
                            //DELETING USER
                            if(isset($_POST['confirm'])){
                                $email = $_SESSION['login_email'];
                                $Deletereq = "delete from donataire where email=?";
                                $delStmt = mysqli_prepare($id,$Deletereq);
                                mysqli_stmt_bind_param($delStmt,"s",$email);
                                mysqli_stmt_execute($delStmt);
                                header("Location: ../index.html"); 
                                exit;
                            } 
                        }   
                        else{
                            echo "email not provided";
                        }
                    }
                    else {
                        die('Echec de connexion a la base');
                    } 
                mysqli_close($id);
                }
                else{
                    die('Echec de connexion au serveur');
                }
            ?>
            <li><a href="../pages/editData.html">Edit</a></li>
        </div>

        <div id="AlertBox" class="alert">
            <h2>Are you sure you want to log out?.</h2>
            <div id="buttons">
                <button onclick="closeAlert()">Cancel</button>
                <form action="" method="post">
                    <input type="submit"  value="Confirm" name="confirm"/>
                </form>
            </div>
        </div>
    </main>
    <script>
        function showAlert(){
            document.getElementById('AlertBox').style.display = 'block';
        }
        function closeAlert() {
            document.getElementById('AlertBox').style.display = 'none';
        }
    </script>
</body>
</html>