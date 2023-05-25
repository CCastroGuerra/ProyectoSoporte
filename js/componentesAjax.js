var valorBuscar="";
var numPagina=1;
listarSelectMarca();
let selecModelo = document.getElementById('selModelo');
let selecMarca = document.getElementById('selMarca');

selecModelo.disabled = true;
selecMarca.addEventListener('change',() =>{
    let marcaId = selecMarca.value;
    console.log(marcaId);
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open('POST', '../model/componentesModel.php', true); 
    var data = new FormData();
    data.append('accion','listarModel');
    data.append('id',marcaId);
    selecModelo.disabled = false;
    ajax.onload = () =>{
        let respuesta = ajax.responseText;
        console.log(respuesta);
        let marcas = JSON.parse(respuesta);
        console.log(marcas);
        let options = "<option value=''>Seleccione una Modelo</option>";
       if(marcas.length > 0){
        marcas.forEach(function (marcas) {
            options += `
            <option value='${marcas.id}'>${marcas.nombre}</option>
                      `;
          });
        }else{
            selecModelo.disabled = true;

        }
        //Actualizar combo
        document.getElementById('selModelo').innerHTML=options;

    }
    ajax.send(data);
});

function listarSelectMarca() {
    //let num_registros = document.getElementById('numeroRegistros').value;
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "../controller/componentesController.php", true);
    var data = new FormData();
    data.append("accion", "listarMarca");
    // data.append("valor", "");
    // data.append("cantidad", "4");
    // data.append('registros',num_registros);
    ajax.onload = function () {
      let respuesta = ajax.responseText;
      console.log(respuesta);
      const marca = JSON.parse(respuesta);
      let template = ""; // Estructura de la tabla html
      if (marca.length > 0) {
        template = `<option value="0">Seleccione Marca</option>
          `;
        marca.forEach(function (marca) {
          template += `
                     
                      <option value="${marca.id}">${marca.nombre}</option>
                  
                      `;
        });
        var elemento = document.getElementById("selMarca");
        elemento.innerHTML = template;
      }
    };
    ajax.send(data);
}