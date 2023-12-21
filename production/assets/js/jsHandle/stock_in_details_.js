$(document).ready(() => {
  $("#warning_certificate").css("color", "red").hide();
  $(".warning-text").css("color", "red").hide();
  $(".text-details").prop("disabled", true);

  //getting crop data

  const loaded = "1";

  $.post(
    "get_products.php",
    {
      loaded: loaded,
    },
    (data) => {
      $("#select_crop").html(data);
      let options = $("#select_crop").find("option");
      set_selected_data("#select_crop", options, $("#crop").val(), "crop");
    
    }
  );

  options = $("#select_class").find("option");
  set_selected_data("#select_class", options, $("#class").val(), "class");
  
  let for_certificate = 0;
  let other = 0;
  $("#select_crop").change(function () {
    let crop_value = $("#select_crop").val();
    $("#warning_text").show();
    for_certificate = for_certificate + 1;

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

  $("#quantity").on("input", () => {
    $("#warning_text").show();
    for_certificate = for_certificate + 1;
  });

  // Checking if fields are empty

  let description = $("#description").val();
  let seedReceiveNote = $("#srn").val();

  let binCardNumber = $("#bin_card").val();
  let bags = $("#number_of_bags").val();

  // getting certificarte data
  $("#search_certificate").on("input", function () {
    var stockIn_quantity = $("#quantity").val();
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
      }
    );
  });

  if ($("#seed_source").val() == "internal") {
    $(".seed_details").hide();
  }

  // Approval request
  $("#request_approval").click(() => {
    if ($("#approvalId").val() == "") {
      $("#approvalId").val(() => {
        const characters = "0123456789";
        let code = "APV";
        for (let i = 0; i < 8; i++) {
          code += characters.charAt(
            Math.floor(Math.random() * characters.length)
          );
        }
        return code;
      });

      let approvalId = $("#approvalId").val();
      let actionName = "update_stock_in";
      let depertment = "production";
      let action_id = $("#stock_in_id").val();
      let request_id = $("#request_id").val();
      let requestedName = $("#user_name").val();
      let description =
        requestedName + " is requesting to update stock in details";

      $.post(
        "get_data.php",
        {
          updateStockInRequest: actionName,
          depertment: depertment,
          action_id: action_id,
          request_id: request_id,
          requestedName: requestedName,
          approvalId: approvalId,
          description: description,
        },
        function (data) {
          alert("Request sent to Admin. Enter approval code to continue...");
          $("#approval_label").html(data);
        }
      );

      function generateCode() {
        let code = "";
        const characters =
          "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        for (let i = 0; i < 8; i++) {
          code += characters.charAt(
            Math.floor(Math.random() * characters.length)
          );
        }
        return code;
      }
    } else {
      alert("Request already sent. Enter conformation code to continue");
    }
  });

  $("#fileDirectory").on("input", () => {
    $("#warning_dir").hide();
    uploadFile();
  });

  ///

  // Update stock In function

  //check if approved code is valid

  $("#checkCodeDelete").click(() => {
    let accessCode = $("#accessCodeDelete").val();
    let approvalId = $("#approvalId").val();

    if (accessCode == "") {
      alert("Please Enter given approval code before submitting!!");
    } else {
      $.post(
        "get_data.php",
        {
          checkApprovalCode: accessCode,
          approvalId: approvalId,
        },
        function (data) {
          let check = checkFields();
          if (check > 0) {
            alert("Please fillout all required textfields ");
          } else {
            if (data == "valid") {
              let stockData = [
                $("#creditorId").val(),
                $("#stockInId").val(),
                $("#seedCertificate").val(),
                $("#ogQuantity").val(),
              ];

              $.post(
                "get_data.php",
                {
                  deleteStockIn: stockData,
                },
                function (data) {
                  if (data == "deleted") {
                    alert("Entry deleted");
                    window.location = "view_stock_in.php";
                  } else {
                    alert("Error: Operation failed ");
                  }
                }
              );
            } else {
            }
          }
        }
      );
    }
  });

  $("#checkCode").click(() => {
    let accessCode = $("#accessCode").val();
    let approvalId = $("#approvalId").val();
    uploadFile();

    if (accessCode == "") {
      alert("Please enter given approval code before submitting!!");
    } else {
      $.post(
        "get_data.php",
        {
          checkApprovalCode: accessCode,
          approvalId: approvalId,
        },
        function (data) {
          let check = checkFields();
          if (check > 0) {
            alert("Please fillout all required textfields ");
          } else {
            if (data == "valid") {
              let crop = $("#crop").val();
              let variety = $("#variety").val();
              let seedClass = $("#class").val();
              let quantity = $("#ogQuantity").val();
              let oldQuantity = $("#ogQuantity").val();
              let creditorId = $("#creditorId").val();
              let old_certificate = $("#seedCertificate").val();
              let new_certificate = "-";
              let description = $("#description").val();
              let seedReceiveNote = $("#srn").val();
              let stockInId = $("#stockInId").val();
              let binCardNumber = $("#bin_card").val();
              let bags = $("#number_of_bags").val();
              let dir = $("#directory").val();
              let status = 0;

              if ($("#select_variety").val() !== "0") {
                if ($("#select_variety").val() !== $("#variety").val()) {
                  crop = $("#select_crop").val();
                  variety = $("#select_variety").val();
                  seedClass = $("#select_class").val();
                  new_certificate = $("#certificate").val();
                  status = status + 1;
                }
              }

              if ($("#select_class").val() !== "0") {
                if ($("#select_class").val() !== $("#class").val()) {
                  crop = $("#select_crop").val();
                  variety = $("#select_variety").val();
                  seedClass = $("#select_class").val();
                  new_certificate = $("#certificate").val();
                  status = status + 1;
                }
              }

              if ($("#ogQuantity").val() !== $("#quantity").val()) {
                quantity = $("#quantity").val();
                new_certificate = $("#certificate").val();
                status = status + 1;
                
              }

              if (status == 0) {
                if ($("#certificate").val() !== $("#seedCertificate").val()) {
                  if (
                    $("#certificate").val() !== "no_certificate_selected" ||
                    $("#certificate").val() !== "not_found" ||
                    $("#certificate").val() !== "not_certified"
                  ) {
                    quantity = $("#quantity").val();
                    new_certificate = $("#certificate").val();
                    status = status + 4;
                  }
                }
              }

              $.post(
                "get_data/stock_in_data.php",
                {
                  updateStockIn: crop,
                  stockInId: stockInId,
                  creditorId: creditorId,
                  variety: variety,
                  seedClass: seedClass,
                  quantity: quantity,
                  oldQuantity: oldQuantity,
                  new_certificate: new_certificate,
                  old_certificate: old_certificate,
                  seedReceiveNote: seedReceiveNote,
                  binCardNumber: binCardNumber,
                  bags: bags,
                  dir: dir,
                  description: description,
                  status: status,
                },
                function (data) {
                  alert(data);

                  if (data == "success") {
                    alert("Entry successfully updated");
                    window.location = "view_stock_in.php";
                  } else {
                    alert("Error");
                  }
                }
              );
            } else {
              alert("Code is Invalid. Check and add again ");
            }
          }
        }
      );
    }
  });

  function checkFields() {
    let other = 0;
    if ($("#description").val() == "") {
      $("#warning_description").show();
      other = other + 1;
    }

    if ($("#srn").val() == 0) {
      $("#warning_srn").show();
      other = other + 1;
    }

    if ($("#bin_card").val() == 0) {
      $("#warning_bin_card").show();
      other = other + 1;
    }

    if ($("#number_of_bags").val() == 0) {
      $("#warning_bags").show();
      other = other + 1;
    }

    return other;
  }

  $("#delete_request").click(() => {
    let conf = confirm("Are you sure ?");
    if (conf == true) {
      const data = request_approval(
        "Delete_stock_in_entry",
        $("#stock_in_id").val(),
        "production",
        $("#request_id").val(),
        $("#user_name").val(),
        $("#user_name").val() + " is requesting to delete stock entery"
      );
      $("#delete_request").hide();
    }
  });

  // request for approval

  function request_approval(
    actionName,
    action_id,
    depertment,
    request_id,
    requestedName,
    description
  ) {
    if ($("#approvalId").val() == "") {
      $("#approvalId").val(() => {
        const characters = "0123456789";
        let code = "APV";
        for (let i = 0; i < 8; i++) {
          code += characters.charAt(
            Math.floor(Math.random() * characters.length)
          );
        }
        return code;
      });

      let approvalId = $("#approvalId").val();

      $.post(
        "get_data.php",
        {
          updateStockInRequest: actionName,
          depertment: depertment,
          action_id: action_id,
          request_id: request_id,
          requestedName: requestedName,
          approvalId: approvalId,
          description: description,
        },
        function (data) {
          alert("Request sent to Admin. Enter approval code to continue...");
          return data;
        }
      );
    } else {
      alert("Request already sent. Enter conformation code to continue");
    }
  }

  //upload file using php
  function check_certificate() {
    let status = 0;

    if (
      $("#certificate").val() !== "no_certificate_selected" ||
      $("#certificate").val() !== "Certificate not found" ||
      $("#certificate").val() !== "not_certified"
    ) {
      let quantity = $("#quantity").val();
      new_certificate = $("#certificate").val();
      status = status + 4;
      return status;
    }
  }


  function set_selected_data(
    select_element,
    options,
    selected_value,
    select_type
  ) {
    // Loop through each option and do something
    options.each(function () {
      var value = $(this).val(); // Get the value of the option
      var text = $(this).text(); // Get the text of the option
      console.log("Value: " + value + ", Text: " + text);
    });

    var selectElement = $(select_element);

    selectElement.empty();
    $.each(options, function (index, option) {
      var optionElement = $("<option>")
        .val(option.value)
        .text(option.text)
        .appendTo(selectElement);
    });

    // Set a specific option as selected
    var selectedValue = selected_value;
    selectElement.val(selectedValue);

    if (select_type == "crop") {
      set_selected_variety();
    } else if (select_type == "region") {
      let region_data = $(select_element).find(":selected");
      get_districts(region_data);
      options = $("#select_district").find("option");
      set_selected_data(
        "#select_district",
        options,
        $("#selected_district").val(),
        "district"
      );
    }
  }

  function set_selected_variety() {
    var data = $("#select_crop").find(":selected");

    if (data.val() == "0") {
      alert("please select Crop ");
    } else {
      let crop_value = $("#select_crop").val();

      $.post(
        "get_products.php",
        {
          crop_value: crop_value,
        },
        (data) => {
          $("#select_variety").html(data);

          let options = $("#select_variety").find("option");
          set_selected_data(
            "#select_variety",
            options,
            $("#variety").val(),
            "variety"
          );

         
        }
      );
    }
  }

  function uploadFile() {
    let formData = new FormData();
    let fileInput = document.querySelector("#fileDirectory");
    formData.append("file", fileInput.files[0]);

    fetch("upload.php", { method: "POST", body: formData })
      .then((response) => response.json())
      .then((data) => {
        filename = data.filename;
        $("#directory").val(filename);
      })
      .catch((error) => {
        console.log(error);
      });
  }
});
