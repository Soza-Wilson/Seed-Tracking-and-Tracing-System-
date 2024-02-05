$(document).ready(() => {
  const getApiData = () => {
    const data = "";
    $.post(
      "get_data/api_data.php",
      {
        get_api_details: data,
      },
      function (data) {
        
        const credatials = data.split(",");
        $("#user_name").val(credatials[0]);
        $("#access_key").val(credatials[1]);
      }
    );
  };

  $(".warning_text").css("color", "red").hide();
  getApiData();
  $("#file_directory").change(function () {
    uploadFile();
  });

  // initilize web API by send required data

  const isValidateText = (field) => {
    if ($("#" + field + "").val() == "") {
      $("#warning_" + field + "").show();
      return false;
    } else {
      return true;
    }
  };

  $("#connect").click(() => {
    if (confirm("Are you sure")) {
      if ((isValidateText("user_name"), isValidateText("access_key"))) {
        const credetials = {
          user_name: $("#user_name").val().toString(),
          access_key: $("#access_key").val().toString(),
        };
        $.post(
          "get_data/api_data.php",
          {
            sync_data: credetials,
          },
          function (data) {
            alert(data);
          }
        );
      }
    }
  });

  $("#register").click(() => {
    if (confirm("Are you sure ?")) {
      const credetials = {
        user_name: $("#user_name").val().toString(),
        access_key: $("#access_key").val().toString(),
      };
      $.post(
        "get_data/api_data.php",
        {
          register: credetials,
        },
        function (data) {
          alert(data);
          window.location.reload();
        }
      );
    }
  });

  // update company logo

  $("#save_image").click(() => {
    if (confirm("Are you sure?")) {
      saveImage();
    }
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
      "get_data/business_profile_data.php",
      {
        updateBusiness: data,
      },
      function (data) {
        alert(data);
        // alert("Business details updated");
        // window.location.reload();
      }
    );
  }

  function seasonDetails() {
    let seasonData = [$("#opening_date").val(), $("#closing_date").val()];
    var startDate = new Date(seasonData[0]);
    var endDate = new Date(seasonData[1]);
    var months = (endDate.getFullYear() - startDate.getFullYear()) * 12;
    months -= startDate.getMonth();
    months += endDate.getMonth();

    if (months < 3) {
      alert("Error : Season minimum is 3 months, please adjust date settings");
    } else if (months > 6) {
      alert("Error : Season maximum is 6 months, please adjust date settings");
    } else {
      $.post(
        "get_data/business_profile_data.php",
        {
          updateSeason: seasonData,
        },
        function (data) {
          alert(" Details updated");
          window.location.reload();
        }
      );
    }
  }

  const uploadFile = () => {
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
  };

  const saveImage = () => {
    if ($("#tempFile").val() == "") {
      alert("Please select logo image first");
    } else {
      $.post(
        "get_data/business_profile_data.php",
        {
          saveLogoImage: $("#tempFile").val(),
        },
        function (data) {
          alert(data);
          if (data == "saved") {
            alert("Image updated");
            window.location.reload();
          } else {
            alert("Error: failed to update image");
          }
        }
      );
      s;
    }
  };
});
