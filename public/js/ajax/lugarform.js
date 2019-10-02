
  const URLLUGAR = BURL + 'api/v1/lugar/';
  // Todos los combos de nacimiento
  const CMBPAISN = document.querySelector('#pais-nacimiento');
  const CMBPROVINCIAN = document.querySelector('#provincia-nacimiento');
  const CMBCIUDADN = document.querySelector('#ciudad-nacimiento');
  const CMBPARROQUIASN = document.querySelector('#parroquia-nacimiento');

  // Agregamos los eventos para los combos de nacimiento
  agregarEventoLugar(CMBPAISN, CMBPROVINCIAN);
  agregarEventoLugar(CMBPROVINCIAN, CMBCIUDADN);
  agregarEventoLugar(CMBCIUDADN, CMBPARROQUIASN);

  // Todos los combos de residencia
  const CMBPAISR = document.querySelector('#pais-residencia');
  const CMBPROVINCIAR = document.querySelector('#provincia-residencia');
  const CMBCIUDADR = document.querySelector('#ciudad-residencia');
  const CMBPARROQUIASR = document.querySelector('#parroquia-residencia');

  // Agregamos los enventos para los combos de residencia
  agregarEventoLugar(CMBPAISR, CMBPROVINCIAR);
  agregarEventoLugar(CMBPROVINCIAR, CMBCIUDADR);
  agregarEventoLugar(CMBCIUDADR, CMBPARROQUIASR);

  // Llenamos los paises
  consultarPaises(URLLUGAR + 'paises', CMBPAISN, CMBPAISR);

  function agregarEventoLugar(cmb, cmbTarget) {
    cmb.addEventListener('change', function() {
      if(cmb.value != 'Seleccione' && cmb.value != ''){
        consultarLugar(URLLUGAR + 'referencia/' + cmb.value , cmbTarget);
      }
    });
  }

  function consultarLugar(url, cmb){
    fetch(url)
    .then(res => res.json())
    .then(data => {
      if(data.statuscode  == 200){
        llenarCmbLugar(cmb, data.items);
      } else {
        console.log('Error: ' + data.mensaje);
      }
    }).catch(e => {
      console.log('Error al cargar los paises ' + error);
    });
  }

  function llenarCmbLugar(cmb, items){
    items.forEach(p => {
      let OPT = document.createElement('option');
      let V = document.createTextNode(p.lugar_nombre)
      OPT.value = p.id_lugar;
      OPT.appendChild(V);
      cmb.appendChild(OPT);
    });
  }


  function consultarPaises(url, cmbn, cmbr){
    fetch(url)
    .then(res => res.json())
    .then(data => {
      if(data.statuscode  == 200){
        llenarCmbLugar(cmbn, data.items);
        llenarCmbLugar(cmbr, data.items);
      } else {
        console.log('Error: ' + data.mensaje);
      }
    }).catch(e => {
      console.log('Error al cargar los paises ' + error);
    });
  }
