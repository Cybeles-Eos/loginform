<!-- Main Form, Main site -->
<?php 
  include("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
   <link rel="stylesheet" href="style.css">
   <title>Sports Login</title>
</head>
<body>
  <div class="container-md px-5 py-4 my-5">
    <h1 class="fm_title text-center">Sports Login</h1>
    <h3 class="fm_label text-center">Log in to your sports account! Access your teams, track stats, and follow your favorite matches by signing in below.</h3>

    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="fm_form p-4 mt-5 rounded-2">
      <!-- ____Username and Password Inputs____ -->
      <div class="mb-3">
          <label for="username" class="form-label"><span class="req">*</span> Username </label>
          <input type="text" name="username" id="username" class="form-control" placeholder="e. g. Juancruz" required autocomplete="off" aria-describedby="username-help">
      </div>
      <div class="mb-1">
          <label for="password" class="form-label"><span class="req">*</span> Password </label>
          <input type="password" name="password" id="pass" class="form-control" id="exampleInputEmail1" required autocomplete="new-password" aria-describedby="emailHelp"> 
      </div>
      <div class="mb-3 w-100 d-flex justify-content-end">
        <a href="sigin.php" class="me-1">Don't have account?</a>
      </div>

      <!-- ____Submit Button____ -->
      <button class="btn btn-primary mt-0 w-25" id="btn">Login</button>
      
    </form>
  </div>
  <?php 
    if($_SERVER["REQUEST_METHOD"] === "POST"){
      
      if(isset($_POST["username"]) && isset($_POST["password"])){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if(empty($username) && empty($password)){ 
          return;
        }

        $sql_req = "SELECT * FROM users WHERE username = '$username'";
        try{
          $user = mysqli_query($conn, $sql_req);
          if (mysqli_num_rows($user) > 0) {
            $result = mysqli_fetch_assoc($user);
        
            if ($result['username'] == $username && password_verify($password, $result['password'])){
              header("Location: dashboard.php");
              exit;
            }

            echo "<script>alert('Username or password incorrect');</script>";
            return;
          }else{
            echo "<script>alert('User not found')</script>";
            return;
          }
        }catch(mysqli_sql_exception){
          echo "<script>alert('Something went wrong, Please Try again.')</script>";
          return;
        } 
      }
    }
  ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></>
</html>
<?php 
  mysqli_close($conn);
?>
