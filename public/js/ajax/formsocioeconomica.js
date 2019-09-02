//Es necesario tener las URL que se usan declaradas antes
const BTNSMASTXT = document.querySelectorAll('.btn-mas-txt');
var vclick = 0;
BTNSMASTXT.forEach(b => {
  b.onclick = agregarOtroTxtResMul;
});

function agregarOtroTxtResMul(){
  vclick++;
  let FROMRESMUL = document.querySelectorAll('.form-res-mul');

  FROMRESMUL.forEach(f => {
    let D1 = document.createElement('div');
    let D2 = document.createElement('div');
    let D3 = document.createElement('div');
    let I = document.createElement('input');

    D1.classList.add('form-row', 'c'+vclick);
    D2.classList.add('col-12');
    D3.classList.add('form-group');
    I.classList.add('form-control', 'res-mul'+vclick);

    I.id = f.id;

    D3.appendChild(I);
    D2.appendChild(D3);
    D1.appendChild(D2);

    f.appendChild(D1);

  });
  agregarVal('res-mul'+vclick)
}

function agregarVal(clase){
  let I = document.querySelectorAll('.'+clase);
  I.forEach(i =>{
    i.onblur = function(){
      valirdarTodosLlenos(clase);
    }
  });
}

function valirdarTodosLlenos(clase){
  let I = document.querySelectorAll('.'+clase);
  let llenos = true;
  I.forEach(i => {
    if(i.value == ''){
      llenos = false;
    }
  });

  if(llenos){
    let URL = URLGURDAR + '?guardarlibre=true';
    I.forEach(i => {

      let data = new FormData();
      data.append('id_pregunta_ficha', i.id);
      data.append('respuesta', i.value);

      fetch(URL, {
        method: 'POST',
        body: data
      })
      .then(res => res.json())
      .then(data => {
        if(data.statuscode == 200){
          i.onblur = '';
          i.disabled = true;
          console.log(data);
        }
      })
      .catch(e => {
        console.log('Error: ' + e);
      });

    });
  }
}


function actualizarRespuestaLibre(id){
  let i = document.querySelector('#'+id);
  if(i != null){

    if(i.value != ''){
      let URL = URLGURDAR + '?actualizarlibre=true';

      let data = new FormData();
      data.append('id_almn_respuesta_fs', i.id);
      data.append('respuesta', i.value);

      fetch(URL, {
        method: 'POST',
        body: data
      })
      .then(res => res.json())
      .then(data => {
        console.log(data);
      })
      .catch(e => {
        console.log('Error: ' + e);
      });
    }

  }

}

/**
* Con esta funcion actualizamos las resultas simples
*/
function actualizar(idActualizar, idRespuesta){
  let data = new FormData();
  data.append('id_respuesta', idRespuesta);
  data.append('id_actualizar', idActualizar);
  fetch(URLACT, {
    method: 'POST',
    body: data
  })
  .then(res => res.json())
  .then(data => {
    console.log(data);
  })
  .catch(e => {
    console.log('Error: ' + e);
  })
}
