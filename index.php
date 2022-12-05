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
                  <h1>Tydon\'s Pizzeria</h1>
              </div>
          </header>
          <main class="container">
              <h2 class="orange-text">Adminstrator Access</h2>
              <div class="grid-two">
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
                      <a href="view_order.php" class="button">View an Order</a><br>
                      <a href="manage_orders.php" class="button">Manage an Order</a>
                      <a href="update_order.php" class="button">Update an Order</a>
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