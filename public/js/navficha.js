var ss = document.getElementsByClassName('seccion');
var btnev = document.getElementById('enviarficha');

var btnat = document.getElementById('finant');
var btnsg = document.getElementById('finsig');

var pos = 0;
var ult = ss.length;

for (var i = 0; i < ss.length; i++) {
  ss[i].id = i + 'se' + i;
  if(i > 0) {
    ocultar(ss[i].id);
  }
}

function ocultar(id){
  var s = document.getElementById(id);
  if(s != null){
    s.style.display = 'none';
  }
}

function mostrar(id){
  var s = document.getElementById(id);
  if(s != null){
    s.style.display = 'block';
  }
}

function clickAt(){
  pos--;
  clickNav(pos);
  if(pos == 0){
    btnat.disabled = true;
    btnat.style.display = 'none';
  }
  ocultar('finfor');
}

function clickSg(){
  pos++;
  if(pos >= ult){
    btnsg.disabled = true;
    btnsg.style.display = 'none';
    mostrar('finfor');
  }
  clickNav(pos);

}

function clickNav(pos){
  if(pos <= ult){

    if(pos > 0){
      btnat.disabled = false;
      btnat.style.display = 'block';
    }

    if(pos < ult){
      btnsg.disabled = false;
      btnsg.style.display = 'block';
    }

    for (var i = 0; i < ss.length; i++) {
      if(i == pos) {
        mostrar(ss[i].id);
      }else{
        ocultar(ss[i].id);
      }
    }
  }
}

if(pos == 0){
  btnat.disabled = true;
  ocultar('finfor');
  btnat.style.display = 'none';
}
