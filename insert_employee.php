<!DOCTYPE html>
<html>
    <head>
        <title>Tydon's Pizzeria - Hire a New Employee</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h2>Hire a New Employee</h2>
        <form action="insertemployee.php" method=post>
            Employee ID: <input type=text name="empID" size=8><br><br>
            Name: <input type=text name="name" size=20><br><br>
            Wage: <input type=text name="wage" size=6><br><br>
            Position: <input type=text name="position" size=15><br><br>
            On Shift?: <input type=checkbox name="clockedIn" size=15><br><br>
            <input type=submit name="submit" value="Insert">
        </form>     
    </body>
</html>