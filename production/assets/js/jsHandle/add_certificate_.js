$(document).ready(function () {
  $(".warning_text").css("color", "red").hide();
  $("#save_certificate").click(() => {
    let validate = confirm("Are you sure ?");
    let emptyFields = 0;
    if (validate == true) {
      if ($("#select_crop").val() == "0") {
        $("#warning_crop").show();
        emptyFields = emptyFields + 1;
      }
      if ($("#select_variety").val() == "not_selected") {
        $("#warning_variety").show();
        emptyFields = emptyFields + 1;
      }
      if ($("#select_class").val() == "0") {
        $("#warning_class").show();
        emptyFields = emptyFields + 1;
      }
      if ($("#lot_number").val() == "") {
        $("#warning_lot_number").show();
        emptyFields = emptyFields + 1;
      }
      if ($("#quantity").val() == 0) {
        $("#warning_quantity").show();
        emptyFields = emptyFields + 1;
      }
      if ($("#certificate_type").val() == "0") {
        $("#warning_certificate_type").show();
        emptyFields = emptyFields + 1;
      }
      if ($("#source").val() == "source_not_selected") {
        $("#warning_source").show();
        emptyFields = emptyFields + 1;
      } else if ($("#source").val() == "External") {
        if ($("#source_name").val() == "") {
          $("#warning_source_name").show();
        }
      }

      if ($("#date_tested").val() == "") {
        $("#warning_test_date").show();
        emptyFields = emptyFields + 1;
      }
      if ($("#expire_date").val() == "") {
        $("#warning_expire_date").show();
        emptyFields = emptyFields + 1;
      }
      if ($("#file_directory").val() == "") {
        $("#warning_file").show();
        emptyFields = emptyFields + 1;
      }

      if (emptyFields <= 0) {
        let data = [
          $("#select_crop").val(),
          $("#select_variety").val(),
          $("#select_class").val(),
          $("#certificate_type").val(),
          $("#lot_number").val(),
          $("#quantity").val(),
          $("#source").val(),
          get_source_name($("#source").val()),
          $("#date_tested").val(),
          $("#expire_date").val(),
          $("#file_directory").val(),
          $("#user").val(),
        ];
        function get_source_name(source) {
          if (source == "External") {
            return $("#source_name").val();
          } else {
            return "-";
          }
        }
          
        $.post(
          "get_data.php",
          {
            insertCertificate: data
          },
          function (data) {

            alert("Data added succefully");
            window.location.reload();
           
            
          }
        );


      } else {
        alert("Please fill out all require fields !!");
      }
    }

    if (emptyFields <= 0) {
      alert(working);
    } else if (emptyFields <= 0) {
      alert(working);
    }
  });
  const loaded = "1";

  $.post(
    "get_products.php",
    {
      loaded: loaded,
    },
    (data) => {
      $("#select_crop").html(data);
    }
  );

  $("#quantity").on("input", function () {
    var result = $("#quantity").val();
    var result2 = $("#price_per_kg").val();
    var total = result * result2;
    $("#warning_quantity").hide();

    $("#total_price").val(total);
    // Print entered value in a div box
    //$("#result").text($(this).val());
  });

  $("#select_crop").change(function () {
    let crop_value = $("#select_crop").val();
    $("#warning_crop").hide();

    $.post(
      "get_products.php",
      {
        crop_value: crop_value,
      },
      (data) => {
        $("#select_variety").html(data);
      }
    );
  });
  $("#select_variety").change(function () {
    $("#warning_variety").hide();
  });

  $("#certificate_type").change(function () {
    $("#warning_certificate_type").hide();
  });

  $("#lot_number").on("input", function () {
    $("#warning_lot_number").hide();
  });

  $("#source").change(function () {
    $("#warning_source").hide();
  });
  $("#source_name").on("input", function () {
    $("#warning_source_name").hide();
  });
  $("#date_tested").change(function () {
    $("#warning_test_date").hide();
  });
  $("#expire_date").change(function () {
    $("#warning_expire_date").hide();
  });
  $("#file_directory").change(function () {
    $("#warning_file").hide();
      uploadFile();
  });

  $("#select_class").change(function () {
    var crop_data = $("#select_crop").val();
    var variety_data = $("#select_variety").val();
    var class_data = $("#select_class").val();
    $("#warning_class").hide();

    if (crop_data == 0) {
      alert("Select crop and variety");
    } else if (variety_data == 0) {
      alert("Select crop and variety");
    } else {
      $.post(
        "get_prices.php",
        {
          crop_data: crop_data,
          variety_data: variety_data,
          class_data: class_data,
        },
        function (data) {
          $("#price_per_kg").val(data);
        }
      );
    }
  });

  // reset button

  $("#cancle").click(()=>{
   
    let conf = confirm("Are you sure ?");

    if( conf = true){
      window.location.reload();
          
    }
    else{
      
    }

  })

   /// upload file using PHP
   function uploadFile() {
    let formData = new FormData();
    let fileInput = document.querySelector("#file_directory");
    formData.append("file_certificate", fileInput.files[0]);

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

  
