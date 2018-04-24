function dashboardGuru() {
    var ajaxRequest = ajax(ajaxRequest);
    ajaxRequest.onreadystatechange = function(){
      if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
        var respon = ajaxRequest.responseText;
        var display = document.getElementById('respon');
        display.innerHTML = respon;
      }
    }
  
    ajaxRequest.open("GET", "control/dashboardGuru.php", true);
    ajaxRequest.send();
  }
  
  function tambahGuruDashboard() {
    var ajaxRequest = ajax(ajaxRequest);
    ajaxRequest.onreadystatechange = function(){
      if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
        var respon = ajaxRequest.responseText;
        var display = document.getElementById('respon');
        display.innerHTML = respon;
      }
    }
  
    ajaxRequest.open("GET", "control/tambahGuruDashboard.php", true);
    ajaxRequest.send();
  }
  
  function tambahGuru() {
    var email = document.getElementById('email').value;
    var nama = document.getElementById('nama').value;
    var kelas = document.getElementById('kelas').value;
    var input = "nama=" + nama + "&kelas=" + kelas + "&email=" + email;
  
    var ajaxRequest = ajax(ajaxRequest);
    ajaxRequest.onreadystatechange = function(){
      if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
        var respon = ajaxRequest.responseText;
        if (respon == 1) {
          dashboardGuru();
        }
        else {
          alert(respon);
        }
      }
    }
  
    ajaxRequest.open("POST", "control/tambahGuru.php", true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajaxRequest.send(input);
  }
  
  function ubahGuruDashboard(email, nama, kelas) {
    var input = "email=" + email + "&nama=" + nama + "&kelas=" + kelas;
    var ajaxRequest = ajax(ajaxRequest);
    ajaxRequest.onreadystatechange = function(){
      if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
        var respon = ajaxRequest.responseText;
        var display = document.getElementById('respon');
        display.innerHTML = respon;
      }
    }
  
    ajaxRequest.open("POST", "control/ubahGuruDashboard.php", true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajaxRequest.send(input);
  }
  
  function ubahGuru() {
    var email = document.getElementById('email').value;
    var nama = document.getElementById('nama').value;
    var kelas = document.getElementById('kelas').value;
    var input = "email=" + email + "&nama=" + nama + "&kelas=" + kelas;
  
    var ajaxRequest = ajax(ajaxRequest);
    ajaxRequest.onreadystatechange = function(){
      if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
        var respon = ajaxRequest.responseText;
        if (respon == 1) {
          dashboardGuru();
        }
        else {
          alert(respon);
        }
      }
    }
  
    ajaxRequest.open("POST", "control/ubahGuru.php", true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajaxRequest.send(input);
  }
  
  function hapusGuru(email) {
    var hapus = confirm("Are you sure?");
    if (hapus) {
      var input = "email=" + email;
  
      var ajaxRequest = ajax(ajaxRequest);
      ajaxRequest.onreadystatechange = function(){
        if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
          var respon = ajaxRequest.responseText;
          if (respon == 1) {
            dashboardGuru();
          }
          else {
            alert(respon);
          }
        }
      }
  
      ajaxRequest.open("POST", "control/hapusGuru.php", true);
      ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      ajaxRequest.send(input);
    }
  
  }