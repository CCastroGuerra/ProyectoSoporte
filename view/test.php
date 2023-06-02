
<html>
  <head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>

  <div class="container">
    <div class="row">
      <h2>Bootstrap-select example</h2>
      <p>This uses <a href="https://silviomoreto.github.io/bootstrap-select/">https://silviomoreto.github.io/bootstrap-select/</a></p>
      <hr />
    </div>

    <div class="row-fluid">
      <select class="selectpicker" data-show-subtext="true" data-live-search="true">
        <option data-subtext="Rep California">Tom Foolery</option>
        <option data-subtext="Sen California">Bill Gordon</option>
        <option data-subtext="Sen Massacusetts">Elizabeth Warren</option>
        <option data-subtext="Rep Alabama">Mario Flores</option>
        <option data-subtext="Rep Alaska">Don Young</option>
        <option data-subtext="Rep California" disabled="disabled">Marvin Martinez</option>
      </select>
      <span class="help-inline">With <code>data-show-subtext="true" data-live-search="true"</code>. Try searching for california</span>
    </div>
  </div>


  <form action="">
    <div class="form-title">
        <span>Title</span>
    </div>
    <div class="form-body">
        <label for="in_search">Opciones</label>
        <input type="search" id="id_search">
        <div class="menu">
            <div id=divbbus>
                <input type="search">
            </div>
            <div id="opciones">
                <option value="1">opcion 1</option>
                <option value="1">opcion 2</option>
                <option value="1">opcion 3</option>
            </div>
        </div>
    </div>
  </form>
  <script>
    var bus = document.getElementById('id_search');
    bus.addEventListener("click", function(event) {
        alert("Submit button is clicked!");
       // event.preventDefault();
    });
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </html>