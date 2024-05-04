<?php
session_start();
include("./includes/db-parameter.php");



$vartodo = htmlspecialchars($_POST['todo']);
$varuser = htmlspecialchars($_POST['user']);
$varpassword = $_POST['password'];

$ueberschrift = "<h4>Login für meine Filme-Datenbank</h4>";

if ($vartodo == "login") {
  $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $db . '', $user, $pwd);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  try {
    $query = $pdo->prepare("SELECT user FROM user WHERE LOWER(user) = ? AND password = ? ;");
    $query->execute(array($varuser, $varpassword));
    $response = $query->fetch();
    $pdo = null;
  } catch (PDOException $e) {
    echo "DataBase Error:<br>" . $e->getMessage();
  } catch (Exception $e) {
    echo "General Error:<br>" . $e->getMessage();
  }



  //var_dump($response);
  if ($response && password_verify($varpassword, $response['password'])) {
    // Login successfull !
    $_SESSION['ok_logged_in'] = true;
    $weiterleitung = "list.php";
    header("Location: $weiterleitung");
    exit;
  } else {
    $ueberschrift = '<h4 style="color:red;">Bitte Login-Daten erneut eingeben</h4>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" href="./images/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="./src/bootstrap.min.css" rel="stylesheet">
  <script>
    // Eingabe-Validierung mit einfachen Alerts als Wahrnung
    function LoginUser() {
      if (document.Login_Form.user.value.length < 3) {
        alert("Bitte tragen Sie Ihren Usernamen ein.");
        return false;
      } else if (document.Login_Form.password.value.length < 4) {
        alert("Bitte tragen Sie Ihr Passwort ein.");
        return false;
      }

      document.Login_Form.method = "post";
      document.Login_Form.todo.value = "login";
      document.Login_Form.action = "index.php";
      document.Login_Form.submit();
    }
  </script>
  <link rel="stylesheet" href="src/login.css" />
  <title>Login</title>
</head>

<body>
  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->
      <div class="fadeIn first">
        <?php echo $ueberschrift; ?>
      </div>
      <!-- Login Form -->
      <form method="post" name="Login_Form" id="Login_Form" target="_self">
        <input type="hidden" name="todo" id="todo" value="" class="versteckt">
        <input type="text" id="login" class="fadeIn second" name="user" placeholder="User">
        <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
        <input type="button" class="fadeIn fourth" value="Log In" onclick="javascript:LoginUser();">
      </form>
      <!-- Remind Passowrd -->
      <div id="formFooter">
        <a class="underlineHover" href="#">User: hedman PWD: admin</a>
      </div>
    </div>
  </div>
</body>

</html>