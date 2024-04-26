<?php
  function  update_User_Infos($id, $user_email, $family_n, $first_n, $new_dob, $new_blood_type, $new_phone){
            // require_once 'db_connect.php';
            $updateReq = "update users set family_name = '$family_n', first_name = '$first_n', Birth_day = '$new_dob', typeBlood = '$new_blood_type', Phone_num = '$new_phone' where email ='$user_email' ";
            $sql_run = mysqli_query($id, $updateReq); 
            if($sql_run == 0){
                echo"can not change data";
            }else {
                header("Location: ../php/profile.php");
            }   
}

    require_once 'db_connect.php';
        session_start();
        if(isset($_SESSION['login_email'])) {
            $email = $_SESSION['login_email'];
            $searchReq = "select * from users where email ='$email' ";
            $res = mysqli_query($id,$searchReq);
            if (mysqli_num_rows($res)> 0) {
                $data = mysqli_fetch_assoc($res);
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
            if(isset($_POST['save'])){
                $user_email = $_SESSION['login_email'];
                $family_n = $_POST['family_name'];
                $first_n = $_POST['first_name'];
                $new_dob = $_POST['birth-date'];
                $new_blood_type = $_POST['typeBlood'];
                $new_phone = $_POST['phone_num'];
                update_User_Infos($id, $user_email, $family_n, $first_n, $new_dob, $new_blood_type, $new_phone);
            }
        }   
        else{
            echo "email not provided";
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
                <li><button onclick="showAlert()" class="login_out">Log out</button></li>
            </ul>
        </nav>
    </header>
    <main>
        <div id="AlertBox" class="alert">
            <h2>Are you sure you want to log out?.</h2>
            <div id="buttons">
                <button onclick="closeAlert()">Cancel</button>
                <form action="" method="post">
                    <input type="submit"  value="Confirm" name="confirm"/>
                </form>
            </div>
        </div>
        <div id="profile">
            <div id="blogs">
                <img src="../assets/images/Profile/icons8-male-user-96.png" alt="profile" width="50px">
                <img src="../assets/images/Profile/icons8-setting-96.png" alt="setting" width="50px">
                <img src="../assets/images/Profile/icons8-meeting-time-96.png" alt="meeting_time" width="50px">
                <img src="../assets/images/Profile/icons8-messages-96.png" alt="message" width="50px">
                </ul>
            </div>
            <div id="user_profile">
                <header>
                    <h1>Profile</h1>
                    <img src="../assets/images/Profile/undraw_pic_profile_re_7g2h.svg" alt="profile_icon" width="100px">
                </header>
                <form action="" method="POST">
                    <div class="column">
                        <input type="text" name="family_name" value="<?php echo$data['family_name']?>" required><br>
                        <input type="text" name="first_name" value="<?php echo$data['first_name'] ?>" required><br>
                        <input type="date" name="birth-date" value="<?php echo$data['Birth_day'] ?>" required><br>
                    </div>
                    <div class="column">
                        <select name="typeBlood"  required>
                                <?php 
                                    $bloodType = array("A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-");
                                    foreach ($bloodType as $value) {
                                        if($value ==  $data['typeBlood'])
                                            echo "<option selected='selected'>$value</option>";
                                        else  
                                            echo "<option>$value</option>";
                                    }
                                ?>
                        </select><br>
                        <input type="text" name="phone_num" value="<?php echo"0".$data['Phone_num'] ?>" required><br>
                        <input type="submit" name="save" value="Save changes"  class="btn">
                    </div>
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