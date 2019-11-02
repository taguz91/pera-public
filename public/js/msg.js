
function msgError(msg) {
  const CTN_MSG = document.querySelector('#ctn-msg');
  if (CTN_MSG != null) {
    CTN_MSG.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <span>` + msg + `</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button> </div>`;
  }
}

function msgSuccess(msg) {
  const CTN_MSG = document.querySelector('#ctn-msg');
  if (CTN_MSG != null) {
    CTN_MSG.innerHTML = `<div class="alert alert-success alert-dismissible fade show" role="alert">
    <span>` + msg + `</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button> </div>`;
  }
}
