function dashboardKelas() {
  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function(){
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      var display = document.getElementById('respon');
      display.innerHTML = respon;
    }
  }

  ajaxRequest.open("GET", "control/dashboardKelas.php", true);
  ajaxRequest.send();
}

function tambahKelasDashboard() {
  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function(){
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      var display = document.getElementById('respon');
      display.innerHTML = respon;
    }
  }

  ajaxRequest.open("GET", "control/tambahKelasDashboard.php", true);
  ajaxRequest.send();
}

function tambahKelas() {
  var nama = document.getElementById('nama').value;
  var input = "nama=" + nama;

  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function(){
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      if (respon == 1) {
        dashboardKelas();
      }
      else {
        alert(respon);
      }
    }
  }

  ajaxRequest.open("POST", "control/tambahKelas.php", true);
  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxRequest.send(input);
}

function ubahKelasDashboard(id, nama) {
  var input = "id=" + id + "&nama=" + nama;
  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function(){
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      var display = document.getElementById('respon');
      display.innerHTML = respon;
    }
  }

  ajaxRequest.open("POST", "control/ubahKelasDashboard.php", true);
  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxRequest.send(input);
}

function ubahKelas() {
  var id = document.getElementById('id').value;
  var nama = document.getElementById('nama').value;
  var input = "id=" + id + "&nama=" + nama;

  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function(){
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      if (respon == 1) {
        dashboardKelas();
      }
      else {
        alert(respon);
      }
    }
  }

  ajaxRequest.open("POST", "control/ubahKelas.php", true);
  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxRequest.send(input);
}

function hapusKelas(id) {
  var hapus = confirm("Are you sure?");
  if (hapus) {
    var input = "id=" + id;

    var ajaxRequest = ajax(ajaxRequest);
    ajaxRequest.onreadystatechange = function(){
      if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
        var respon = ajaxRequest.responseText;
        if (respon == 1) {
          dashboardKelas();
        }
        else {
          alert(respon);
        }
      }
    }

    ajaxRequest.open("POST", "control/hapusKelas.php", true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajaxRequest.send(input);
  }

}
