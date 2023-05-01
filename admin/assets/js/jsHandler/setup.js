$(document).ready(() => {
  $("#file_directory").change(function () {
    $("#warning_file").hide();
    uploadFile();
  });

  $("#save").click(() => {
    let conf = confirm("Are you sure ?");

    if (conf == true) {
      businessDetails();
      seasonDetails();
    }
  });

  function businessDetails() {
    let data = [
      $("#business_name").val(),
      $("#country").val(),
      $("#physical_address").val(),
      $("#tempFile").val(),
    ];

    $.post(
      "get_data.php",
      {
        updateBusiness: data,
      },
      function (data) {
        // alert("Business details updated");
        // window.location.reload();
      }
    );
  }

  function seasonDetails() {
   let seasonData = [$("#opening_date").val(), $("#closing_date").val()];

    $.post(
      "get_data.php",
      {
        updateSeason: seasonData,
      },
      function (data) {

    
        alert(" Details updated");
        window.location.reload();
      }
    );
  }

  function uploadFile() {
    let formData = new FormData();
    let fileInput = document.querySelector("#file_directory");
    formData.append("logo_image", fileInput.files[0]);

    fetch("../production/upload.php", { method: "POST", body: formData })
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
