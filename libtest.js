console.log("libtest iniciada");
//obtener elemento relacional
var el=document.getElementsByClassName("select3")[0].id;
const output="<div class='select3-A-container'><input id='fbus' placeholder='filtro' size='10'><div id='popUpDiv'></div></div>"
var contl=document.createElement('div');
    contl.id=contl.className='select3-A-container';
var inpt= document.createElement('input');
    inpt.id=inpt.name='fbus';
    inpt.placeholder='filtro';
    inpt.type='text';
    contl.appendChild(inpt);
var dfloat=document.createElement('div');
    dfloat.id=contl.className='popUpDiv';
    contl.appendChild(dfloat);
document.getElementById(el).insertAdjacentHTML('beforeend',output);
