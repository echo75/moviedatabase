<?php
include("./includes/session-include.php"); // Session für Loginstatus
include("./includes/db-parameter.php");

$pdo = new PDO('mysql:host='.$host.';dbname='.$db.'', $user, $pwd);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
  $query = $pdo->prepare("SELECT * FROM `mymovies` ORDER BY `mymovies`.`title` ASC");
  $query->execute();
  $response = $query->fetchAll();
  $pdo = null;
} catch (PDOException $e) {
  echo "DataBase Error: The user could not be added.<br>" . $e->getMessage();
} catch (Exception $e) {
  echo "General Error: The user could not be added.<br>" . $e->getMessage();
}


//var_dump($result_stamp);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" href="./images/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Meine Filme Datenbank</title>
  <link rel="stylesheet" href="./src/style.css" media="screen">
  <link rel="stylesheet" href="./src/custom_admin.css" media="screen">
</head>
<body>
    <div class="container">
        <div class="bs-docs-section" id="examples">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1>Filme in meiner Datenbank</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                  <div class="bs-component">
                      <form class="well form-search" id="search-by-title-form" onsubmit="return false;">
                        <div>
                        <a href="logout.php" alt="" target="_self" class="admintool">Logout</a>
                        <a href="list.php" alt="" target="_self" class="admintool">Zurück zur Onlinesuche</a>
                        </div>
                      </form>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                  <div class="bs-component">
                  <table id="movie_table" class="table-striped">
                    <tbody>
                      <?php
                       $i = 0;
                       foreach ($response as $movie) {
                       $i = ++$i;
                      ?>
                      <tr>
                        <td class="td_image"><img src="<?php echo $movie["imagelink"]; ?>" width="27" height="40"></td>
                        <td><?php echo $movie["title"]; ?></td>
                        <td><?php echo $movie["year"]; ?></td>
                        <td class="td_delete"><button id="delete_button_<?php echo $i; ?>" type="button" class="btn-sm delete" data-imdbID="<?php echo $movie["id"]; ?>">Löschen</button></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="bs-component">
                    <div id="someContainer"></div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
        <div class="row">
          <div class="col-lg-12">
            <ul class="list-unstyled">
              <li class="pull-right"><a href="#" target="_self" id="ScrollToTop">Nach oben</a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
    <script type="text/javascript" src="./src/jquery.min.js"></script>
    <script type="text/javascript" src="./src/bootstrap.min.js"></script>
    <script>
    $( document ).ready(function() {
      $("body").on('click', '.delete', function() {
        var id = $(this).attr('data-imdbID');
        console.log(id);
        $.ajax({
          type: "POST",
          url: "delete.php",
          data: { id: id },
        });
      });
      // Speichern triggern:
      $(".delete").on("click",function(){
        $(this).closest('.delete').css("background-color","#ff2222");
        var tr = $(this).closest('tr');
        tr.fadeOut(400, function(){
          tr.remove();
        });
      });
      // Scroll to Top:
      $('#ScrollToTop').click(function(){
        $('html,body').animate({scrollTop:0},350);return false;
      });
    });
</script>
</body>
</html>
