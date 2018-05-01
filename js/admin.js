var iTB = 0;
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

function dashboardMurid(){
  
  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function(){
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      var display = document.getElementById('respon');
      display.innerHTML = respon;
    }
  }

  ajaxRequest.open("GET", "control/dashboardMurid.php", true);
  ajaxRequest.send();
}

function tambahMuridDashboard() {
  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function(){
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      var display = document.getElementById('respon');
      display.innerHTML = respon;
    }
  }

  ajaxRequest.open("GET", "control/tambahMuridDashboard.php", true);
  ajaxRequest.send();
}

function tambahMurid() {
  var nik = document.getElementById('nik').value;
  var nama = document.getElementById('nama').value;
  var email = document.getElementById('email').value;
  var kelas = document.getElementById('kelas').value;

  var input = "nik=" + nik + "&nama=" + nama + "&email=" + email + "&kelas=" + kelas;

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

  ajaxRequest.open("POST", "control/tambahMurid.php", true);
  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxRequest.send(input);
}

function ubahMuridDashboard(id, nama, user, kelas) {
  var input = "id=" + id + "&nama=" + nama + "&user=" + user + "&kelas=" + kelas;
  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function(){
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      var display = document.getElementById('respon');
      display.innerHTML = respon;
    }
  }

  ajaxRequest.open("POST", "control/ubahMuridDashboard.php", true);
  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxRequest.send(input);
}

function ubahMurid() {
  var id = document.getElementById('nik').textContent;
  var nama = document.getElementById('nama').value;
  var user = document.getElementById('email').value;
  var kelas = document.getElementById('kelas').value;
  var input = "id=" + id + "&nama=" + nama + "&user=" + user + "&kelas=" + kelas;

  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function(){
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      if (respon == 1) {
        dashboardMurid();
      }
      else {
        alert(respon);
      }
    }
  }

  ajaxRequest.open("POST", "control/ubahMurid.php", true);
  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxRequest.send(input);
}

function hapusMurid(id) {
  var hapus = confirm("Are you sure?");
  if (hapus) {
    var input = "id=" + id;

    var ajaxRequest = ajax(ajaxRequest);
    ajaxRequest.onreadystatechange = function(){
      if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
        var respon = ajaxRequest.responseText;
        if (respon == 1) {
          dashboardMurid();
        }
        else {
          alert(respon);
        }
      }
    }

    ajaxRequest.open("POST", "control/hapusMurid.php", true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajaxRequest.send(input);
  }

}

function dashboardOrtu() {
  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function(){
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      var display = document.getElementById('respon');
      display.innerHTML = respon;
    }
  }

  ajaxRequest.open("GET", "control/dashboardOrtu.php", true);
  ajaxRequest.send();
}

function tambahOrtuDashboard() {
  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function(){
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      var display = document.getElementById('respon');
      display.innerHTML = respon;
    }
  }

  ajaxRequest.open("GET", "control/tambahOrtuDashboard.php", true);
  ajaxRequest.send();
}

function tambahOrtu() {
  var email = document.getElementById('email').value;
  var input = "email=" + email;

  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function(){
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      if (respon == 1) {
        dashboardOrtu();
      }
      else {
        alert(respon);
      }
    }
  }

  ajaxRequest.open("POST", "control/tambahOrtu.php", true);
  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxRequest.send(input);
}

function hapusOrtu(email) {
  var hapus = confirm("Are you sure?");
  if (hapus) {
    var input = "email=" + email;

    var ajaxRequest = ajax(ajaxRequest);
    ajaxRequest.onreadystatechange = function(){
      if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
        var respon = ajaxRequest.responseText;
        if (respon == 1) {
          dashboardOrtu();
        }
        else {
          alert(respon);
        }
      }
    }

    ajaxRequest.open("POST", "control/hapusOrtu.php", true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajaxRequest.send(input);
  }
}

function dashboardGuru() {
  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function () {
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
  ajaxRequest.onreadystatechange = function () {
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
  ajaxRequest.onreadystatechange = function () {
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      if (respon == 1) {
        dashboardGuru();
      }
      else {

        document.getElementById('respon').innerHTML = respon;
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
  ajaxRequest.onreadystatechange = function () {
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
  ajaxRequest.onreadystatechange = function () {
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
    ajaxRequest.onreadystatechange = function () {
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

function showDashboardUploadExcelClass(){
  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function () {
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      var display = document.getElementById('respon');
      display.innerHTML = respon;

      document.getElementById('excel').addEventListener('change', readExcelFileForClass, false);
    }
  }

  ajaxRequest.open("GET", "control/showDashboardUploadExcel.php", true);
  ajaxRequest.send();
}

function readExcelFileForClass(oEvent) {
  var rABS = true;

  var files = oEvent.target.files, f = files[0];
  var reader = new FileReader();

  reader.onload = function(e){
    var data = e.target.result;
    if(!rABS) data = new Uint8Array(data);
    var workbook = XLSX.read(data, {type: rABS ? 'binary' : 'array'});

    var json = XLSX.utils.sheet_to_json(workbook.Sheets['Sheet1']);

    iTB = 0;
    excelClassToDatabase(json);
  };
  if(rABS) reader.readAsBinaryString(f); else reader.readAsArrayBuffer(f);
}

function excelClassToDatabase(json) {
  var input = "";

  var ajaxRequest = ajax(ajaxRequest);
  input = "nama=" + json[iTB]['Class'];

  ajaxRequest.onreadystatechange = function () {
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      if (respon == 1) {
        iTB++;
        if (iTB < json.length) {
          excelClassToDatabase(json);
        }
        else{
          dashboardKelas();
        }
      }
      else {
        iTB++;
        if (iTB < json.length) {
          excelClassToDatabase(json);
        }
      }
    }
  }

  ajaxRequest.open("POST", "control/tambahKelas.php", true);
  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxRequest.send(input);
}

function readExcelFileForTeacher(oEvent) {
  var rABS = true;

  var files = oEvent.target.files, f = files[0];
  var reader = new FileReader();

  reader.onload = function(e){
    var data = e.target.result;
    if(!rABS) data = new Uint8Array(data);
    var workbook = XLSX.read(data, {type: rABS ? 'binary' : 'array'});

    var json = XLSX.utils.sheet_to_json(workbook.Sheets['Sheet1']);

    iTB = 0;
    console.log(json);
    
    excelTeacherToDatabase(json);
  };
  if(rABS) reader.readAsBinaryString(f); else reader.readAsArrayBuffer(f);
}

function showDashboardUploadExcelTeacher() {
  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function () {
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      var display = document.getElementById('respon');
      display.innerHTML = respon;

      document.getElementById('excel').addEventListener('change', readExcelFileForTeacher, false);
    }
  }

  ajaxRequest.open("GET", "control/showDashboardUploadExcel.php", true);
  ajaxRequest.send();
}

function excelTeacherToDatabase(json) {
  var input = "";

  var ajaxRequest = ajax(ajaxRequest);
  input = "name=" + json[iTB]['Name'] + "&class=" + json[iTB]['Class'] + "&email=" + json[iTB]['Email'];

  ajaxRequest.onreadystatechange = function () {
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      if (respon == 1) {
        iTB++;
        if (iTB < json.length) {
          excelTeacherToDatabase(json);
        }
        else{
          dashboardGuru();
        }
      }
      else {
        iTB++;
        console.log(respon);
        if (iTB < json.length) {
          excelTeacherToDatabase(json);
        }
      }
    }
  }

  ajaxRequest.open("POST", "control/excelTeacherToDatabase.php", true);
  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxRequest.send(input);
}

function showDashboardUploadExcelParent(){
  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function () {
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      var display = document.getElementById('respon');
      display.innerHTML = respon;

      document.getElementById('excel').addEventListener('change', readExcelFileForParent, false);
    }
  }

  ajaxRequest.open("GET", "control/showDashboardUploadExcel.php", true);
  ajaxRequest.send();
}

function readExcelFileForParent(oEvent) {
  var rABS = true;

  var files = oEvent.target.files, f = files[0];
  var reader = new FileReader();

  reader.onload = function(e){
    var data = e.target.result;
    if(!rABS) data = new Uint8Array(data);
    var workbook = XLSX.read(data, {type: rABS ? 'binary' : 'array'});

    var json = XLSX.utils.sheet_to_json(workbook.Sheets['Sheet1']);

    iTB = 0;
    console.log(json);
    
    excelParentToDatabase(json);
  };
  if(rABS) reader.readAsBinaryString(f); else reader.readAsArrayBuffer(f);
}

function excelParentToDatabase(json){
  var input = "";

  var ajaxRequest = ajax(ajaxRequest);
  input = "email=" + json[iTB]['Email'];

  ajaxRequest.onreadystatechange = function () {
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      if (respon == 1) {
        iTB++;
        if (iTB < json.length) {
          excelParentToDatabase(json);
        }
        else{
          dashboardOrtu();
        }
      }
      else {
        iTB++;
        console.log(respon);
        if (iTB < json.length) {
          excelParentToDatabase(json);
        }
      }
    }
  }

  ajaxRequest.open("POST", "control/excelParentToDatabase.php", true);
  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxRequest.send(input);
}

function showDashboardUploadExcelStudent(){
  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function () {
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      var display = document.getElementById('respon');
      display.innerHTML = respon;

      document.getElementById('excel').addEventListener('change', readExcelFileForStudent, false);
    }
  }

  ajaxRequest.open("GET", "control/showDashboardUploadExcel.php", true);
  ajaxRequest.send();
}

function readExcelFileForStudent(oEvent) {
  var rABS = true;

  var files = oEvent.target.files, f = files[0];
  var reader = new FileReader();

  reader.onload = function(e){
    var data = e.target.result;
    if(!rABS) data = new Uint8Array(data);
    var workbook = XLSX.read(data, {type: rABS ? 'binary' : 'array'});

    var json = XLSX.utils.sheet_to_json(workbook.Sheets['Sheet1']);
    
    checkDatabaseParentAndClass(json);
  };
  if(rABS) reader.readAsBinaryString(f); else reader.readAsArrayBuffer(f);
}

function checkDatabaseParentAndClass(json) {
  var ajaxRequest = ajax(ajaxRequest);

  ajaxRequest.onreadystatechange = function () {
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      var newJson = JSON.parse(respon);

      var jsonn = '[';

      for(var i = 0; i < json.length; i++){
        if (contains(newJson.Class, 'name', json[i].Class) && contains(newJson.Email, 'Parent', json[i].Parent)) {
          if(i != (json.length - 1)){
            jsonn = jsonn + '{"nik":"' + json[i].NIK + '","name":"' + json[i].Name + '","parent":"' + json[i].Parent + '","class":"' + newJson.Class[i].id + '","paid":"' + json[i].Paid + '"},';
          }
          else{
            jsonn = jsonn + '{"nik":"' + json[i].NIK + '","name":"' + json[i].Name + '","parent":"' + json[i].Parent + '","class":"' + newJson.Class[i].id + '","paid":"' + json[i].Paid + '"}';
          }
        }
        else{
          console.log("Format salah");
        }
      }

      jsonn += ']';

      iTB = 0;
      excelStudentToDatabase(JSON.parse(jsonn));
    }
  }

  ajaxRequest.open("GET", "control/getParentAndClass.php", true);
  ajaxRequest.send();
}

function excelStudentToDatabase(json){
  var input = "";

  var ajaxRequest = ajax(ajaxRequest);
  input = "nik=" + json[iTB]['nik'] + "&name=" + json[iTB]['name'] + "&parent=" + json[iTB]['parent'] + "&class=" + json[iTB]['class'] + "&paid=" + json[iTB]['paid'];

  ajaxRequest.onreadystatechange = function () {
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      if (respon == 1) {
        iTB++;
        if (iTB < json.length) {
          excelStudentToDatabase(json);
        }
        else{
          dashboardMurid();
        }
      }
      else {
        iTB++;
        console.log(respon);
        if (iTB < json.length) {
          excelStudentToDatabase(json);
        }
      }
    }
  }

  ajaxRequest.open("POST", "control/excelStudentToDatabase.php", true);
  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxRequest.send(input);
}

function resetPassParent(id) {
  var input = 'id=' + id;
  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function () {
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      if (respon == 1) {
        alert("Success");
      }
      else{
        alert(respon);
      }
    }
  }

  ajaxRequest.open("POST", "control/resetPassParent.php", true);
  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxRequest.send(input);
}

function resetPassTeacher(id){
  var input = 'id=' + id;
  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function () {
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      if (respon == 1) {
        alert("Success");
      }
      else{
        alert(respon);
      }
    }
  }

  ajaxRequest.open("POST", "control/resetPassTeacher.php", true);
  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  ajaxRequest.send(input);
}

function contains(array, key, value){
  for(var i = 0; i < array.length; i++){
    if (array[i][key] == value) return true;
  }
  return false;
}

function logout() {
  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function(){
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      if (respon == 1) {
        window.location.href = 'http://tb.local/';
      }
    }
  }

  ajaxRequest.open("GET", "control/logout.php", true);
  ajaxRequest.send();
}