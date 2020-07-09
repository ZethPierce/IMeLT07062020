<?php 
include('connection.php');
include('tags.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMeLT</title>
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
</head>
<body>

<div class="container" style="max-width: 1000px;">
    <center>
  <img src="assets/img/IMeLTLogo.png" class="mx-auto img-fluid" width="250" />
  <br><br>
</center>
  <br>

  <div class="lineBorder" style="margin-top: -90px;">
    <!--START OF MODULE FOR TICKET DISPLAY (ADMIN DISPLAY)-->
<?php 
if(isset($_POST["register"]))
{
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['last_name'];
$username = $_POST['username'];  
$password = $_POST['password']; 
$user_progress_id = $_POST['user_progress_id'];

$query = mysqli_query($conn, "SELECT * FROM tbl_user_credentials WHERE username='$username'");

$user_id_count = mysqli_query($conn, "SELECT * FROM tbl_user_credentials ORDER BY id DESC LIMIT 1");
while($row = mysqli_fetch_array($user_id_count)){
    $u_id = $row['user_progress_id'] + 1;
    $query_insert = mysqli_query($conn, "INSERT INTO tbl_user_credentials VALUES('', '$last_name', '$first_name', '$middle_name', '$username', '$password', $user_progress_id)");   

    $query_insert .= mysqli_query($conn, "INSERT INTO tbl_progress VALUES('', '$u_id', '1', '1', 'unlocked'");  
    $twoquery = mysqli_query($conn, $query_insert);
}

    if(mysqli_num_rows($query)> 0){
        echo '<div class="alert alert-danger alertClass">
                <center>
                <strong>This username is already taken.</strong>
                </center>
                </div> ';
            }
    
    else{
        if($query_insert) {
             echo '<div class="alert alert-success alertClass">
                <center>
                <strong>Insert Success.</strong>
                </center>
                </div> ';
            }
    }    
}
?>

    <?php 
   
    
    ?>
    <br>    
        <div class="row">
            <div class="col-lg-6">
                <img src="assets/img/mobile_ux.png" class="loginDesign">
            </div>
                <div class="col-lg-6">
                <form action="" method="post">
                    <h5 style="margin-bottom: 15px;">Sign Up</h5>
                    <div class="form-group-sm">
                        <input type="text" name="last_name" placeholder="Enter your last name" class="form-control form-control-sm inputClass" required>
                        
                        <input type="text" name="first_name" placeholder="Enter your first name" class="form-control form-control-sm inputClass" required>
                        
                        <input type="text" name="middle_name" placeholder="Enter your middle name" class="form-control form-control-sm inputClass">

                        <span id="availability" style="margin-left: 15px;"></span>

                        <input type="text" name="username" placeholder="Enter your username" class="form-control form-control-sm inputClass" id="username" style="" maxlength="15" required>
                        
                        <input type="password" name="password" placeholder="Enter your password" class="form-control form-control-sm inputClass" maxlength="15" required>
                        <?php  
                        $user_id_count = mysqli_query($conn, "SELECT * FROM tbl_user_credentials ORDER BY id DESC LIMIT 1");
                        while($row = mysqli_fetch_array($user_id_count)){
                            $u_id = $row['user_progress_id'];

                        echo '<input type="hidden" name="user_progress_id" value="'.$u_id.'">';
                            
                        } 

    ?>
                    </div>
                    <div class="form-group-sm" style="margin-top: 14px; margin-bottom: 10px;">
                        
                            <input type="submit" class="btn btn-block btn-primary buttonClass" value="REGISTER" name="register" id="register">
                    </div>
                    <center>
                        <a href="login.php" class="text-center" style="margin-top: 14px !important;">Already have an account? Click this to log in.</a>
                    </center>
                </form>
            </div>
        </div>
        <br>
    </div>
</div>
</body>
</html>


<script>
    /* Validate username */
    $(document).ready(function(){
        $('#username').keyup(function(){
            var username = $(this).val();
            $.ajax({
                url:"username_taken.php",
                method:"POST",
                data:{username:username},
                dataType:"text",
                success:function(html)
                {
                    $('#availability').html(html);
                }
                
            });
        });
    });

$(".alertClass").fadeTo(2000, 500).slideUp(500, function(){
    $(".alertClass").slideUp(500);
});


</script>