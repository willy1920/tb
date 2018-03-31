function dashSiswa(id) {
  var ajaxRequest = ajax(ajaxRequest);

  var input = "id=" + id;

  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function(){
    if (ajaxRequest.status == 200 && ajaxRequest.readyState == 4) {
      var response = ajaxRequest.responseText;
      var display = document.getElementById('respon');
      display.innerHTML = response;
    }
  }

  ajaxRequest.open("POST", "control/getSiswaReportData.php", true);
  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxRequest.send(input);
}
