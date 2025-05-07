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
   <title>Sports Sign-in</title>
</head>
<body>
  <div class="container-md px-5 py-4 my-5">
    <h1 class="fm_title text-center">Sign-in account</h1>
    <h3 class="fm_label text-center">Sign in to your account to access exclusive sports updates, live scores, and team stats.</h3>

    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="fm_form p-4 mt-5 rounded-2">
      <!-- ____Username and Password Inputs____ -->
      <div class="mb-3">
          <label for="username" class="form-label"><span class="req">*</span> Username </label>
          <input type="text" name="username" id="username" class="form-control" placeholder="e. g. Juancruz" required autocomplete="off" aria-describedby="username-help">
      </div>
      <div class="mb-3">
          <label for="password" class="form-label"><span class="req">*</span> Password </label>
          <input type="password" name="password" id="pass" class="form-control" required autocomplete="new-password" aria-describedby="passwordHelp"> 
      </div>
      <div class="mb-4">
          <label for="conf-password" class="form-label"><span class="req">*</span> Confirm password </label>
          <input type="password" name="conf-password" id="conf-pass" class="form-control" required autocomplete="new-password" aria-describedby="passwordHelp"> 
      </div>

      <!-- ____Submit Button____ -->
      <button class="btn btn-primary w-25" id="btn">Signin</button>
      
    </form>
  </div>
  <?php 
      mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Enables exceptions

      if($_SERVER["REQUEST_METHOD"] === "POST"){
         if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['conf-password'])){
            if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['conf-password'])){
               return;
            }

            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
            $pass = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
            $conf_pass = filter_input(INPUT_POST, 'conf-password', FILTER_SANITIZE_SPECIAL_CHARS);

            if($pass !== $conf_pass){
               echo "<script>alert('Password don\'t match')</script>";
               return;
            }

            $hash = password_hash($pass, PASSWORD_DEFAULT); 
            $sql_req = "INSERT INTO users (username, password) VALUE ('$username', '$hash')";
            
            try{
               mysqli_query($conn, $sql_req);
               echo "<script>
                  alert('Account has been register');
                  window.location = 'login.php';
               </script>";
            }catch(mysqli_sql_exception $e){
               if ($e->getCode() === 1062) {
                  echo "<script>alert('Username already exists!')</script>";
                  return;
               }
               echo "<script>alert('Database Could not connect')</script>";
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