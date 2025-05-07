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
   <title>Dashboard</title>
   <style>
      #main{
         margin-top: 10rem !important;
         height: 100rem;
      }
      #pr{
         max-width: 600px;
         font-size: 16px;
      }
      #sss{
         width: 500px;
         position: fixed !important;
         top: 1rem;
         left: 50%;
         transform: translateX(-50%);
      }
   </style>
</head>
<body>
   <nav id='sss' class="navbar navbar-light bg-dark rounded-2">
      <div class="container-fluid">
         <a class="navbar-brand text-light ms-2">Navbar</a>
         <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="d-flex">
            <button class="btn btn-outline-danger" name="logout" type="submit">Logout</button>
         </form>
      </div>
   </nav>
   <main class="px-3 mt-5 d-flex flex-column align-items-center" id="main">
      <h1 class="text-light">Welcome back Player</h1>
      <p class="lead text-center my-3 mb-5" id="pr">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>
      <p class="lead">
         <a href="#" class="btn btn-secondary fw-regular border-dark bg-dark px-4">Learn more</a>
      </p>
   </main>
   <?php 
      if(isset($_POST["logout"])){
         session_destroy();

         header("Location: login.php");
         exit();
      }
   ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</html>