window.onload = function () {
    dashboard();
}

function dashboard() {
    var ajaxRequest = ajax(ajaxRequest);
    ajaxRequest.onreadystatechange = function () {
        if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
            var respon = ajaxRequest.responseText;
            var display = document.getElementById('respon');
            display.innerHTML = respon;
        }
    }

    ajaxRequest.open("GET", "control/dashboard.php", true);
    ajaxRequest.send();
}

function dashboardReport(nik) {
    var input = "nik=" + nik;
  
    var ajaxRequest = ajax(ajaxRequest);
    ajaxRequest.onreadystatechange = function(){
      if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
        var respon = ajaxRequest.responseText;
        var display = document.getElementById('respon')
        display.innerHTML = respon;
      }
    }
  
    ajaxRequest.open("POST", "control/dashboardReport.php", true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajaxRequest.send(input);
}