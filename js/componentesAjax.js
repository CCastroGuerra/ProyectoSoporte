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
    data.append('accion','listarMarca');
    data.append('id',modeloId);
    ajax.onload = () =>{
        let respuesta = ajax.responseText;
        console.log(respuesta);
        let marcas = JSON.parse(respuesta);
        console.log(marcas);
        let options = "<option value=''>Seleccione una Marca</option>";
       if(marcas.length > 0){
        marcas.forEach(){

        
       }
        //Actualizar combo
        document.getElementById('selMarca').innerHTML=options;

    }
    ajax.send(data);
});