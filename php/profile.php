<!-- can modify infos -->
<?php
  function  update_User_Infos($user_email, $family_n, $first_n, $new_dob, $new_blood_type, $new_phone){
            require_once 'db_connect.php';
            $updateReq = "update users set family_name = '$family_n', first_name = '$first_n', Birth_day = '$new_dob', typeBlood = '$new_blood_type', Phone_num = '$new_phone' where email = ?";
            $stmt = mysqli_prepare($id, $updateReq);
            mysqli_stmt_bind_param($stmt, 's', $user_email);
            if(mysqli_stmt_execute($stmt) == 0){
                echo"can not change data";
            }else {
                header("Location: ../php/profile.php");
            }   
}
?>
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
                    require_once 'db_connect.php';
                        session_start();
                        if(isset($_SESSION['login_email'])) {
                            $email = $_SESSION['login_email'];
                            $searchReq = "select * from users where email = ?";
                            $stmt = mysqli_prepare($id, $searchReq);
                            mysqli_stmt_bind_param($stmt, "s", $email);
                            mysqli_stmt_execute($stmt);
                            $searchRes = mysqli_stmt_get_result($stmt);
                            if (mysqli_num_rows($searchRes)> 0) {
                               $data = mysqli_fetch_assoc($searchRes);
                               echo "<h3>Family name: </h3><div>".$data['family_name']."</div>";
                               echo "<br/><h3>First name: </h3><div>".$data['first_name']."</div>";
                               echo "<h3>Date of birth: </h3><div>".$data['Birth_day']."</div>";
                               echo "<h3>Type blood: </h3><div>".$data['typeBlood']."</div>";
                               echo "<h3>Phone number: </h3><div>".$data['Phone_num']."</div>";
                            }
                            else{
                                echo "Can not extract data";
                            }
                            //DELETING USER
                            if(isset($_POST['confirm'])){
                                $email = $_SESSION['login_email'];
                                $Deletereq = "delete from users where email=?";
                                $delStmt = mysqli_prepare($id,$Deletereq);
                                mysqli_stmt_bind_param($delStmt,"s",$email);
                                mysqli_stmt_execute($delStmt);
                                header("Location: ../index.html"); 
                                exit;
                            }
                            //Update data
                            if(isset($_POST['done'])){
                                $user_email = $_SESSION['login_email'];
                                $family_n = $_POST['family_name'];
                                $first_n = $_POST['first_name'];
                                $new_dob = $_POST['birth-date'];
                                $new_blood_type = $_POST['typeBlood'];
                                $new_phone = $_POST['phone_num'];
                                update_User_Infos($user_email, $family_n, $first_n, $new_dob, $new_blood_type, $new_phone);
                            }
                        }   
                        else{
                            echo "email not provided";
                        }
            ?>
            <button onclick="editProfile()">Edit</button>
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
        <!-- EDIT PROFILE -->
        <div id="edit-profile" class="edit_profile">
            <form action="" method="post">
                <label for="family_name">Family name:</label><br>
                <input type="text" name="family_name" required><br>
                <label for="first_name">First name:</label><br>
                <input type="text" name="first_name" required><br>
                <label for="birth-date">Date of birth:</label><br>
                <input type="date" name="birth-date" required><br>
                <label for="email" required>Type blood:</label><br>
                <select name="typeBlood" required>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select><br>
                <label for="email">Phone number:</label><br>
                <input type="text" name="phone_num" required><br>
                <input type="submit" name="done" value="Done"  class="btn">
                <button onclick="close_editProfile()">Cancel</button>
            </form>
        </div>
    </main>
    <script>
        function showAlert(){
            document.getElementById('AlertBox').style.display = 'block';
        }
        function closeAlert() {
            document.getElementById('AlertBox').style.display = 'none';
        }
        function editProfile(){
            document.getElementById('edit-profile').style.display = 'block';
        }
        function close_editProfile() {
            document.getElementById("edit-profile").style.display = "none";
        }
    </script>
</body>
</html>