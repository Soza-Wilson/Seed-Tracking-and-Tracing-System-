$(document).ready(() => {
  $("#approval_for_discount").hide();
  $(".approvedDetails").hide();
  generate_order_id();

  $("#checkCode").click(() => {
    check_if_approved($("#accessCode").val(), $("#approvalId").val());
  });

  $("#place_order").click(() => {
    add_order_item();

    const conformation = confirm("Are you sure ?");

    if (conformation == true) {
      prepareOrder(
        $("#order_id").val(),
        $("#creditor_name").val(),
        $("#creditor_id").val(),
        $("#user_id").val(),
        1,
        $("#farm_id").val()
      );
    }
  });

  $("#crop_discount_price").on("input", () => {
    validateDiscountData();
  });
  $("#crop_discount_price").change(() => {
    window.location = "#discount_request";
  });

  $("#discount_request").click(() => {
    if ($("#original_price").val() < $("#discount").val()) {
      alert("Error : Discount price is greater than current price");
      $("#discount").attr("class", "form-control form-control-danger");
    } else {
      request_approval(
        "Request for (" +
          $("#crop").val() +
          "," +
          $("#variety").val() +
          "," +
          $("#certificate_class").val() +
          ") seed discount",
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
});

$("#discount_request").click(() => {
  if (parseInt($("#price_per_kg").val()) < parseInt($("#discount").val())) {
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

const validateDiscountData = () => {
  $("#approval_for_discount").show();
  $("#original_price").val($("#price_per_kg").val());
  $("#discount").val($("#crop_discount_price").val());

  if (parseInt($("#discount_price").val()) > 0) {
    $(".place_order_items").hide();
  } else {
    $(".place_order_items").show();
  }
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

const check_if_approved = (accessCode, approvalId) => {
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
          $("#total_price").val(
            parseInt($("#certificate_quantity").val()) *
              parseInt($("#crop_discount_price").val())
          );
          $("#accessCode").attr("class", "form-control form-control-success");
          $("#crop_discount_price").prop("readonly", "true");

          $(".place_order_items").show();
          $("#approval_for_discount").hide();
          window.location = "#crop_discount_price";
        }
      }
    );
  }
};

// generate order id and insertying new order item
const generate_order_id = () => {
  const characters = "0123456789";
  let code = "ORDER";
  for (let i = 0; i < 8; i++) {
    code += characters.charAt(Math.floor(Math.random() * characters.length));
  }
  $.post(
    "get_data.php",
    {
      addOrderId: code,
    },
    function (data) {
      $("#order_id").val(code);
    }
  );
};

//  add order to Items
const add_order_item = () => {
  const orderData = [
    $("#order_id").val(),
    $("#crop_id").val(),
    $("#variety_id").val(),
    $("#certificate_class").val(),
    $("#certificate_quantity").val(),
    $("#price_per_kg").val(),
    $("#crop_discount_price").val(),
    $("#total_price").val(),
  ];

  $.post(
    "get_data.php",
    {
      addOrderItem: orderData,
    },
    function (data) {
     
    }
  );
};

const prepareOrder = (
  order_id,
  grower_name,
  grower_id,
  user_id,
  count,
  farm_id
) => {
  const orderData = [order_id, grower_name, grower_id, user_id, count, farm_id];

  $.post(
    "get_data.php",
    {
      prepareHybridOrder: orderData,
    },
    function (data) {
      
      if (data == "updated") {
        alert(" Order placed ");
        window.location = "grower_order.php";
      } else {
        alert(" Error: something went wrong ");
        window.location.reload();
      }
    }
  );
};


