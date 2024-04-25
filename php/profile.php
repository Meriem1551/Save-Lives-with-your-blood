<!-- can modify infos -->
<?php
  function  update_User_Infos($user_email, $family_n, $first_n, $new_dob, $new_blood_type, $new_phone){
            require_once 'db_connect.php';
            $updateReq = "update users set family_name = '$family_n', first_name = '$first_n', Birth_day = '$new_dob', typeBlood = '$new_blood_type', Phone_num = '$new_phone' where email ='$user_email' ";
            $sql_run = mysqli_query($id, $updateReq); 
            if($sql_run == 0){
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
<header id="header">
        <div id="logo">
        <img src="../assets/images/Home/logo.png" alt="logo" id="logo">
          <h3>Donate Life</h3>
        </div>
        <nav>
            <ul>
                <li><a href="../index.html">Home</a></li>  
                <li class="separator">|</li> 
                <li><a href="./comments.php">Donataire</a></li>
                <li class="separator">|</li> 
                <li><a href="#footer">Contacts</a></li>
                <li class="separator">|</li>
                <li><button onclick="showAlert()" class="login_out">Log out</button></li>
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
                            $searchReq = "select * from users where email ='$email' ";
                            $res = mysqli_query($id,$searchReq);
                            if (mysqli_num_rows($res)> 0) {
                               $data = mysqli_fetch_assoc($res);
                               echo "<h3>Family name: </h3><div>".$data['family_name']."</div>";
                               echo "<br/><h3>First name: </h3><div>".$data['first_name']."</div>";
                               echo "<h3>Date of birth: </h3><div>".$data['Birth_day']."</div>";
                               echo "<h3>Type blood: </h3><div>".$data['typeBlood']."</div>";
                               echo "<h3>Phone number: </h3><div>"."0".$data['Phone_num']."</div>";
                            }
                            else{
                                echo "Can not extract data";
                            }
                            //DELETING USER
                            if(isset($_POST['confirm'])){
                                $email = $_SESSION['login_email'];
                                $Deletereq = "delete from users where email='$email'";
                                mysqli_query($id, $Deletereq);
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
        <!-- <h1>SIGN UP NOW!</h1> -->
        <img src="../assets/images/admin/icons8-male-user-96.png" alt="">
        <form action="../php/Donataire.php" method="POST">
          <input type="text" name="family_name" placeholder="Family Name" required><br>
          <input type="text" name="first_name" placeholder="First Name" required><br>
          <input type="date" name="birth-date" placeholder="Date of Birth"><br>
          <select name="typeBlood" id="" required>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
          </select><br>
          <input type="text" name="phone_num" placeholder="Your Phone number" required><br>
          <div class="btn-form">
          <input type="submit" name="done" value="Done"  class="btn">
          <button onclick="close_editProfile()" class="cancel">Cancel</button>
          </div>
        </form>
        <img src="../assets/images/Signin/—Pngtree—blood drop 3d icon health_8929242.png" alt="blood drop" width="200px" class="blood">
      </div>
        
    </main><button onclick="editProfile()" class="edit">Edit</button>
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