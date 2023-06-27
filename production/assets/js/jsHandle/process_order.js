$(document).ready(() => {
  $("#print_dispatch").click(() => {
    processOrder("print");

    //window.open("www.youtube.com");
    // window.location = "stock_out.php";
  });
});

const processOrder = (buttonType) => {
  orderData = [
    $("#order_id").val(),
    $("#c_d_id").val(),
    $("#type").val(),
    buttonType,
    $("#user_id").val(),
  ];

  $.post(
    "get_data.php",
    {
      processOrder: orderData,
    },
    function (data) {
      //alert(data);

      fetch("assets/JSON/dispatch_order_details.json")
        .then((response) => response.json())
        .then((data) => {
          const url = `../class/pdf_handler.php?order_ID=${data.order_id}&transaction_ID=${data.transaction_id}&total_quantity=${data.total_quantity}&type=${data.pdfType}`;
          window.open(url, "_blank", { data: data });
          setTimeout(() => {
            history.back();
          }, 1000);
        })
        .catch((error) => {
          console.log(error);
        });
    }
  );
};

const openTab = () => {
  window.open("https://www.w3schools.com");
};
