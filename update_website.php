<head>
        <meta charset="UTF-8">
        <title>Tydon's Pizzeria - Manage Orders</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Acme&family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
    </head>
  <body>
    <header class="wrapper">
      <div class="container orange-text">
          <h1><a href="index.php">Tydon's Pizzeria<a></h1>
      </div>
    </header>
    <main class="container">
      <h2 class="text-wrapper">Press the button to update the website from github.</h2>
      
<?php
  echo '<div class="align-center">
          <form method="post">
            <input type="submit" class="big-button" style="font-size:50px" name="update" value="Update"/>
          </form>
        </div>';
  if (array_key_exists('update', $_POST)) {
    echo 'Updating website...';
    $output = shell_exec('/home/hipt3660/update_website1 2>&1');
    shell_exec('chmod -R 777 /home/hipt3660/public_html/*');
    echo "<pre>$output</pre>";
    echo 'Updated!';
    echo "<br> <br> <a href=\"index.php\" class=\"button\">Return to Home</a> ";
  }
?>
  </main>
  </body>