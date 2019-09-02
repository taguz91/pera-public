
function ingresarPF(idForm){
  let frm = document.querySelector('#'+idForm);
  if(frm != null){
    frm.addEventListener('submit', e => {
      e.preventDefault();
    })

    let data = new FormData(frm);
    if(
      data.get('pass') != '' &&
      data.get('idper') != ''
    ){
      loginPF(frm, URLLOGINPF, data);
    }
  }
}

function loginPF(frm, url, data){
  fetch(url, {
    method: 'POST',
    body: data
  })
  .then(res => res.json())
  .then(data => {
    if(data.statuscode == 200){
      frm.submit();
    } else {
      console.log(data.mensaje);
    }
  })
  .catch(e =>{
    console.log('Error: ' + e);
  });
}
