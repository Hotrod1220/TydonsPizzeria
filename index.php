<?php
  echo '<html>
        <head>
            <meta charset="UTF-8">
            <title>Tydon\'s Pizzeria</title>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Acme&family=Montserrat&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="css/style.css">
        </head>
  ';
  echo '<body>
          <header class="wrapper">
              <div class="container orange-text">
                  <h1>Tydon\'s Pizzera</h1>
              </div>
          </header>
          <main class="wrapper container">
              <h2 class="orange-text">Adminstrator Access</h2>
              <div class="grid-three">
                  <div class="text-wrapper">
                      <h3>Menu Options</h3>
                      <a href="insert_menu.php" class="button">Insert Menu Item</a>
                      <a href="manage_menu.php" class="button">Manage Menu</a>
                  </div>
                  <div class="text-wrapper">
                      <h3>Customer Options</h3>
                      <a href="insert_customer.php" class="button">Add Customer</a>
                      <a href="manage_customer.php" class="button">Manage Customer</a>
                  </div>
                  <div class="text-wrapper">
                      <h3>Employee Options</h3>
                      <a href="insert_employee.php" class="button">Hire Employee</a>
                      <a href="manage_employee.php" class="button">Manage Employees</a>
                  </div>
                  <div class="text-wrapper">
                      <h3>Order Options</h3>
                      <a href="insert_order.php" class="button">Place an Order</a>
                      <a href="view_order.php" class="button">View an Order</a>
                  </div>
                  <div class="text-wrapper">
                      <a href="update_website.php" class="button">DEV: update website page</a>
                  </div>
              </div>
          </main>
        </body>

      </html>
  ';
?>

<!-- echo '<html>
        <head>
          <title>Tydon\'s Pizzeria</title>
        </head>
        <body>
  ';
  echo '<h1>Welcome to Tydon\'s Pizzeria</h1>
        <button onclick="window.location.href = \'insert_menu.php\'">Add menu item</button><br><br>
        <button onclick="window.location.href = \'manage_menu.php\'">Manage Menu</button><br><br>
        <button onclick="window.location.href = \'insert_customer.php\'">Add customer</button><br><br>
        <button onclick="window.location.href = \'manage_customer.php\'">Manage customers</button><br><br>
        <button onclick="window.location.href = \'insert_employee.php\'">Hire employee</button><br><br>
        <button onclick="window.location.href = \'manage_employee.php\'">Manage employees</button><br><br>
        <button onclick="window.location.href = \'insert_order.php\'">Place an order</button><br><br>
        <button onclick="window.location.href = \'view_order.php\'">View an order</button><br><br>
        More buttons coming soon...<br><br>
        <button onclick="window.location.href = \'view_order.php\'">DEV: update website page</button>
  '; -->