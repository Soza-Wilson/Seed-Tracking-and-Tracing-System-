$(document).ready(function () {
  $("#assign").click(async () => {
    if (confirm("Are you sure ?")) {
      certify_seed();
    }
  });

  const certify_seed = async () => {
    let status = await get_stock_in_status();
    const data = {
      lot_number: $("#lot_number").val(),
      quantity: $("#quantity").val(),
      stock_in_id: $("#stock_in_id").val(),
      test_id: $("#test_id").val(),
      stock_in_status: status,
    };

    $.post(
      "get_data/lab_test_data.php",
      {
        certify_seed_data: data,
      },
      (data) => {
        data == "updated"
          ? [alert("seed_certified"), (window.location = "active_test.php")]
          : alert("Error certifying seed ");
      }
    );
  };

  const get_stock_in_status = async () => {
    let status = "";
    await $.post(
      "get_data/lab_test_data.php",
      {
        get_stock_in_status: $("#stock_in_id").val(),
      },
      (data) => {
        let values = data.split("_");
        if (values[0] == "partly") {
          status = values[0] + "_certified";
        } else {
          status = "certified";
        }
      }
    );
    return status;
  };
});
