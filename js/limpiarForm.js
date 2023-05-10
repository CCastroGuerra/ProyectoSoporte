function limpiarForm(valor) {
  //bt= document.getElementById('btnGuardar');
  fr = valor.parentNode.parentNode;
  console.log(valor);
  fr.reset();
};

$("form").on('click', '.btncerrar',function (event) {
    console.log("entro");    
    fr = $(this.parentNode.parentNode);
    fr[0].reset();
    console.log(fr);
  });
