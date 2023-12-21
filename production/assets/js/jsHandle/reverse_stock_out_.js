$(document).ready(function () {
  $("#confirm_btn").click(() => {
    send_reverse_data();
  });

  const send_reverse_data = () => {
    const data = [
      $("#item_id").val(),
      $("#item_quantity").val(),
      $("#stock_in_id").val(),
      $("#stock_out_id").val(),
    ];

  

    $.post(
      "get_data/stock_out_data.php",
      {
        reverse_stock_out: data,
      },
      (data) => {
        history.back();
      }
    );
  };
});
