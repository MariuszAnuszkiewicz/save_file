<?php
if (!defined('AUTOLOAD')) {
    define('AUTOLOAD', '../autoload/');
}
require_once(AUTOLOAD . "autoloading.php");

use MariuszAnuszkiewicz\classes\GetData;
use MariuszAnuszkiewicz\classes\Session;
use MariuszAnuszkiewicz\classes\Run;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Table</title>
</head>
<body>
<?php
 $sessionObj = new Session();
 if (Session::exists('user') && Session::get('user')) :
     if (isset($_REQUEST['logout'])) {
         echo "<a href=''" . Run::logout() . "'>Log out</a>";
     } else {
         echo "<a href='?logout'>Log out</a>";
     }
?>

<div id="view-content">
  <table class="users_table" style="display: block; width: 300px; height: auto; margin-top: 12px; margin-bottom: 12px;">
   <thead>
    <tr style="border: 1px solid black;">
       <th style="border-right: 1px solid black; border-bottom: 1px solid black;  padding-right: 8px;">Name</th>
       <th style="border-right: 1px solid black; border-bottom: 1px solid black;  padding-right: 8px;">Surname</th>
       <th style="border-right: 1px solid black; border-bottom: 1px solid black;  padding-right: 8px;">File</th>
    </tr>
   </thead>
  <tbody>
<?php
  $dataObj = new GetData();
  foreach ($dataObj->getReadingProcess() as $result) {
     list($name, $surname, $file) = explode(", ", $result[0]);
     ?><td><?= $name; ?></td><?php
     ?><td><?= $surname; ?></td><?php
     ?><td><?= $file; ?></td><?php
  }
?>
  </tbody>
  </table>
</div>
<?php echo '<b><a href=' . $dataObj->getFileToSave("link") . '>Link do pliku</a></b>'; ?>
<?php else : header("Location: ../includes/user_login.php"); ?>

<?php endif ?>

<div class="redirect_to_save">
 <a class="save-file-btn" href="../includes/save_file.php">Save File</a>
</div>
</body>
</html>

