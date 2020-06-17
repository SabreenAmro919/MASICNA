<?php session_start();
?>
<!doctype html>
<html lang="en">
    
    <head>
          <title>Admin Page</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
          <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">


        <style>
            * {
                box-sizing: border-box;
            }
            .column{
                float:left;
                width:50%;
                padding:10px;
                height:100%;
                
            }
            .row:after{
                content:"";
                display: table;
                clear: both;
            }
        
        </style>
        <title>Admin Page</title>
        
        
    </head>
    <body style="background-image: url(mk-masicna2018-day-2-64_orig.jpg); background-repeat: no-repeat; background-size: cover; background-position:relative;margin:auto;">
        <center> 
            <div id="nav-bar" style="height: 1000; width: 90%;background-color: darkred; border: 5px outset white;padding: 5px;">
                <a href="index2.html"><img src="images.jpg" style="width: 65px; height: 55px;margin-top:.1%;"/></a> 
            </div>
            
            <div id="banner">
                <img src="mascon2019-dates-led_1.jpg" alt="dates-banner"  style="height: 150px;width:76%; border: 5px outset white; margin: 10pt;"/>
            </div>
            <div style="width: 75%;">
                <div class="row">
                    <div class="column" style="background-color: #aaa;">
                    
                        <h3 style="font-size: 25px;">Search an Attendee</h3>
                        <div class="container">
                          <!-- Button to Open the Modal -->
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            Begin!
                          </button>
                        </div>
                    
                    </div>
              
                    <div class="column" style="background-color:#bbb;">
                       
                        
                        <h2 style="font-size:31.5px;"><button type="button" onclick="toggleFunction()" style="border-radius: 10px; background-color: #0662d9; color: white;">Register an Attendee</button></h2><br>
                        <div id="regFormDIV" style="display:none;">
                            <form action="" method="post" id="regForm">
                                <label><b>First Name : </b></label>
                                <input type="text" name="firstname" id="firstName"><br>
                                <label><b>Last Name : </b></label>
                                <input type="text" name="lastname" id="lastname"><br>
                                <label><b>Age Group: </b></label>
                                <input type="radio" name="age" value="10"> 10
                                <input type="radio" name="age" value="11"> 11
                                <input type="radio" name="age" value="12"> 12
                                <input type="radio" name="age" value="13"> 13<br>
                                <label><b>Guardian Name: </b></label>
                                <input type="text" name="guardianName" id="guardianName"><br>
                                <label><b>Guardian Phone</b></label>
                                <input type="tel" name="guardianPhone" id="guardianPhone" pattern="[0-9]{10}" >
                                <br>
                                <label><b>Emergency Contact: </b></label>
                                <input type="text" name="ecName" id="ecName"><br>
                                <br>
                                <label><b>Self check out?</b></label>
                                <input type="radio" name="checkout" value="yes">Yes
                                <input type="radio" name="checkout" value="no">No<br>
                                <label><b>Lunch Money? </b></label>
                                <input type="text" id="lunchmoney"> <br>
                                
                                <input type="submit" style="font-family: 'Raleway', sans-serif; font-size: 15px; opacity: 1;">
                                
                            </form>
                           
        
                        </div>
                        <script>
                            function toggleFunction(){
                                var x = document.getElementById("regFormDIV");
                                if (x.style.display === "none") {
                                    x.style.display = "block";
                                } 
                                else {
                                    x.style.display = "none";
                                }
                            }
                        
                        </script>
                        <?php
                                
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "cs480_proj";

                                $conn = new mysqli($servername, $username, $password, $dbname);
                                
                                //$attFirstName = $_POST['firstname'];
                                $attFirstName = (isset($_POST['firstname'])) ? $_POST['firstname'] : " ";
                               // $attLastName = $_POST['lastname'];
                                $attLastName = (isset($_POST['lastname'])) ? $_POST['lastname'] : " ";
                                //$attDOB = $_POST['dob'];
                                
                                //$attAgeGroup = $_POST["age"];
                                $attAgeGroup = (isset($_POST['age'])) ? $_POST['age'] : " ";
                                //$guardName = $_POST['guardianName'];
                                $guardName = (isset($_POST['guardianName'])) ? $_POST['guardianName'] : " ";
                                //$guardPhone = $_POST['guardianPhone'];
                                $guardPhone = (isset($_POST['guardianPhone'])) ? $_POST['guardianPhone'] : " ";
                                //$emergName = $_POST['ecName'];
                                $emergName = (isset($_POST['ecName'])) ? $_POST['ecName'] : " ";
                                //$emergPhone = $_POST['ecPhone'];
                                
                                //$attCheckOutSelf = $_POST['checkout'];
                                $attCheckOutSelf = (isset($_POST['checkout'])) ? $_POST['checkout'] : " ";
                                $_SESSION['checkout'] = $attCheckOutSelf;
                                //$attLunch = $_POST['lunchMoney'];
                                $attLunch = (isset($_POST['lunchMoney'])) ? $_POST['lunchMoney'] : " ";
                               
                                //$attGender = $_POST['boygirl'];
                                

                                if($conn->connect_error){                       
                                    die("<p>Connection Failed: </p>" . $conn->connect_error);
                                }
                                    
                                    $sql2 = "SELECT first_name from attendee_info order by first_name";
                                    
                                    if($result=mysqli_query($conn, $sql2)){
                                        $rowcount = mysqli_num_rows($result);
                                    }else{
                                        echo " ";
                                    }
                                     $attID = $rowcount + 1;
                                    
                                   
                                    $sql = "INSERT INTO attendee_info(`id`, `first_name`, `last_name`, `age_group`, `guardian_name`, `guardian_phone`, `emergency_name_phone`, `checkout`, `lunch_money`) VALUES ($attID, '$attFirstName', '$attLastName', $attAgeGroup, '$guardName', $guardPhone, '$emergName', '$attCheckOutSelf', '$attLunch')";
                                    
                                    if($conn->query($sql) === TRUE){
                                    
                        
                                        echo "Attendee has been successfully registered!";
                                    }else{
                                    
                                        echo "Please try again!";
                                        
                                }

                            
                            ?>
                    
                    </div>
                     
                </div>
            </div>    
      </center>
                         <!-- The Modal -->
      <div class="modal fade" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Enter the Name of the Attendee</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form id="searchForm" action="results.php" method="get">
                    <b><label style="font-size: 25px;">First Name: </label></b><input type="text" name="firstname" id="firstName" style="height: 20px;margin-left:7px;">
                    <br>
                    <b><label style="font-size:25px;">Last Name: </label></b><input type="text" name="lastname" id="lastName" style="height: 20px;margin-left:7px;"><br>
                    <center><input type="submit" style="font-family: 'Raleway', sans-serif; font-size: 15px; opacity: 1;"></center>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>
         
    
    
    </body>







</html>