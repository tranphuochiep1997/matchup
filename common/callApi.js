function callApi(url, onSuccess, method = 'GET') {
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      onSuccess(this);
    }
  };
  xhttp.open(method, url, true);
  xhttp.send();
}