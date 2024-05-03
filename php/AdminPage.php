<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/icons8-blood-drop-32.png">
    <link rel="stylesheet" href="../styles/adminPage.css">
    <title>Admin page</title>
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
        <div class="btn">
        <button onclick="showSearchBloc()">search</button>
        <button onclick="addDate()">New date</button>
        </div>
        <div id="add_date">
            <h2>When is the next date for donation?</h2>
            <form action="" method="post">
                <label for="date">Next date:</label><br>
                <input type="date" name="date" required>
                <input type="submit" name="set_date" value="Add">
            </form>
        </div>
        <?php
            require 'db_connect.php';
                    if(isset($_POST['set_date'])) {
                        $new_date = $_POST['date'];
                        $req = "insert into dates (aval_donate_date) values ('$new_date')";
                        if(mysqli_query($id, $req) == 0){
                            echo "<script>";
                            echo "alert('Can not add this date');";
                            echo "</script>"; 
                        }
                        else{
                            header("Location: ../php/AdminPage.php");
                            exit;
                        }
                    }

        ?>
        <div id="search_box">
            <h2>Search for a Donataire: </h2><br/>
            <form action="" method="post">
                <label for="first_date">Start Date:</label><br>
                <input type="date" name="first_date"  required><br>
                <label for="second_date">End Date:</label><br>
                <input type="date" name= "second_date" required><br>
                <div id="buttons">
                    <input type="submit" name='search' value='search'/>
                    <button onclick="hideSearchBloc()">Cancel</button>
                </div> 
            </form>
        </div>
        <div id="users">
        <?php
            
                require 'db_connect.php';
                    $get_data = "select * from users join donation where users.email = donation.email ";
                    $result = mysqli_query($id, $get_data);
                    if(mysqli_num_rows($result) <= 0){
                        echo"<h1>No person donate yet</h1>";
                    }
                    else{
                        echo"<h2 style='margin-bottom:20px;'>All Donataires</h2>";
                        echo"<table class='single_user' style='margin-bottom:40px;'>";
                            echo"<th>Email</th>";
                            echo"<th>Family name</th>";
                            echo"<th>First name</th>";
                            echo"<th>Type Blood</th>";
                            echo"<th>Phone number</th>";
                            echo"<th>Donation date</th>";
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<tr class='user_info'>";
                                    echo"<td>".$row['email']."</td>";
                                    echo"<td>".$row['family_name']."</td>";
                                    echo"<td>".$row['first_name']."</td>";
                                    echo"<td>".$row['typeBlood']."</td>";
                                    echo"<td>"."0".$row['Phone_num']."</td>";
                                    echo"<td>".$row['date']."</td>";
                                    echo "<td>";
                                        echo"<form action='' method='post'>";
                                            echo "<input type='hidden' name='email' value='". $row['email']."'>";
                                            echo"<input type='submit' value='Delete' name='delete'>";
                                        echo"</form>";
                                    echo"</td>";
                                echo"</tr>";
                            }
                        echo"</table>";
                        if(isset($_POST['delete'])) { 
                            $email = $_POST['email'];
                            $req = "delete from users where email= '$email'";
                            mysqli_query($id, $req);
                            header('Location: ../php/AdminPage.php');
                            exit;
                        }
                        //search for user
                        if (isset($_POST['search'])) {
                            $startDate = $_POST['first_date'];
                            $endDate = $_POST['second_date'];
                            $req = "select * from users where isDonate = true and donation_date between '$startDate' and '$endDate' ";
                            $dates = mysqli_query($id, $req);
                            if(mysqli_num_rows($dates) <= 0){
                                echo"No data";
                            }
                            else{
                                echo"<div id='result_search'>";
                                    echo"<h2>Donataire between $startDate and $endDate </h2>";
                                    echo"<table class='single_user'>";
                                        echo"<th>Email</th>";
                                        echo"<th>Family name</th>";
                                        echo"<th>First name</th>";
                                        echo"<th>Type Blood</th>";
                                        echo"<th>Phone number</th>";
                                        while($row = mysqli_fetch_assoc($dates)){
                                            echo"<tr class='single_user'>";
                                                echo"<td>".$row['email']."</td>";
                                                echo"<td>".$row['family_name']."</td>";
                                                echo"<td>".$row['first_name']."</td>";
                                                echo"<td>".$row['typeBlood']."</td>";
                                                echo"<td>"."0".$row['Phone_num']."</td>";
                                                echo"<td>";
                                                    echo"<form action='' method='post'>";
                                                        echo "<input type='hidden' name='email' value='". $row['email']."'>";
                                                        echo"<input type='submit' value='Delete' name='delete'>";
                                                    echo"</form>";
                                                echo"</td>";
                                            echo"</tr>";
                                        }
                                    echo"</table>";
                                    echo"<button onclick='hideDonataire()'>Hide Donataire</button>";
                                echo"</div>";
                                echo"<script>";
                                        echo"function hideDonataire(){
                                             document.getElementById('result_search').style.display = 'none';
                                        }";
                                echo"</script>";
                            }
                        }
                    }
        ?>
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
<script>
        function showSearchBloc(){
            document.getElementById('search_box').style.display = "block";
        }
        function hideSearchBloc(){
            document.getElementById('search_box').style.display = "none";
        }
        function addDate(){
            document.getElementById('add_date').style.display = "block";
        }
    </script>
</html>