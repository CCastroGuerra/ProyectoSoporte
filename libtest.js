console.log("libtest iniciada");
$.extend($.expr[":"], {
  containsi: function (elem, i, match, array) {
    return (
      (elem.textContent || elem.innerText || "")
        .toLowerCase()
        .indexOf((match[3] || "").toLowerCase()) >= 0
    );
  },
});
const output =
  "<div class='select3-A-container'><input class='select3-input' id='fbus' placeholder='filtro' size='10'><div class='popUpDiv' id='popUpDiv'></div></div>";
const ctdsel3s = document.getElementsByClassName("select3");
for (let i = 0; i < ctdsel3s.length; i++) {
  console.log(ctdsel3s[i]);
  let el = document.getElementsByClassName("select3")[i].id;
  let sec =
    document.getElementsByClassName("select3")[i].previousElementSibling;
  console.log(sec);

  var contl = document.createElement("div");
  contl.className = "select3-A-container";
  contl.id = "select3-A-container-" + i;
  contl.tabIndex = -1;

  var inpt = document.createElement("input");
  inpt.type = "search";
  inpt.id = "fbus-" + i;
  inpt.name = "fbus-" + i;
  inpt.tabIndex = -1;
  inpt.className = "select3-input form-control  form-control-sm mb-2";
  inpt.type = "search"; //fbus
  inpt.placeholder = "filtro";
  contl.appendChild(sec);
  contl.appendChild(inpt);

  var dfloat = document.createElement("div");
  dfloat.className = "popUpDiv";
  dfloat.tabIndex = 1;
  dfloat.id = "popUpDiv-" + i;
  let divsel = dfloat.id;

  console.log("divdelselect: " + divsel);
  dfloat.name = "popUpDiv-" + i;
  contl.appendChild(dfloat);
  document.getElementById(el).insertAdjacentElement("beforebegin", contl);
  document.getElementById(dfloat.id).appendChild(document.getElementById(el));

  let $base = $("#" + el + " option");
  let $inp = inpt.id;
  let conta = contl.id;
  console.log($base);

  $("#" + $inp).on("search", function () {
    // esto se ejecuta cuando clickea la x en el input[type='search']
    console.log("x button was clicked");
    $("#" + divsel).hide();
    $("#" + el).empty();
    $("#" + el).append($base);
    $("#" + el).attr("size", 4);
    $("#" + divsel).show();
  });

  $("#" + inpt.id).on("click", function () {
    // esto se ejecuta cuando clickea la x en el input[type='search']
    console.log("input was focus");
    var text = this.value;
    if (!text) {
      console.log("el input se encuentra vacío");
      $("#" + el).empty();
      $("#" + el).append($base);
      $("#" + el).attr("size", 4);
      $("#" + divsel).show();
    }

    // $("#" + el).trigger('focus');
  });

  /* $("#" + inpt.id).on("mouseout", function (e) {
    // esto se ejecuta cuando clickea la x en el input[type='search']
    console.log(this.id + " focus out");
    console.log(e.target.id)
    $("#" + el).trigger("focus");
    /* setTimeout(() => {
      $("#" + el).empty();
      $("#" + el).append($base);
      $("#" + el).attr("size", 4);
      $("#" + divsel).hide();
    }, 600); */
  /*}); */

  $("#" + divsel).on("mouseleave", function (eve) {
    // esto se ejecuta cuando clickea o coloca el mouse fuera del select
    console.log("el select en "+divsel+ "es visible :" + $("#" + divsel).is(":visible"));
    console.log(eve.relatedTarget);
    if ($("#" + divsel).is(":visible")) {
      console.log("dejo de ver el select, se ocultara");
      $("#" + el).empty();
      $("#" + el).append($base);
      $("#" + el).attr("size", 4);
      $("#" + divsel).hide();
    }
  });

  $("#" + inpt.id).on("keyup", function (e) {
    var text = this.value;
    var ta;
    console.log("comprobando: " + text + " en: " + this.id);
    /* text == "" ? ta = '0' : ta = '4';
      $("#" + el).attr('size', ta); */
    if (text != " ") {
      console.log("no es vacio, activando: " + divsel);
      console.log("buscar en el selec: " + el);
      buscarenselect(text, divsel, el);
    } else {
      console.log("recargando...");
      $("#" + divsel).hide();
      $("#" + el).empty();
      $("#" + el).append($base);
      $("#" + divsel).show();
    }
    if (e.which == 8) {
      console.log("se presiono tecla Borrar keyup");
      $("#" + divsel).hide();
      $("#" + el).empty();
      console.log($base);
      $("#" + el).append($base);
      if (text.length > 0) {
        buscarenselect(text, divsel, el);
      }
    }
  });

  $("#" + el).change(function () {
    console.log("elemento seleccionado");
    $("#" + $inp).val($("#" + el).find(":selected")[0].text);
    $("#" + divsel).hide();
  });
}

function handler(event) {
  var target = $(event.target);
}
//obtener elemento relacional
/*
var el = document.getElementsByClassName("select3")[0].id;

var contl = document.createElement("div");
contl.id = contl.className = "select3-A-container";
var inpt = document.createElement("input");
inpt.id = inpt.name = "fbus";
inpt.className = "select3-input"; //fbus
inpt.placeholder = "filtro";
inpt.type = "text";
contl.appendChild(inpt);
var dfloat = document.createElement("div");
dfloat.id = dfloat.className = dfloat.name = "popUpDiv";
contl.appendChild(dfloat);
document.getElementById(el).insertAdjacentElement("beforebegin", contl);
document.getElementById("popUpDiv").appendChild(document.getElementById(el));
*/
/* ---- */

//var $base = $("#" + "popUpDiv" + ' option:contains("")');



function buscarenselect(texto, popupdiv, selectid) {
  ta = 0;
  ht = "auto";
  console.log("select: " + selectid);
  console.log("div id=" + popupdiv);
  $("#" + popupdiv).show();
  console.log("buscando..");
  var str = "#" + selectid + " option:containsi('" + texto + "')";
  console.log(str);
  var enc = $("#" + selectid + " option:containsi('" + texto + "')");
  console.log(enc);
  if (enc.length > 0) {
    console.log("la busqueda tiene resultados -> " + enc.length);
    if (enc.length == 1) {
      ta = 2;
      ht = "31px";
    } else {
      if (enc.length <= 4) {
        ta = enc.length;
        //ht = "auto";
      } else {
        ta = 4;
      }
    }
    $("#" + selectid).attr("size", ta);
    $("#" + selectid).css("height", ht);
    //enc.trigger('change');
    $("#" + selectid).empty();
    $("#" + selectid).append(enc);

    console.log("fin busqueda");
  } else {
    console.log("no hay resultados");
    $("#" + popupdiv).hide();
  }
}
