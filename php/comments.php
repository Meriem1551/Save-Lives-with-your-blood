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
      <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@600;700&family=Truculenta:opsz@12..72&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
:root{
    --light-pink:#fee5e5;
    --medium-pink:#fed0d0;
    --ligth-gray: lightgray;
    --pink:#EFB3B4;
    --red: #fc1b1b;
    --medium-red: #a00404;
    --dark-blue:#1E0377;
    --white: white;
    --dark-red:rgb(102, 2, 4);
    --font-family-paragraphs : Poppins;
    --font-family-heading: Kanit;
    --font-weight-regular: 400;
    --font-weight-semiBold: 600;
    --font-weight-bold: 700;
    --font-size: 20px;
}
        .grid{
    display: flex;
    justify-content: space-between;
    margin-top: 70px;
    margin-bottom: 100px;
}
.clients-h2{
    color: var(--red);
    font-family: var(--font-family-heading);
    position: relative;
    margin-left: 39%;
    letter-spacing: 3px;
    margin-top: 50px;
}

.test-clients{
    display: flex;
    flex-direction: row;
    margin-top: 100px;
    justify-content: space-evenly;
    align-items: baseline;
    padding: 20px;

}

.test-clients .email{
    font-family: var(--font-family-heading);
    font-size: 16px;
    text-align: center;
   
    color: var(--red);
    width: 315px;
    margin-bottom: 40px;
}
.test-clients .comment{font-family: var(--font-family-paragraphs);
    font-weight: var(--font-weights-normal);
    font-size: 16px;
    text-align: center;
     color: black;
    margin-bottom: 10px;
}
.client{
    display: flex;
    flex-direction: column;
    justify-content: center;
    box-shadow: 1px 3PX 5PX 3PX rgba(2, 2, 2, 0.575);
}
    </style>
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
 