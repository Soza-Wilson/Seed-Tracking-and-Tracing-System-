$(document).ready(function () {
  $(".warning-text").css("color", "red").hide();

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
      $("#select_crop").val(),
      $("#select_variety").val(),
      $("#select_class").val(),
      $("#select_status").val(),
    ];

    if (checkFilterFields() > 0) {
      alert("Please fill out all required text fields ");
    } else {
      $.post(
        "get_data.php",
        {
          inventoryFilter: filterData,
        },
        (data) => {
          $("#dataTable").html(data);
        }
      );
    }
  });

  function checkFilterFields() {
    let textField = 0;

    if ($("#creditorName").val() == "") {
      textField = textField + 1;
      $("#warning_name").show();
    }
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
    if ($("#select_status").val() == "not_selected") {
      textField = textField + 1;
      $("#warning_status").show();
    }

    return textField;
  }
});
