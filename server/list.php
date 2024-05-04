<?php
session_start();
include("./includes/session-include.php"); // Session für Loginstatus

if (!empty($_POST['search_s'])) {

  $search_words = $_POST['search_s'] = trim($_POST['search_s']);
  $_POST['search_s'] = urlencode($_POST['search_s']);
  //var_dump($_POST['search_s']);

  // Verbindung zur API von Open Movie Database:
  $api_url = 'https://www.omdbapi.com/?apikey=e1112f86&s=' . $_POST['search_s'] . '&type=movie';
  $jsondata = file_get_contents($api_url);
  $result = json_decode($jsondata, true);

  //var_dump($result);

} else {
  $search_words = '';
  $result = '';
}
?>
<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" href="./images/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Meine Filme Datenbank</title>
  <link rel="stylesheet" href="./src/style.css" media="screen">
  <link rel="stylesheet" href="./src/custom_list.css" media="screen">
</head>

<body>
  <div class="container">
    <div class="bs-docs-section" id="examples">
      <div class="row">
        <div class="col-lg-12">
          <div class="page-header">
            <h1>Filmsuche in der Open Movie Database</h1>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="bs-component">
            <form class="well form-search" id="search-by-title-form" action="./list.php" method="post">
              <div>
                <a href="logout.php" alt="" target="_self" class="admintool">Logout</a>
                <a href="admin.php" alt="" target="_self" class="admintool">Admin-Übersicht</a>
                <fieldset class="fieldset">
                  <legend class="legend">Suchen nach Titel (zum Beispiel: "beach" oder "golden")</legend>
                </fieldset>
              </div>
              <div>
                <label class="control-label" for="search_s"></label>
                <input type="text" id="search_s" name="search_s" class="input-small">
                <button id="search-by-title-button" type="button" class="btn-sm btn-primary">Suchen</button>
                <input type="hidden" name="resetview" id="resetview" value="resetview" class="versteckt">
                <button id="search-by-title-reset" type="reset" class="btn-sm">Zurücksetzen</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="bs-component">
            <form class="form-movie" id="form-movie" action="./list.php" method="post">
              <table id="movie_table" class="table-striped">
                <tbody>
                  <?php if (!empty($result['Search'])) {
                    foreach ($result['Search'] as $movie) { ?>
                      <tr>
                        <td class="td_image"><img src="<?php echo $movie['Poster']; ?>" width="27" height="40"></td>
                        <td class="cell"><?php echo $movie['Title']; ?></td>
                        <td class="cell"><?php echo $movie['Year']; ?></td>
                        <td class="td_delete"><button id="save_button" type="button" class="btn-sm save" data-imdbid="<?php echo $movie['imdbID']; ?>" data-title="<?php echo $movie['Title']; ?>" data-year="<?php echo $movie['Year']; ?>" data-poster="<?php echo $movie['Poster']; ?>">Speichern</button></td>
                      </tr>
                  <?php }
                  } ?>
                </tbody>
              </table>
            </form>
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
    $(document).ready(function() {
      // Suchbegriff nach Reload anzeigen
      $('#search_s').val('<?php if ($search_words != '') echo $search_words; ?>');
      // Suche Starten:
      $("#search-by-title-button").click(function() {
        $('#search-by-title-form').submit();
      });
      // Suche zurücksetzen:
      $("#search-by-title-reset").click(function() {
        $('#search_s').val('');
        $('#search-by-title-form').submit();
      });
      // Speichern triggern:
      $(".save").on("click", function() {
        $(this).closest('.save').css("background-color", "#008000");
        var tr = $(this).closest('tr');
        tr.fadeOut(400, function() {
          tr.remove();
        });
        var imdbid = $(this).attr("data-imdbid");
        var title = $(this).attr("data-title");
        var year = $(this).attr("data-year");
        var poster = $(this).attr("data-poster");
        $.post("save.php", {
          imdbid: imdbid,
          title: title,
          year: year,
          poster: poster
        });
      });
      // Scroll to Top:
      $('#ScrollToTop').click(function() {
        $('html,body').animate({
          scrollTop: 0
        }, 350);
        return false;
      });
    });
  </script>
</body>

</html>