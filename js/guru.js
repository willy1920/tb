function dashboardSiswa(id) {
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

function getSiswa() {
  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function(){
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      var display = document.getElementById('respon');
      display.innerHTML = respon;
    }
  }
  
  ajaxRequest.open("GET", "control/getSiswa.php", true);
  ajaxRequest.send();
}

function changePasswordDashboard() {
  var ajaxRequest = ajax(ajaxRequest);
  ajaxRequest.onreadystatechange = function(){
    if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
      var respon = ajaxRequest.responseText;
      var display = document.getElementById('respon');
      display.innerHTML = respon;
    }
  }
  
  ajaxRequest.open("GET", "control/changePasswordDashboard.php", true);
  ajaxRequest.send();
}

function passwordChecker(id) {
  var strength = document.getElementById('strength' + id);
  var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
  var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
  var enoughRegex = new RegExp("(?=.{6,}).*", "g");
  var pwd = document.getElementById("password" + id);
  if (pwd.value.length == 0) {
    strength.innerHTML = 'Type Password';
  } else if (false == enoughRegex.test(pwd.value)) {
    strength.innerHTML = 'More Characters';
  } else if (strongRegex.test(pwd.value)) {
    strength.innerHTML = '<span style="color:green">Strong!</span>';
  } else if (mediumRegex.test(pwd.value)) {
    strength.innerHTML = '<span style="color:orange">Medium!</span>';
  } else {
    strength.innerHTML = '<span style="color:red">Weak!</span>';
  }
}

function passwordValue(){
  var pass1 = document.getElementById('password1').value;
  var pass2 = document.getElementById('password2').value;

  var check = document.getElementById('check');

  if (pass1 != pass2) {
    check.innerHTML = '<span style="color:red">Password is not match</span>';
    return false;
  }
  else{
    check.innerHTML = '<span style="color:green">Password is match</span>';
    return true;
  }
}

function changePassword(){
  console.log("lalalal");
  if (passwordValue()) {
    var email = document.getElementById('email').value;
    var pass = document.getElementById('password1').value;

    var input = "email=" + email + "&pass=" + pass;
    
    var ajaxRequest = ajax(ajaxRequest);
    ajaxRequest.onreadystatechange = function(){
      if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
        var respon = ajaxRequest.responseText;
        if (respon == 1) {
          getSiswa();
        }
        else {
          alert(respon);
        }
      }
    }
  
    ajaxRequest.open("POST", "control/changePassword.php", true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajaxRequest.send(input);
  }
  else{
    alert("Password is not match");
  }
}