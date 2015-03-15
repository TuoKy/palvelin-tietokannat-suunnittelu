<?php 
// IS WORK IN PROGRESS
require_once ("../palvelin/myslijuttu/hurhur.php"); // kytän tietokanta avaus juttu
// mikko pistä oma tietokannan avaus taikasi tähän ja pistä mun oma kommentteihin

session_start();
if (isset($_POST['username']) AND isset($_POST['password'])) {

$username = $_POST['username'];
$password = $_POST['password'];
 
$stmt = $db->prepare("INSERT INTO Kayttaja values WHERE kayttajaNimi = ? AND salasana =?");
$stmt->execute(array($username,$password));
    if ($stmt->rowCount() == 1) {
  
        $_SESSION['app2_islogged'] = true;
        $_SESSION['username'] = $_POST['username'];
        }
        else
          echo 'wrong username/password !';
        }

?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"
style=color:#000;background-color:#eeeeee>
Tunnus:<br><input type="text" name="tunnus" size="30"><br>
Salasana:<br><input type="text" name="salasana" size="30"><br>
<input type='submit' name='action' value='Kirjaudu'>
<br>
</form>