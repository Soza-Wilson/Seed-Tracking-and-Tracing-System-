$(document).ready(function () {
  $(".warning-text").css("color", "red").hide();
  $(".confirm_group").hide();

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

  $("#select_crop").change(function () {
    let crop_value = $("#select_crop").val();
    $("#warning_text").show();

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

  $("#get_data").click(() => {
    let filterData = [
      $("#certificate_type").val(),
      $("#select_crop").val(),
      $("#select_variety").val(),
      $("#select_class").val(),
      $("#fromDateValue").val(),
      $("#toDateValue").val(),
    ];

    if (checkFilterFields() > 0) {
      alert("Please fill out all required text fields ");
    } else {
      toCsv();
      $.post(
        "get_data.php",
        {
        certificateFilter: filterData,
        },
        (data) => {
         
        $("#dataTable").html(data);
        }
      );
    }
  });

  $("#delete_certificate").click(()=>{

    request_approval()

    $(".confirm_group").show();
   $("#delete_certificate").hide();

    
  })

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

  function checkFilterFields() {
    let textField = 0;

  
    if ($("#select_crop").val() == 0) {
      textField = textField + 1;
      $("#warning_crop").show();
    }
    if ($("#select_variety").val() == "not_selected") {
      textField = textField + 1;
      $("#warning_variety").show();
    }
    if ($("#select_class").val() == "not_selected") {
      textField = textField + 1;
      $("#warning_class").show();
    }
    if ($("#fromDateValue").val() == "") {
      textField = textField + 1;
      $("#warning_from").show();
    }
    if ($("#toDateValue").val() == "") {
      textField = textField + 1;
      $("#warning_to").show();
    }

    return textField;
  }

  function toCsv() {
   
    let cropValue = $("#select_crop").val();
    let varietyValue = $("#select_variety").val();
    let classValue = $("#select_class").val();
    let from = $("#fromDateValue").val();
    let to = $("#toDateValue").val();


   
    $("#cropValueHidden").val(cropValue);
    $("#varietyValueHidden").val(varietyValue);
    $("#classValueHidden").val(classValue);
    $("#from_hidden").val(from);
    $("#to_hidden").val(to);
    $("#filter").val("haghgd");
  }
});
