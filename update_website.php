<?php
  echo 'Press the button to update the website from github.';
  echo '<form method="post">
          <input type="submit" name="update" value="Update"/>
        </form>';
  if (array_key_exists('update', $_POST)) {
    echo 'Updating website...';
    $output = shell_exec('/home/hipt3660/update_website 2>&1');
    shell_exec('chmod -R 777 /home/hipt3660/public_html/*');
    echo "<pre>$output</pre>";
    echo 'Updated!';
  }
?>