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
    <main>
        <button onclick="showSearchBloc()">search</button>
        <button onclick="addDate()">New date</button>
        <div id="add_date">
            <h2>When is the next date for donation?</h2>
            <form action="" method="post">
                <label for="date">Next date:</label><br>
                <input type="date" name="date" required>
                <input type="submit" name="set_date" value="Add">
            </form>
        </div>
        <?php
            if( $id = mysqli_connect("localhost:3308", "root","mysql2024") ) {
                if( $id_db = mysqli_select_db($id, "hope_lab") ) {
                    if(isset($_POST['set_date'])) {
                        $new_date = $_POST['date'];
                        $req = "insert into dates values (?)";
                        $stmt = mysqli_prepare($id, $req);
                        mysqli_stmt_bind_param($stmt, 's', $new_date);
                        mysqli_stmt_execute($stmt);
                        if(mysqli_stmt_affected_rows($stmt) <= 0){
                            echo "<script>";
                            echo "alert('Can not add this date');";
                            echo "</script>"; 
                        }
                        else{
                            header("Location: ../php/AdminPage.php");
                            exit;
                        }
                    }
                }
                else{
                    die("Echec de connexion a la base");
                }
                mysqli_close($id);
            } 
            else {
                die("Erreur de connection au serveur");
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
        <!-- contains persons who registered and he can delete them or serch for them donation between 2 dates -->
        <h1>
            <!-- find a title for that page or just remove it -->
        </h1>
        <!-- add search for users who donate between 2 dates as button and then show a bloc like edit profile-->
        <div id="users">
        <?php
            if( $id = mysqli_connect("localhost:3308", "root","mysql2024") ) {
                if( $id_db = mysqli_select_db($id, "hope_lab") ) {
                    $get_data = "select * from users where isDonate = true order by family_name "; 
                    $result = mysqli_query($id, $get_data);
                    if(mysqli_num_rows($result) <= 0){
                        echo"Empty data base";
                    }
                    else{
                        echo"<h2>All Donataires</h2>";
                        while($row = mysqli_fetch_assoc($result)){
                            echo"<div class='single_user'>";
                                echo"<div>".$row['email']."</div>";
                                echo"<div>".$row['family_name']."</div>";
                                echo"<div>".$row['first_name']."</div>";
                                echo"<div>"."0".$row['Phone_num']."</div>";
                                echo"<form action='' method='post'>";
                                    echo "<input type='hidden' name='email' value='". $row['email']."'>";
                                    echo"<input type='submit' value='Delete' name='delete'>";
                                echo"</form>";
                            echo"</div>";
                        }
                        if(isset($_POST['delete'])) { 
                            $email = $_POST['email'];
                            $req = "delete from users where email= ?";
                            $stmt = mysqli_prepare($id, $req);
                            mysqli_stmt_bind_param($stmt,"s", $email);
                            mysqli_stmt_execute($stmt);
                            header('Location: ../php/AdminPage.php');
                            exit;
                        }
                        //search for user
                        if (isset($_POST['search'])) {
                            $startDate = $_POST['first_date'];
                            $endDate = $_POST['second_date'];
                            $req = "select * from users where isDonate = true and donation_date between ? and ? ";
                            $stmt = mysqli_prepare($id, $req);
                            mysqli_stmt_bind_param($stmt, 'ss', $startDate, $endDate);
                            mysqli_stmt_execute($stmt);
                            $dates = mysqli_stmt_get_result($stmt);
                            if(mysqli_num_rows($dates) <= 0){
                                echo"No data";
                            }
                            else{
                                echo"<div id='result_search'>";
                                    echo"<h2>Donataire between $startDate and $endDate </h2>";
                                    while($row = mysqli_fetch_assoc($dates)){
                                        echo"<div class='single_user'>";
                                            echo"<div>".$row['email']."</div>";
                                            echo"<div>".$row['family_name']."</div>";
                                            echo"<div>".$row['first_name']."</div>";
                                            echo"<div>"."0".$row['Phone_num']."</div>";
                                            echo"<form action='' method='post'>";
                                                echo "<input type='hidden' name='email' value='". $row['email']."'>";
                                                echo"<input type='submit' value='Delete' name='delete'>";
                                            echo"</form>";
                                        echo"</div>";
                                    }
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
                }
                else{
                    die("Echec de connexion a la base");
                }
                mysqli_close($id);
            } 
            else {
                die("Erreur de connection au serveur");
            }
        ?>
        </div>
    </main>
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
</body>
</html>