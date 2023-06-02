<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    #popUpDiv {
      z-index: 100;
      position: relative;
      display: none;
      top: 0;
      left: 0;
      width: auto;
      height: auto;
    }

    #popupSelect {
      z-index: 1;
      position: relative;
    }
  </style>
</head>

<body>
  <div id="baseDiv">Click Me</div>
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

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  
var $origen = $('#popUpDiv option:contains("")');

$("#fbus").on('keyup',function(e){	
  $("#popUpDiv").show();
  var text=this.value;
  var ta;
  console.log('comprobando: '+text);
  text=="" ? ta='0' : ta='4';  
    $("#popupSelect").attr('size', ta);
      console.log('no es vacio');
  if (ta > 0){
  	console.log('buscando..')
    var enc=$('#popUpDiv option:contains('+text+')')
    //enc.trigger('change');
    $("#popupSelect").empty();
    $("#popupSelect").append(enc);
    console.log('fin busqueda')
  }else{
  	console.log('recargando...')
  	 $("#popUpDiv").hide();
     $("#popupSelect").empty();
    $("#popupSelect").append($origen);
     
  }
});
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
  console.log("click en option: "+$("#popupSelect").find(":selected").text())
});

$('option').on('click', function(e){
	console.log("click en option");
	//console.log("click en option: "+$("#popupSelect").find(":selected").text())
  $('#fbus').val($("#popupSelect").find(":selected")[0].text());
  $("#baseDiv").html($("#popupSelect").val() + ' clicked. Click again to change.');
    $("#popUpDiv").hide();

});

</script>

</html>