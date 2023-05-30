$(document).ready(function () {
 
  $("#total_price").prop("readonly", "true");
  $("#price_per_kg").prop("readonly", "true");
  $("#approval_for_discount").hide();
  $(".approvedDetails").hide();

  $("#quantity").on("input", function () {
    if ($("#select_crop").val() == 0) {
      alert("Please select crop !!");
      $("#select_crop").attr("class", "form-control form-control-danger");
      $("#quantity").val("");
    } else if (
      $("#select_variety").val() == "not_selected" ||
      $("#select_variety").val() == 0
    ) {
      alert("Please select variety!!");
      $("#select_variety").attr("class", "form-control form-control-danger");
      $("#quantity").val("");
    } else if ($("#select_class").val() == 0) {
      alert("Please select class !!");
      $("#select_class").attr("class", "form-control form-control-danger");
      $("#quantity").val("");
    }

    var result = $("#quantity").val();
    var result2 = $("#price_per_kg").val();
    let total = result * result2;

    $("#total_price").val(total);
    // Print entered value in a div box
    //$("#result").text($(this).val());
  });

  $("#discount_price").on("input", () => {
    if ($("#quantity").val() == "") {
      alert("Please fill out all required crop details first !!!");
      $("#discount_price").val("");
    } else {
      $("#approval_for_discount").show();
      $("#original_price").val($("#price_per_kg").val());
      $("#discount").val($("#discount_price").val());

      if ($("#discount_price").val() > 0) {
        $(".place_order_items").hide();
      } else {
        $(".place_order_items").show();
      }
    }
    // var result = $("#quantity").val();
    // var result2 = $("#discount_price").val();
    // var total = result * result2;

    // $("#total_price").val(total);
  });

  $("#discount_price").change(() => {
    window.location = "#discount_request";
  });

  const loaded = "1";

  $.post(
    "../production/get_products.php",
    {
      loaded: loaded,
    },
    (data) => {
      $("#select_crop").html(data);
    }
  );

  $("#select_crop").change(function () {
    var data = $("#select_crop").find(":selected");

    if (data.val() == "0") {
      alert("please select Crop ");
    } else {
      let crop_value = $("#select_crop").val();

      $.post(
        "../production/get_products.php",
        {
          crop_value: crop_value,
        },
        (data) => {
          $("#select_variety").html(data);
          clearRequiredTextFields();
        }
      );
    }
  });

  $("#select_variety").change(() => {
    clearRequiredTextFields();
    getSelectItems($("#select_class"));
  });

  function clearRequiredTextFields() {
    $("#quantity").val("");
    $("#discount_price").val("");
    $("#price_per_kg").val("");
  }

  function getSelectItems(selectItem) {
    let options = selectItem.find("option");
    selectItem.empty();
    $.each(options, function (index, option) {
      var optionElement = $("<option>")
        .val(option.value)
        .text(option.text)
        .appendTo(selectItem);
    });
  }

  function getSelectedCropDetails() {
    let selectedText = [];
    let selectedCrop = [
      $("#select_crop").find(":selected"),
      $("#select_variety").find(":selected"),
      $("#select_class").find(":selected"),
    ];
    selectedCrop.forEach((element) => {
      selectedText.push(element.text());
    });

    return selectedText;
  }

  $("#select_class").change(function () {
    var crop_data = $("#select_crop").val();
    var variety_data = $("#select_variety").val();
    var class_data = $("#select_class").val();

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

  $("#debtor_type").change(function () {
    var type_value = $("#debtor_type").val();

    if (type_value == "agro_dealer") {
      $("#lpoFiles").prop("readonly", true);
      $("#customer_name").attr("placeholder", "Search agro dealer by name");
      $("#description").attr("placeholder", "agro dealer phone");

      $("#select_class").empty();
      var myOptions = [
        {
          text: "Select Class",
          value: "0",
        },
        {
          text: "certified",
          value: "certified",
        },
      ];

      $.each(myOptions, function (i, el) {
        $("#select_class").append(new Option(el.text, el.value));
      });
    } else if (type_value == "b_to_b") {
      $("#lpoFiles").prop("readonly", false);

      $("#customer_name").attr("placeholder", "Search Business by name");
      $("#description").attr("placeholder", "Business description");

      $("#select_class").empty();
      var myOptions = [
        {
          text: "Select Class",
          value: "0",
        },
        {
          text: "basic",
          value: "basic",
        },
        {
          text: "Pre-basic",
          value: "pre_basic",
        },
        {
          text: "certified",
          value: "certified",
        },
      ];

      $.each(myOptions, function (i, el) {
        $("#select_class").append(new Option(el.text, el.value));
      });
    } else if (type_value == "customer") {
      $("#lpoFiles").prop("readonly", true);

      $("#customer_name").attr("placeholder", "Enter customer name");
      $("#description").attr("placeholder", "Enter customer phone number ");

      $("#select_class").empty();
      var myOptions = [
        {
          text: "Select Class",
          value: "0",
        },
        {
          text: "basic",
          value: "basic",
        },
        {
          text: "Pre-basic",
          value: "pre_basic",
        },
        {
          text: "certified",
          value: "certified",
        },
      ];

      $.each(myOptions, function (i, el) {
        $("#select_class").append(new Option(el.text, el.value));
      });
    }
    el;

    $("#search_main_certificate").on("input", function () {
      var main_certificate_value = $("#search_main_certificate").val();
      var main_quantity_value = $("#main_quantity").val();
      var crop_value = $("#select_crop").val();
      var variety_value = $("#select_variety").val();
      var class_result = $("#select_class").val();

      $.post(
        "farm_get_certificate.php",
        {
          main_certificate_value: main_certificate_value,
          main_quantity_value: main_quantity_value,
          crop_value: crop_value,
          variety_value: variety_value,
          class_value: class_value,
        },
        function (data) {
          $("#main_certificate").html(data);
        }
      );
    });
  });

  $("#customer_name").on("input", function () {
    let type_value = $("#debtor_type").val();
    let search_value = $("#customer_name").val();

    if (type_value == "type_not_selected") {
      alert("please select order type");
    } else if (type_value == "agro_dealer") {
      $.post(
        "get_data.php",
        {
          type_value: type_value,
          search_value: search_value,
        },
        function (data) {
          $("#search_result").html(data);
          // $('#description').attr('value',$('#search_result').val() + '  ( Agro_dealer phone number )');

          var data = $("#search_result").val();
          var test = data.split(",");

          $("#description").attr("value", test[1]);
        }
      );
    } else if (type_value == "b_to_b") {
      $.post(
        "get_data.php",
        {
          type_value: type_value,
          search_value: search_value,
        },
        function (data) {
          $("#search_result").html(data);
          // $('#description').attr('value',$('#search_result').val() + '  ( Business description )');

          var data = $("#search_result").val();
          var test = data.split(",");

          $("#description").attr(
            "value",
            test[1] + " ( Businesss description )"
          );
        }
      );
    } else if (type_value == "customer") {
      $.post(
        "get_data.php",
        {
          type_value: type_value,
          search_value: search_value,
        },
        function (data) {
          $("#search_result").html(data);
          // $('#description').attr('value',$('#search_result').val() + '  ( Business description )');

          var data = $("#search_result").val();
          var test = data.split(",");
          var temp_data = "-";

          if (test == null) {
            temp_data = "enter -";
          } else {
            temp_data = test[1];
          }

          $("#description").attr(
            "placeholder",
            temp_data + " (customer phone number) "
          );
        }
      );
    } else if (type_value == "grower") {
      $.post(
        "get_data.php",
        {
          type_value: type_value,
          search_value: search_value,
        },
        function (data) {
          $("#search_result").html(data);
          // $('#description').attr('value',$('#search_result').val() + '  ( Business description )');

          var data = $("#search_result").val();
          var test = data.split(",");

          $("#description").attr("value", test[1] + " ( grower phone number )");
        }
      );
    }
  });

  $("#checkDiscountCode").click(() => {
    check_if_approved($("#accessCode").val(), $("#approvalId").val());
  });

  $("#discount_request").click(() => {
    if ($("#discount_price").val() > $("#price_per_kg").val()) {
      alert("Invalid request: Discount price is greater than current price");
      $("#discount_price").attr("class", "form-control form-control-danger");
      window.location ="#discount_price";
    } else {
      let crop_details = getSelectedCropDetails();
      request_approval(
        "Discount price",
        "-",
        "Marketing",
        $("#user_id").val(),
        $("#user_name").val(),
        $("#user_name").val() +
          " is requesting to change price from " +
          $("#price_per_kg").val() +
          " to " +
          $("#discount_price").val() +
          " for (" +
          crop_details[0] +
          "," +
          crop_details[1] +
          "," +
          crop_details[2] +
          ")."
      );
    }
  });

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
  }

  function check_if_approved(accessCode, approvalId) {
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
            alert("Code is valid");
            $("#total_price").val(
              $("#quantity").val() * $("#discount_price").val()
            );
            $("#accessCode").attr("class", "form-control form-control-success");

            $(".place_order_items").show();
            $("#approval_for_discount").hide();
            window.location = "#discount_price";
          }
        }
      );
    }
  }
});
