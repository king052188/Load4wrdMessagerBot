var fname = "", lname = "", mobile = "";
var code = 0;
$(document).ready(function() {
  $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
  })

  $("#btn_sign_up").click(function() {
    fname = $("#fname").val();
    lname = $("#lname").val();
    mobile = $("#mobile").val();
    if(fname == "") {
      alert_box("Warning", "Please enter your firstname.", "warning");
      return false;
    }
    if(lname == "") {
      alert_box("Warning", "Please enter your lastname.", "warning");
      return false;
    }
    if(mobile.length < 11 || mobile.length > 11) {
      alert_box("Warning", "Invalid mobile number", "warning");
      return false;
    }
    if(mobile == "") {
      alert_box("Warning", "Please enter your mobile#.", "warning");
      return false;
    }
    var url = "/api/v1/web/verfiy/" + xtoken;
    var data = { fname : fname, lname : lname, mobile : mobile };
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: url,
        data: data,
        beforeSend: function () {
          $("#btn_sign_up").text("Please wait...");
          $("#btn_sign_up").attr("disabled", "disabled");
        }
    }).done(function(json){
        if(json.status == 200) {
          code = json.one_time_password;
          $("#btn_modal1").click();
          return false;
        }
        alert_box("Warning", json.message, "warning");
        $("#btn_sign_up").text("Sign Up");
        $("#btn_sign_up").removeAttr("disabled", "disabled");
    });

  })

  $("#btn_verify").click(function() {
    var mpin = $("#mpin").val();
    if(mpin != code) {
      alert_box("Warning", "Invalid verification code.", "warning");
      return false;
    }
    var url = "/api/v1/web/register/" + xtoken;
    var data = { fname : fname, lname : lname, mobile : mobile };
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: url,
        data: data,
        beforeSend: function () {
          $("#btn_sign_up").text("Please wait...");
        }
    }).done(function(json){
        if(json.status == 200) {
          alert_box("Good Job!", json.message, "success");
          $("#mpin").val("");
          $("#btn_verify").attr("disabled", "disabled");
          setInterval(reload, 2000);
          return false;
        }
        alert_box("Warning", json.message, "warning");
    });

  })
})

function reload() {
  location.reload();
}
function alert_box(title, message, type) {
  swal({
      title: title,
      text: message,
      type: type,
      buttonsStyling: false,
      confirmButtonClass: 'btn btn-success',
      background: 'rgba(0, 0, 0, 0.96)'
  })
}
