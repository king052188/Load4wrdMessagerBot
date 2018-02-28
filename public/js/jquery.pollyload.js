var fname = "", lname = "", mobile = "";
var code = 0;
$(document).ready(function() {
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
    if(mobile == "") {
      alert_box("Warning", "Please enter your mobile#.", "warning");
      return false;
    }
    var url = "/api/v1/web/verfiy/" + xtoken;
    var data = { fname : fname, lname : lname, mobile : mobile };
    $.ajax({
        dataType: 'json',
        type:'GET',
        url: url,
        data: data,
        beforeSend: function () {
          $("#btn_sign_up").text("Please wait...");
        }
    }).done(function(json){
        if(json.status == 200) {
          console.log(json);
          return false;
        }
        alert_box("Warning", json.message, "warning");
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
        type:'GET',
        url: url,
        data: data,
        beforeSend: function () {
          $("#btn_sign_up").text("Please wait...");
        }
    }).done(function(json){
        if(json.status == 200) {
          alert_box("Good Job!", json.message, "success");
          return false;
        }
        alert_box("Warning", json.message, "warning");
    });

  })
})
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