$(document).ready(function () {
  $("#internal").hide();
  $("#external").hide();
  let filename = "";

  $(".warning_text").css("color", "red").hide();
  $("#warning_text").css("color", "red");

  $("#save_test").click(() => {
    let save = confirm("Are you sure ?");
    if (save == true) {
      let emptyFields = 0;
      if ($("#creditor_source").val() == "source_not_selected") {
        $("#warning_source").show();
        emptyFields = emptyFields + 1;
      }
      if ($("#search_result").val() == "0") {
        $("#warning_creditor").show();
        emptyFields = emptyFields + 1;
      }

      if ($("#creditor_source").val() == "external") {
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
        if ($("#external_quantity").val() == 0) {
          $("#warning_external_quantity").show();
          emptyFields = emptyFields + 1;
        }
        if (
          $("#certificate").val() == "no_certificate_selected" ||
          $("#certificate").val() == "not_found"
        ) {
          $("#warning_certificate").show();
          emptyFields = emptyFields + 1;
        }
      } else if ($("#creditor_source").val() == "internal") {
        if ($("#farm_quantity").val() == 0) {
          $("#warning_farm_quantity").show();
          emptyFields = emptyFields + 1;
        }
        if ($("#search_farm_result").val() == "0") {
          $("#warning_farm").show();
          emptyFields = emptyFields + 1;
        }
      }

      if ($("#description").val() == "") {
        $("#warning_description").show();
        emptyFields = emptyFields + 1;
      }
      if ($("#srn").val() == 0) {
        $("#warning_srn").show();
        emptyFields = emptyFields + 1;
      }
      if ($("#bin_card").val() == 0) {
        $("#warning_bin_card").show();
        emptyFields = emptyFields + 1;
      }
      if ($("#number_of_bags").val() == 0) {
        $("#warning_bags").show();
        emptyFields = emptyFields + 1;
      }
      if ($("#fileDirectory").val() == "") {
        $("#warning_dir").show();
        emptyFields = emptyFields + 1;
      }

      if (emptyFields > 0) {
        alert("Please fill out all required fields");
      } else if (emptyFields <= 0) {
        //$object->stock_in($creditor, $certificate, $farm_ID, $status, $crop, $variety, $class, $source, $srn, $bincard, $bags, $quantity, $description, $newfilename);

        formData = [
          $("#search_result").val(),
          "-",
          "-",
          "-",
          "-",
          "-",
          "-",
          $("#creditor_source").val(),
          $("#srn").val(),
          $("#bin_card").val(),
          $("#number_of_bags").val(),
          "-",
          $("#description").val(),
          $("#tempFile").val(),
        ];
        // saveFile();
        // async function saveFile() {
        //   let form = new formData();
        //   form.append("file", fileDirectory.file[0]);
        //   await fetch("file_upload.php", { method: "POST", body: form });
        //   alert("file uploded");

        // .then((response) => {
        //   alert("Resoilve", response);
        // })
        // .catch((err) => {
        //   console.log("rejected", err);
        // });
        // }
        if ($("#creditor_source").val() == "external") {
          formData[1] = $("#certificate").val();
          formData[4] = $("#select_crop").val();
          formData[5] = $("#select_variety").val();
          formData[6] = $("#select_class").val();
          formData[11] = $("#external_quantity").val();
          if (formData[1] == "not_certified") {
          }
          if ($("#certificate").val() == "not_certified") {
            formData[3] = "ungraded";
          } else {
            formData[3] = "certified";
          }
        } else if ($("#creditor_source").val() == "internal") {
          formData[1] = "";
          formData[2] = $("#search_farm_result").val();
          formData[3] = "ungraded";
          formData[4] = $("#farm_crop").val();
          formData[5] = $("#farm_variety").val();
          formData[6] = $("#farm_class").val();
          formData[11] = $("#farm_quantity").val();
        }

        let user = $("#user").val();
        uploadFile();

        $.post(
          "get_data/stock_in_data.php",
          {
            insertStockIn: formData[0],
            certificate: formData[1],
            farmID: formData[2],
            status: formData[3],
            crop: formData[4],
            variety: formData[5],
            class: formData[6],
            seedSource: formData[7],
            srn: formData[8],
            binCard: formData[9],
            bags: formData[10],
            quantity: formData[11],
            description: formData[12],
            fileDirectory: formData[13],
            user: user,
          },
          function (data) {
            if (data == "Not set") {
              alert(" Error :Buyback prices are not set !!");
              window.location.reload();
            } else {
              alert("Seed added to inventory");
              window.location.reload();
            }
          }
        );
      }
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

  $("#creditor_search").on("input", function () {
    var data = $("#creditor_source").find(":selected");

    if (data.val() == "source_not_selected") {
      alert("please select source first ");
    } else {
      var result_value = $("#creditor_search").val();
      var select = $("#creditor_source").find(":selected");
      var data = select.val();
      $.post(
        "get_creditors.php",
        {
          data: data,
          result_value: result_value,
        },
        function (data) {
          $("#search_result").html(data);
          $("#warning_creditor").hide();
        }
      );
    }
  });

  $("#farm_search").on("input", function () {
    var farm_value = $("#farm_search").val();
    var grower_value = $("#search_result").find(":selected");
    var grower_data = grower_value.val();

    $.post(
      "get_creditors.php",
      {
        farm_value: farm_value,
        grower_data: grower_data,
      },
      function (data) {
        $("#search_farm_result").html(data);
      }
    );
  });

  $("#search_certificate").on("input", function () {
    var stockIn_quantity = $("#external_quantity").val();
    var stockIn_certificate = $("#search_certificate").val();
    var crop_value = $("#select_crop").val();
    var variety_value = $("#select_variety").val();
    var class_value = $("#select_class").val();

    $.post(
      "get_creditors.php",
      {
        stockIn_certificate: stockIn_certificate,
        stockIn_quantity: stockIn_quantity,
        crop_value: crop_value,
        variety_value: variety_value,
        class_value: class_value,
      },
      function (data) {
        $("#certificate").html(data);

        if (data == "Certificate not found") {
        } else {
          $("#warning_certificate").hide();
        }
      }
    );
  });

  $("#select_crop").change(function () {
    let crop_value = $("#select_crop").val();

    $.post(
      "get_products.php",
      {
        crop_value: crop_value,
      },
      (data) => {
        changeMaizeClassValues($("#select_crop"));
       
        $("#select_variety").html(data);
        $("#warning_crop").hide();
      }
    );
  });

  $("#select_variety").change(() => {
    $("#warning_variety").hide();
  });
  $("#select_class").change(() => {
    $("#warning_class").hide();
  });

  $("#external_quantity").on("input", () => {
    $("#warning_external_quantity").hide();
  });
  $("#farm_quantity").on("input", () => {
    $("#warning_farm_quantity").hide();
  });

  $("#description").on("input", () => {
    $("#warning_description").hide();
  });
  $("#srn").on("input", () => {
    $("#warning_srn").hide();
  });
  $("#bin_card").on("input", () => {
    $("#warning_bin_card").hide();
  });
  $("#number_of_bags").on("input", () => {
    $("#warning_bags").hide();
  });
  $("#fileDirectory").on("input", () => {
    $("#warning_dir").hide();
    uploadFile();
  });

  $("#creditor_name").on("input", () => {
    $("#warning_creditor_name").hide();
  });
  $("#creditor_phone").on("input", () => {
    $("#warning_creditor_phone").hide();
  });
  $("#creditor_description").on("input", () => {
    $("#warning_creditor_description").hide();
  });

  $("#add_creditor").click(() => {
    let save = confirm("Are you sure ?");
    if (save == true) {
      let emptyFields = 0;
      if ($("#creditor_name").val() == "") {
        $("#warning_creditor_name").show();
        emptyFields = emptyFields + 1;
      }
      if ($("#creditor_phone").val() == "") {
        $("#warning_creditor_phone").show();
        emptyFields = emptyFields + 1;
      }
      if ($("#creditor_description").val() == "") {
        $("#warning_creditor_description").show();
        emptyFields = emptyFields + 1;
      }

      if (emptyFields > 0) {
        alert("Please fill out all required fields ");
      } else if (emptyFields <= 0) {
        //// Geting credior details
        let data = [
          $("#creditor_name").val(),
          $("#creditor_phone").val(),
          getEmail(),
          $("#creditor_description").val(),
          $("#user").val(),
        ];

        $.post(
          "get_data.php",
          {
            insertExtCreditor: data,
          },
          function (data) {
            if (data == "added") {
              alert("Data added succefully");
              window.location.reload();
            } else {
              alert("Error: Try again");
            }
          }
        );
      }
    }

    function getEmail() {
      let emailData = "";
      if ($("#creditor_email").val() == "") {
        emailData = "-";
      } else {
        emailData = $("#creditor_email").val();
      }
      return emailData;
    }
  });

  $("#creditor_source").change(function () {
    var data = $("#creditor_source").find(":selected");

    if (data.val() == "source_not_selected") {
      alert("please select source ");
    } else if (data.val() == "internal") {
      $("#external").hide();
      $("#internal").show();
      $("#warning_source").hide();

      document.getElementById("creditor_name").readOnly = true;
      document.getElementById("creditor_email").readOnly = true;
      document.getElementById("creditor_phone").readOnly = true;
      document.getElementById("creditor_description").readOnly = true;

      var search_value = data.val();

      $.post(
        "get_creditors.php",
        {
          search_value: search_value,
          data: data,
        },
        function (data) {
          $("#search_result").html(data);
        }
      );
    } else if (data.val() == "external") {
      $("#internal").hide();
      $("#external").show();
      $("#warning_source").hide();

      document.getElementById("creditor_name").readOnly = false;
      document.getElementById("creditor_email").readOnly = false;
      document.getElementById("creditor_phone").readOnly = false;
      document.getElementById("creditor_description").readOnly = false;
    }
  });

  $("#search_farm_result").change(function () {
    var data = $("#search_farm_result").find(":selected");
    var search_farm_result = data.val();

    $.post(
      "get_creditors.php",
      {
        search_farm_result: search_farm_result,
      },
      function (data) {
        fetch("farm_data.json")
          .then((response) => response.json())
          .then((data) => {
            $("#farm_crop").empty();
            $("#farm_crop").append(new Option(data.crop, data.crop_id));

            $("#farm_variety").empty();
            $("#farm_variety").append(
              new Option(data.variety, data.variety_id)
            );
            $("#farm_class").empty();
            $("#farm_class").append(
              new Option(data.farm_class, data.farm_class)
            );

            $("#farm_physical_address").empty();

            $("#farm_physical_address").val(data.address);
          });
        $("#warning_farm").hide();
      }
    );
  });

  /// upload file using PHP
  function uploadFile() {
    let formData = new FormData();
    let fileInput = document.querySelector("#fileDirectory");
    formData.append("file", fileInput.files[0]);

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

const changeMaizeClassValues = (selected) => {
  maizeCLassValues = ["Select class", "breeder", "certified"];
  otherCLassValues = ["Select class", "pre_basic", "basic","certified"];

  if (selected.val() == "CP001") {
    $("#select_class").empty();
    maizeCLassValues.forEach((element) => {
      if (element == "Select class") {
        $("#select_class").append(new Option(element, "0"));
      } else {
        $("#select_class").append(new Option(element, element));
      }
    });
  } else {
    $("#select_class").empty();
    otherCLassValues.forEach((element) => {
      if (element == "Select class") {
        $("#select_class").append(new Option(element, "0"));
      } else {
        $("#select_class").append(new Option(element, element));
      }
    });
  }
};
