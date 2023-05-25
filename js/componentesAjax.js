var valorBuscar="";
var numPagina=1;

let selecModelo = document.getElementById('selModelo');

selecModelo.addEventListener('change',() =>{
    let modeloId = selecModelo.value;
    console.log(modeloId);
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "../controller/componentesController.php", true);
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