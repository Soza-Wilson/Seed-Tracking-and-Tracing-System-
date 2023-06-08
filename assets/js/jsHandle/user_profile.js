$(document).ready(() => {
  $("#back").click(() => {
    history.back();
  });

  $("#save_image").click(() => {
    let comformation = confirm("Are you sure ?");
    if (comformation == true) {
      $.post(
        "get_data.php",
        {
          updateProfilePicture: $("#tempFile").val(),
          userId: $("#user").val(),
        },
        (data) => {
          if (data == "updated") {
            alert("updated");
            window.location.reload();
          }
        }
      );
    }
  });

  $("#update_user").click(() => {
    let conformation = confirm("Are you sure ?");

    if (conformation==true){

      updateUser()
    }
  });

  $("#file_directory").change(() => {
    uploadFile();
  });

  function updateUser() {
    let userData = [$("#user").val(),$("#fullname").val(), $("#phone").val(),$("#email").val()];

    $.post(
      "get_data.php",
      {
        updateUser: userData,
      },
      (data) => {
       
        if (data == "updated") {
          alert("updated");
          window.location.reload();
        }
      }
    );
  }

  /// upload file using PHP
  function uploadFile() {
    let formData = new FormData();
    let fileInput = document.querySelector("#file_directory");
    formData.append("profile", fileInput.files[0]);

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
