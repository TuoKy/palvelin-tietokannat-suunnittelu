<?php
session_start();
if (isset($_POST['tunnus']) AND isset($_POST['salasana'])) {
require_once ("../palvelin/myslijuttu/hurhur.php"); 
 
$tunnus = $_POST['tunnus'];
$salasana = $_POST['salasana'];
 
$stmt = $db->prepare("SELECT tunnus FROM henkilot WHERE tunnus = ? AND salasana =PASSWORD(?)");
$stmt->execute(array($tunnus,$salasana));
    if ($stmt->rowCount() == 1) {
		
        $_SESSION['app2_islogged'] = true;
        $_SESSION['tunnus'] = $_POST['tunnus'];
         header("Location: http://" . $_SERVER['HTTP_HOST']
                                    . dirname($_SERVER['PHP_SELF']) . '/'
                                    . "h6-list.php");
        exit;
        }
        else
          echo 'Tunnus/Salasana vaarin!';
        }
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"
style=color:#000;background-color:#eeeeee>
Tunnus:<br><input type="text" name="tunnus" size="30"><br>
Salasana:<br><input type="text" name="salasana" size="30"><br>
<input type='submit' name='action' value='Kirjaudu'>
<br>
</form>