// Es necesario tener las URL que se usan declaradas antes

function agregarOtroTxtResMul(clase){
  vclick++;
  let FROMRESMUL = document.querySelectorAll('.' + clase);
  console.log('Click: ' + vclick);
  console.log('Numero de preguntas: ' + FROMRESMUL.length);
  FROMRESMUL.forEach(f => {
    let tipo = f.dataset.tipo;
    console.log('Tipo: '+tipo);
    if(tipo == 'select'){
      let opts = document.querySelectorAll('.select-'+f.id);
      let D1 = document.createElement('div');
      let D2 = document.createElement('div');
      let D3 = document.createElement('div');
      let S = document.createElement('select');
      let OUNO = document.createElement('option');
      OUNO.value = "";
      OUNO.appendChild(
        document.createTextNode('Seleccione')
      );

      D1.classList.add('form-row', 'c'+vclick);
      D2.classList.add('col-12');
      D3.classList.add('form-group');
      S.classList.add('form-control', 'res-mul'+vclick);
      S.id = f.id;
      S.appendChild(OUNO);
      let opciones = '';
      opts.forEach(o => {
        if(!opciones.includes(o.value)){
          console.log('Opt: '+o.value);
          opciones += o.value;
          let O = document.createElement('option');
          O.value = o.value;
          O.appendChild(
            document.createTextNode(o.value)
          );
          S.appendChild(O);
        }
      });

      D3.appendChild(S);
      D2.appendChild(D3);
      D1.appendChild(D2);

      f.appendChild(D1);
      console.log('Todo bien todo correcto');
    } else {
      agregarTxt(f, vclick);
    }
  });
  agregarVal('res-mul'+vclick)
}

function agregarTxt(f, vclick){
  let D1 = document.createElement('div');
  let D2 = document.createElement('div');
  let D3 = document.createElement('div');
  let I = document.createElement('input');

  D1.classList.add('form-row', 'c'+vclick);
  D2.classList.add('col-12');
  D3.classList.add('form-group');
  I.classList.add('form-control', 'res-mul'+vclick);

  I.id = f.id;
  I.type = f.dataset.tipo;

  D3.appendChild(I);
  D2.appendChild(D3);
  D1.appendChild(D2);

  f.appendChild(D1);
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
  } else {
    console.log('No tenemos todos llenos, ' + I.length);
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
    } else {
      console.log('No tenemos valor');
    }

  } else {
    console.log('No tenemos el valor');
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
