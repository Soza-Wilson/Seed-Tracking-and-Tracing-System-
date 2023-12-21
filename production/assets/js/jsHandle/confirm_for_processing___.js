$(document).ready(() => {
  $(".warning_text").css("color", "red").hide();
  $("#fileDirectory").on("input", () => {
    $("#warning_dir").hide();
    uploadConformationFile();
  });

  $("#confirm").click(() => {
    let conf = confirm("Are you sure ?");

    if (conf == true) {
      confirmHandOver();
    }
  });

  $("#back").click(()=>{

    history.back();
  })
});

const confirmHandOver = () => {
  let conformationData = [
   
    $("#receive_id").val(),
    $("#receive_name").val(),
    $("#fileDirectory").val(),
     $("#grade_id").val(),
    $("#passed_quantity").val(),
    $("#stock_in_id").val(),
  ];

  $.post(
    "get_data/seed_processing_data.php",
    {
      seedHandOver: conformationData,
    },
    (data) => {
      alert(data);
      history.back()
    }
  );
};

const uploadConformationFile = () => {
  let formData = new FormData();
  let fileInput = document.querySelector("#fileDirectory");
  formData.append("conformationFile", fileInput.files[0]);

  fetch("upload.php", { method: "POST", body: formData })
    .then((response) => response.json())
    .then((data) => {
      filename = data.filename;
      $("#tempFile").val(filename);
    })
    .catch((error) => {
      console.log(error);
    });
};
