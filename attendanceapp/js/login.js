function tryLogin() {
  let un = $("#txtUsername").val();
  let pw = $("#txtPassword").val();
  if (un.trim() !== "" && pw.trim() != "") {
    //make an ajax call

    $.ajax({
      url: "ajaxhandler/loginAjax.php",
      type: "POST",
      dataType: "json",
      data: { user_name: un, password: pw, action: "verifyUser" },
      beforeSend: function () {
        // if you want to do something just
        //before making the call
        // alert("about to make an ajax call");
      },
      success: function (rv) {
        //if the ajax call was successful,
        //result will be in rv
        //alert(JSON.stringify(rv));
        if (rv["status"] === "ALL OK") {
          document.location.replace("attendance.php");
        } else {
          alert(rv["status"]);
        }
      },
      error: function () {
        //if there was an error,
        //this function will be called
        alert("oops something went wrong");
      },
    });
  }
}
$(function (e) {
  // Capture the keyup event on all input fields
  $(document).on("keyup", "input", function (e) {
    let un = $("#txtUsername").val();
    let pw = $("#txtPassword").val();

    if (un.trim() !== "" && pw.trim() !== "") {
      $("#btnlogin").removeClass("inactivecolor").addClass("activecolor");
    } else {
      $("#btnlogin").removeClass("activecolor").addClass("inactivecolor");
    }
  });
  $(document).on("click", "#btnlogin", function (e) {
    tryLogin();
  });
});
