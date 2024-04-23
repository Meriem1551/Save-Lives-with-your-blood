<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/request.css">

    <title>Blood Donate | Donation request</title>
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
                <li><a href="../pages/FAQ.html">FAQ</a></li>
                <li class="separator">|</li> 
                <li><a href="#footer">Contacts</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Donation Request</h2><br/>
        
        <form action="" method="post" class="donate-form">

            <input type="email" name="email" placeholder="Email" class="email" required>
            <select name="date" required>
                <?php
                        require_once 'db_connect.php';
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
                ?>
            </select>
            <input type="submit" name="donate" value="Donate" id="btn" />
        </form>
        <?php
            require_once 'db_connect.php';
                if (isset($_POST['donate'])){
                    $email = $_POST['email'];
                    $done_date = $_POST['date'];
                    $req = "update users set donation_date = '$done_date', isDonate = true where email = '$email' ";
                    if(mysqli_query($id, $req) == 0){
                        echo"can not change dates";
                    }
                    else{
                        header("Location: ../php/comments.php");
                        exit;
                    }
                }
        ?>
        <!-- adding form for admin to set next donation date in an ad and all dates available-->
    </main>
    <footer id="footer">
   
    <img src="../assets/images/Home/icons8-facebook-60.png" alt="facebook" width="40px" haight="40px">
    <img src="../assets/images/Home/icons8-instagram-60.png" alt="instagram"width="40px" haight="40px" style="margin-left: 20px;">
    <img src="../assets/images/Home/icons8-twitter-60.png" alt="twitter" width="40px" haight="40px" style="margin-left: 20px;">
    <!-- social media icons and copyrights -->
     <div>
      <p style="color: red; margin-top: 10px;">donate.life@gmail.com</p>
    </div>
      <P style="color: red; margin-top: 10px;">027715427</P>    
</body>
</html>