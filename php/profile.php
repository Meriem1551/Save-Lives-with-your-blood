<!-- can modify infos -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
<header>
        <img src="../assets/images/Home/icons8-blood-donation-64.png" alt="Blood Donation Icon"/>
        <nav>
            <ul>
                <li><a href="../index.html">Home</a></li>  
                <li><a href="./comments.php">Donataire</a></li> 
            </ul>
        </nav>
    </header>
    <main>
        <h1>Your profile</h1>
        <?php 
            session_start();
            if(isset($_SESSION['login_email'])) {
                $login_email = $_SESSION['login_email'];
                echo $login_email;
            }   
            else{
                echo "email does not provided";
            }
        ?>
    </main>
</body>
</html>