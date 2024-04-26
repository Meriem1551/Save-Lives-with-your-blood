<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/icons8-blood-drop-32.png">
    <!-- <link rel="stylesheet" href="../styles/donataire.css"> -->
    <link rel="stylesheet" href="../styles/comment.css">
    <title>Blood Donate | Add comment</title>
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
                <li class="separator">|</li> 
                <li><a href="../php/profile.php">Profile</a></li>
            </ul>
        </nav>
    </header>
   
    <!-- comments -->
    <!-- button to donation request -->

    <main>
         <h2 class="clients-h2">CLIENT TESTIMONIALS </h2>
        <?php
                require_once 'db_connect.php';
                $req = "select * from comments";
                $res =  mysqli_query($id,$req);
                 echo"<div class='test-clients'>";
                while ($row = mysqli_fetch_assoc($res)) {
                   
                        echo"<div class='client'>";
                            echo "<img src='../assets/images/admin/icons8-male-user-96.png' alt='imge' style='height:100px;width: 100px;margin-left:100px;margin-bottom:50px;'>";
                            echo"<div class='email'>".$row['email']."</div>";
                            echo"<div class='comment'>".$row['comment']."</div>";
                            echo"<form action='' method='post' class='delete-form'>";
                                echo"<input type='hidden' name='email' value = '".$row['email']."'>";
                                echo"<input type='hidden' name='comment_id' value = '".$row['id']."'>";
                                echo"<input type='submit' name='delete' value='Delete' class='delete'>";
                            echo"</form>";
                        echo "</div>";
                   
                } echo"</div>";
                    if(isset( $_POST['post'])){
                        $email = $_POST['email'];
                        $comment = $_POST['comment'];
                        $addComm = "insert into comments (email, comment) values('$email','$comment')";
                        $res = mysqli_query($id, $addComm);
                        if($res == 0){
                            echo "<script>";
                            echo "alert('Can not add this comment try later');";
                            echo "</script>";   
                        }
                        else{
                            header('Location: ../php/comments.php');
                            exit;
                        }
                    }
                    if(isset($_POST['delete'])){
                        $email = $_POST['email'];
                        $comment_id = $_POST['comment_id'];
                        $delete_req = "delete from comments where email  ='$email' and  id= '$comment_id' ";
                        mysqli_query($id, $delete_req);
                        header('Location: ../php/comments.php');
                        exit;
                    }
        ?>
        <div class="comment-form">
        <h2 style="margin-top:50px; margin-bottom: 30px;">Leave a Comment</h2>
        <form id="commentForm" method="post">
            <input type="text" id="email" name="email" placeholder="email" required>
            <textarea id="comment" name="comment" placeholder="Your Comment" required></textarea>
            <input type="submit" name="post" value="POST" id="btn">
        </form>
    </div>
    </main>
    <footer id="footer">
        <img src="../assets/images/Home/icons8-facebook-60.png" alt="facebook" width="40px" haight="40px">
        <img src="../assets/images/Home/icons8-instagram-60.png" alt="instagram"width="40px" haight="40px">
        <img src="../assets/images/Home/icons8-twitter-60.png" alt="twitter" width="40px" haight="40px">
        <img src="../assets/images/Home/icons8-whatsapp-60.png" alt="whatsapp" width="40px" haight="40px">
        <img src="../assets/images/Home/icons8-gmail-60.png" alt="gmail" width="40px" haight="40px">
        <!-- social media icons and copyrights -->
    </footer>
</body>
</html>
 