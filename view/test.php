<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prueba de select con search</title>
  <style>
    #selectF {
      display: inline-flex;
      flex-direction: column;
    }

    #popUpDiv {
      z-index: 100;
      position: relative;
      display: none;
      top: 0;
      left: 0;
      width: 100%;
      height: auto;
    }

    #popupSelect {
      z-index: 100;
      position: absolute;
      width: inherit;
    }
  </style>
</head>

<body>
  <div class="form-group">
    <label for="">Ejemplo label</label>
    <span></span>
    <select class="select3" id="popupSelect2" length="10">
      <option value="1">First</option>
      <option value="2">Firsts</option>
      <option value="3">Second</option>
      <option value="4">Third</option>
      <option value="5">Fourth</option>
    </select>
  </div>

  <div id="baseDiv">Click Me</div>
  <div id="selectF">
    <input id="fbus" placeholder="filtro" size="10">
    <div id="popUpDiv">
      <select id="popupSelect" length="10">
        <option value="1">First</option>
        <option value="2">Firsts</option>
        <option value="3">Second</option>
        <option value="4">Third</option>
        <option value="5">Fourth</option>
      </select>
    </div>
  </div>
  <div>Otra linea->test float</div>

  <div class="select3-A-container">
    <input id="fbus" placeholder="filtro" size="10">
    <div id="popUpDiv">

    </div>
  </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  var $origen = $('#popUpDiv option:contains("")');

  $.extend($.expr[':'], {
    'containsi': function(elem, i, match, array) {
      return (elem.textContent || elem.innerText || '').toLowerCase()
        .indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });

  $("#fbus").on('keyup', function(e) {
    var text = this.value;
    var ta;
    console.log('comprobando: ' + text);
    /* text == "" ? ta = '0' : ta = '4';
    $("#popupSelect").attr('size', ta); */
    if (text != ' ') {
      console.log('no es vacio');
      buscarenselect(text);
    } else {
      console.log('recargando...')
      $("#popUpDiv").hide();
      $("#popupSelect").empty();
      $("#popupSelect").append($origen);
    }
    if (e.which == 8) {
      console.log("se presiono tecla Borrar keyup");
      $("#popUpDiv").hide();
      $("#popupSelect").empty();
      $("#popupSelect").append($origen);
      if (text > 0) {
        buscarenselect(text);
      }

    }
  });

  function buscarenselect(texto) {
    ta = 0;
    ht = "auto"
    $("#popUpDiv").show();
    console.log('buscando..');
    var enc = $('#popUpDiv option:containsi(' + texto + ')');
    if (enc.length > 0) {
      console.log("la busqueda tiene resultados -> " + enc.length);
      if (enc.length == 1) {
        ta = 2;
        ht = "20px";
      } else {
        if (enc.length <= 4) {
          ta = enc.length;
          //ht = "auto";
        }
      }
      $("#popupSelect").attr('size', ta);
      $('#popupSelect').css('height', ht);
      //enc.trigger('change');
      $("#popupSelect").empty();
      $("#popupSelect").append(enc);
      console.log('fin busqueda');
    } else {
      console.log("no hay resultados");
      $("#popUpDiv").hide();
    }
  }


  $("#baseDiv").click(function(ev) {
    $("#popUpDiv").show();
    $("#popupSelect").attr('size', $("option").length);
    //$('#popUpDiv option:contains("Second")').prop('selected', 'selected').trigger();
    //$('#popupSelect option:contains("Fourth")');
  });
  $("#popupSelect").change(function(e) {
    $("#baseDiv").html($("#popupSelect").val() + ' clicked. Click again to change.');
    $('#fbus').val($("#popupSelect").find(":selected")[0].text);
    $("#baseDiv").html($("#popupSelect").val() + ' clicked. Click again to change.');
    $("#popUpDiv").hide();
    console.log("click en option: " + $("#popupSelect").find(":selected").text())
  });

  $('option').on('click', function(e) {
    console.log("click en option");
    //console.log("click en option: "+$("#popupSelect").find(":selected").text())
    $('#fbus').val($("#popupSelect").find(":selected")[0].text());
    $("#baseDiv").html($("#popupSelect").val() + ' clicked. Click again to change.');
    $("#popUpDiv").hide();

  });
</script>
<script src="../libtest.js"></script>

</html>