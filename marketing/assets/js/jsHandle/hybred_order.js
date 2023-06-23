$(document).ready(() => {
  hybrid_order();

  $("#approval_for_discount").hide();
  $(".approvedDetails").hide();

  $("#male_discount").on("input", () => {
    validateDiscountData("male");
  });

  $("#main_discount").on("input", () => {
    validateDiscountData("main");
  });

  $("#male_discount").change(() => {
    window.location = "#discount_request";
    $("#female_discount").val("");
  });

  $("#female_discount").change(() => {
    reset_approval_request();

    $("#male_discount").val("");
  });

  $("#female_discount").on("input", () => {
    reset_approval_request();
    validateDiscountData("female");
  });

  if ($("#data_main_certificate").val() == "-") {
    $("#main_values").hide();
    createCertificateTable(
      $("#data_male_certificate").val(),
      $("#data_male_quantity").val(),
      "male_values",
      "male"
    );

    createCertificateTable(
      $("#data_female_certificate").val(),
      $("#data_female_quantity").val(),
      "female_values",
      "female"
    );
  } else {
    $("#main_values").show();
    $("#male_values").hide();
    $("#female_values").hide();
    createCertificateTable(
      $("#data_main_certificate").val(),
      $("#data_main_quantity").val(),
      "main_values",
      "main"
    );
  }

  $("#place_order").click(() => {
    if ($("#data_main_certificate").val() == "-") {
      add_order_item("male");
      add_order_item("female");
    } else {
      add_order_item("main");
    }
  });

  $("#checkDiscountCode").click(() => {
    check_if_approved(
      $("#accessCode").val(),
      $("#approvalId").val(),
      $("#discount_type").val()
    );
  });

  $("#discount_request").click(() => {
    if ($("#original_price").val() < $("#discount").val()) {
      alert("Error : Discount price is greater than current price");
      $("#discount").attr("class", "form-control form-control-danger");
    } else {
      request_approval(
        "Request for breeder " + $("#discount_type").val() + " seed discount",
        "-",
        "Marketing",
        $("#user_id").val(),
        $("#user_name").val(),
        $("#user_name").val() +
          " requesting discount from " +
          $("#original_price").val() +
          " to " +
          $("#discount").val()
      );
    }
  });

  const setMaledata = () => {
    $.post(
      "get_data.php",
      {
        crop_value: crop_value,
      },
      (data) => {
        $("#select_variety").html(data);
        priceForMaize();
      }
    );
  };
});

const validateDiscountData = (cropType) => {
  $("#approval_for_discount").show();
  $("#original_price").val($("#" + cropType + "_price").val());
  $("#discount").val($("#" + cropType + "_discount").val());
  $("#discount_type").val(cropType);

  if ($("#discount_price").val() > 0) {
    $(".place_order_items").hide();
  } else {
    $(".place_order_items").show();
  }
};

const createCertificateTable = (certificate, quantity, tableName, cropType) => {
  const tableData = [certificate, quantity, tableName, cropType];
  $.post(
    "get_data.php",
    {
      createCertificateTable: tableData,
    },
    (data) => {
      fetch("assets/JSON/" + cropType + "_order_details.json")
        .then((response) => response.json())
        .then((data) => {
          $("#" + cropType + "_crop").empty();
          $("#" + cropType + "_crop").append(
            new Option(data.crop_name, data.crop_id)
          );

          $("#" + cropType + "_variety").empty();
          $("#" + cropType + "_variety").append(
            new Option(data.variety_name, data.variety_id)
          );

          $("#" + cropType + "_quantity").empty();
          $("#" + cropType + "_quantity").append(
            new Option(quantity, quantity)
          );

          $("#" + cropType + "_price").empty();
          $("#" + cropType + "_price").append(
            new Option(data.price, data.price)
          );
          $("#" + cropType + "_total").prop("readonly", true);
          $("#" + cropType + "_total").val(data.price * quantity);
        })
        .catch((error) => {
          console.log(error);
        });
      // $("#warning_farm").hide();
    }
  );
};

const request_approval = (
  actionName,
  action_id,
  depertment,
  request_id,
  requestedName,
  description
) => {
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
        discountRequest: actionName,
        depertment: depertment,
        action_id: action_id,
        request_id: request_id,
        requestedName: requestedName,
        approvalId: approvalId,
        description: description,
      },
      function (data) {
        alert("Request sent to Admin. Enter approval code to continue...");
        $(".requestDetails").hide();
        $(".approvedDetails").show();
      }
    );
  } else {
    alert("Request already sent. Enter conformation code to continue");
  }
};

const check_if_approved = (accessCode, approvalId, cropType) => {
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
        if (data == "invalid") {
          alert("The code you enter is invalid. try again");

          $("#accessCode").attr("class", "form-control form-control-danger");
        } else if (data == "valid") {
          alert("Code is valid, total amount updated ");
          $("#" + cropType + "_total").val(
            $("#" + cropType + "_quantity").val() *
              $("#" + cropType + "_discount").val()
          );
          $("#accessCode").attr("class", "form-control form-control-success");

          $(".place_order_items").show();
          $("#approval_for_discount").hide();
          window.location = "#" + cropType + "_discount";
        }
      }
    );
  }
};

const reset_approval_request = () => {
  $("#accessCode").val("");
  $("#approval_for_discount").show();
  $(".requestDetails").show();
  $(".approvedDetails").hide();
};

const hybrid_order = () => {
  $("#order_id").val(generate_order_id());
};

const generate_order_id = () => {
  const characters = "0123456789";
  let code = "ORDER";
  for (let i = 0; i < 8; i++) {
    code += characters.charAt(Math.floor(Math.random() * characters.length));
  }
  return code;
};

const add_order_item = (cropType) => {
  const orderData = [
    $("#order_id").val(),
    $("#" + cropType + "_crop").val(),
    $("#" + cropType + "_variety").val(),
    "breeder",
    $("#" + cropType + "_quantity").val(),
    $("#" + cropType + "_price").val(),
    $("#" + cropType + "_discount").val(),
    $("#" + cropType + "_total").val(),
  ];

  $.post(
    "get_data.php",
    {
      addOrderItem: orderData,
    },
    function (data) {
      alert(data);
    }
  );
};
