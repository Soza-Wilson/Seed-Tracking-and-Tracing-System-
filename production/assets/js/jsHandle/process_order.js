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
    "get_data/order_data.php",
    {
      processOrder: orderData,
    },
    function (data) {
      const array = convert_string(data);

      // if (array[0] == "grower_order") {
      //   fetch("assets/JSON/dispatch_order_details.json")
      //     .then((response) => response.json())
      //     .then((data) => {
      //       const url = `../class/pdf_handler.php?order_ID=${data.order_id}&transaction_ID=${data.transaction_id}&total_quantity=${data.total_quantity}&type=${data.pdfType}`;
      //       window.open(url, "_blank", { data: data });
      //       go_back();
      //     })
      //     .catch((error) => {
      //       console.log(error);
      //     });
      // }

      const url = `../class/pdf_handler.php?order_ID=${array[1]}&transaction_ID=${array[2]}&total_quantity=${array[3]}&type=${array[4]}`;
      window.open(url, "_blank", { data: data });
      go_back();
    }
  );
};

const convert_string = (string) => {
  const data = string.split(",");
  return data;
};

const back = () => {
  setTimeout(() => {
    history.back();
  }, 1000);
};

const openTab = () => {
  window.open("https://www.w3schools.com");
};
