<?php
session_start();
include("./includes/session-include.php"); // Session für Loginstatus
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
    <link rel="stylesheet" href="./src/custom_list.css" media="screen">
    <script type="text/javascript" src="./src/jquery.min.js"></script>
    <script type="text/javascript" src="./src/bootstrap.min.js"></script>
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
                      <form class="well form-search" id="search-by-title-form" onsubmit="return false;">
                        <div>
                        <a href="logout.php" alt="" target="_self" class="admintool">Logout</a>
                        <a href="admin.php" alt="" target="_self" class="admintool">Admin-Übersicht</a>
                        <fieldset class="fieldset">
                            <legend class="legend">Suchen nach Titel</legend>
                        </fieldset>
                        </div>
                      <div>
                          <label class="control-label" for="serach_s"></label>
                          <input type="text" id="serach_s" name="serach_s" class="input-small" value="">
                          <button id="search-by-title-button" type="button" class="btn-sm btn-primary">Suchen</button>
                          <button id="search-by-title-reset" type="reset" class="btn-sm">Zurücksetzen</button>
                      </div>
                      </form>
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
              <li class="pull-right"><a href="#top">Nach oben</a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
    <script>


   async function getMovie(movie_title) {

    var movie_title = document.getElementById("serach_s").value;
    const api_url = 'https://www.omdbapi.com/?apikey=e1112f86&s=' + movie_title + '&type=movie';
    const response = await fetch(api_url);
    var data = await response.json();
    const { Title, Year } = data;
    const array_size = data.Search.length;

    $('#someContainer').html('');
    $('#someContainer').append('<div id="movie_table"></div>');
    for (i = 0; i < data.Search.length; i++) {
      if (data.Search[i].Title.length >= 43) {
        // trim the string
        var trimmedString = data.Search[i].Title.substr(0, 43);
        //re-trim if we are in the middle of a word
        trimmedString = trimmedString.substr(0, Math.min(trimmedString.length, trimmedString.lastIndexOf(" ")));
        // add ...
        trimmedString = trimmedString + ' ...';
      } else {
        trimmedString = data.Search[i].Title;
      }

    if(data.Search[i].Poster == 'N/A') {
      // if no image exists
      data.Search[i].Poster = 'images/leer.jpg';
    }
      $('#movie_table').append( '<div class="box"><img src="' + data.Search[i].Poster + '" width="27" height="40" /></div>' +
      '<div class="box title">' + trimmedString + '</div>' +
      '<div class="box">' + data.Search[i].Year +'</div>' +
      '<div class="box"><button id="save_button_' + i + '" type="button" class="btn-sm save" data-year="' + data.Search[i].Year + '" data-title="' + data.Search[i].Title + '" data-imdbID="' + data.Search[i].imdbID + '" data-imagelink="' + data.Search[i].Poster + '" >Speichern</button></div>');
      }
}
  $( "#search-by-title-button" ).click(function() {
    getMovie();
  });

  $( "#search-by-title-reset" ).click(function() {
    location.reload();
  });

  $("body").on('click', '.save', function() {
    var title = $(this).attr('data-title');
    var year = $(this).attr('data-year');
    var id = $(this).attr('data-imdbID');
    var imagelink = $(this).attr('data-imagelink');

    $.ajax({
      type: "POST",
      url: "save.php",
      data: { id: id, title: title, year: year, imagelink: imagelink },
      //success: success,
      //dataType: dataType
    });
});
$("body").on('click', '#save_button_0', function() {
  $("#save_button_0").html('Gespeichert');
  $("#save_button_0").css("background-color","#129b29");
});
$("body").on('click', '#save_button_1', function() {
  $("#save_button_1").html('Gespeichert');
  $("#save_button_1").css("background-color","#129b29");
});
$("body").on('click', '#save_button_2', function() {
  $("#save_button_2").html('Gespeichert');
  $("#save_button_2").css("background-color","#129b29");
});
$("body").on('click', '#save_button_3', function() {
  $("#save_button_3").html('Gespeichert');
  $("#save_button_3").css("background-color","#129b29");
});
$("body").on('click', '#save_button_4', function() {
  $("#save_button_4").html('Gespeichert');
  $("#save_button_4").css("background-color","#129b29");
});
$("body").on('click', '#save_button_5', function() {
  $("#save_button_5").html('Gespeichert');
  $("#save_button_5").css("background-color","#129b29");
});
$("body").on('click', '#save_button_6', function() {
  $("#save_button_6").html('Gespeichert');
  $("#save_button_6").css("background-color","#129b29");
});
$("body").on('click', '#save_button_7', function() {
  $("#save_button_7").html('Gespeichert');
  $("#save_button_7").css("background-color","#129b29");
});
$("body").on('click', '#save_button_8', function() {
  $("#save_button_8").html('Gespeichert');
  $("#save_button_8").css("background-color","#129b29");
});
$("body").on('click', '#save_button_9', function() {
  $("#save_button_9").html('Gespeichert');
  $("#save_button_9").css("background-color","#129b29");
});

</script>
</body>
</html>
