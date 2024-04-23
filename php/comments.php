<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/icons8-blood-drop-32.png">
    <link rel="stylesheet" href="../styles/donataire.css">
    <title>Blood Donate | Add comment</title>
</head>
<body>
    <header>
        <!--logo -->
        <nav>
            <ul>
                <li><a href="../index.html">Home</a></li>  
                <li><a href="./pages/FAQ.html">FAQ</a></li>
                <li><a href="../php/profile.php">Profile</a></li> 
            </ul>
        </nav>
    </header>
    <!-- comments -->
    <!-- button to donation request -->
    <main>
        <?php
                require_once 'db_connect.php';
                $req = "select * from comments";
                $res =  mysqli_query($id,$req);
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo"<div id='comment'>";
                            echo"<div id='comment'>".$row['email']."</div>";
                            echo"<div id='comment'>".$row['comment']."</div>";
                            echo"<form action='' method='post'>";
                                echo"<input type='hidden' name='email' value = '".$row['email']."'>";
                                echo"<input type='hidden' name='comment_id' value = '".$row['id']."'>";
                                echo"<input type='submit' name='delete' value='Delete'>";
                            echo"</form>";
                        echo"</div>";
                    }
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
        <button onclick="postComment()">COMMENT NOW</button>
        <div id="comments_box" style="display:none;">
        <form action="" method="post">
            <label for="email">Your email:</label><br>
            <input type="email" name="email" required><br>
            <label for="comment">Your comment :</label><br>
            <textarea id="textArea" name="comment"></textarea><br>
            <input type="submit" name="post" value="POST">
        </form>
        <button onclick="hideComment()">Discard</button>
        </div>
    </main>
            <script>
                function postComment(){
                    document.getElementById('comments_box').style.display ="block";
                }
                function hideComment(){
                    document.getElementById('comments_box').style.display ="none";
                }
            </script>
</body>
</html>