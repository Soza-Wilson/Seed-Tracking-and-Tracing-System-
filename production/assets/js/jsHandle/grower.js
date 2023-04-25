$(document).ready(() => {
  $(".warning_text").css("color", "red").hide();

  $("#save_grower").click(() => {
    let fields = checkTextfield();
    if (fields > 0) {
      alert("Please fill out all required fields !!");
    } else {
     
      let growerData = [
        "MUSECO",
        $("#creditor_name").val(),
        $("#creditor_phone").val(),
        $("#creditor_email").val(),
        $("#user").val(),
        $("#tempFile").val(),
      ];

      $.post(
        "get_data.php",
        {
          registerGrower: growerData,
        },
        (data) => {
            if(data == "added"){
                 alert("Grower registered");
                 window.location.reload();

            }
            else{

                alert("Error: Grower not registered ");
                window.location.reload();

            }

        

          
        }
      );
    }
  });

  $("#creditor_name").on("input", () => {
    $("#warning_creditor_name").hide();
  });
  $("#creditor_phone").on("input", () => {
    $("#warning_creditor_name").hide();
  });
 
  $("#fileDirectory").on("input", () => {
    $("#warning_contract").hide();
    uploadFile();
  });

  function checkTextfield() {
    let emptyFields = 0;
    if ($("#creditor_name").val() == "") {
      $("#warning_creditor_name").show();
      emptyFields = emptyFields + 1;
    }
    if ($("#creditor_phone").val() == "") {
      $("#warning_creditor_phone").show();
      emptyFields = emptyFields + 1;
    }
    if ($("#fileDirectory").val() == "") {
      $("#warning_contract").show();
      emptyFields = emptyFields + 1;
    }

    return emptyFields;
  }

  /// upload file using PHP
  function uploadFile() {
    let formData = new FormData();
    let fileInput = document.querySelector("#fileDirectory");
    formData.append("growerFile", fileInput.files[0]);

    fetch("upload.php", { method: "POST", body: formData })
      .then((response) => response.json())
      .then((data) => {
        filename = data.filename;
        $("#tempFile").val(filename);
      })
      .catch((error) => {
        console.log(error);
      });
  }
});
