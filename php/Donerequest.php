<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/request.css">

    <title>Blood Donate | Donation request</title>
</head>
<body>
    <main>
        <h2>Donation Request</h2><br/>
        <form action="" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
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
                                    if(date("Y-m-d") >  $date['aval_donate_date']){//getting current date
                                        continue;
                                    }else{
                                        echo"<option>".$date['aval_donate_date']."</option>";
                                    }
                                }
                            }
                ?>
            </select>
            <input type="submit" name="donate" value="Donate" />
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
</body>
</html>