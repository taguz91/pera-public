function eliminar(url, id) {
  fetch(url + id, {
    method: 'GET'
  })
  .then(res => res.json())
  .then(data => {
    if (data.statuscode == '200') {
      msgSuccess(data.mensaje);
      let row = document.querySelector('#fila'+id);
      if (row != null) {
        row.parentNode.removeChild(row);
      }
    } else {
      msgError(data.mensaje);
    }
  })
  .catch(e => {
    msgError('Error: ' + e);
  });
}
