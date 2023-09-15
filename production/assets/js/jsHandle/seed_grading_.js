$(document).ready(function () {
  $("#warning_assigned").css("color", "red").hide();

  $("#assign_seed").click(() => {
    let prompt = confirm("Are you sure ?");

    if (prompt == true) {
      if ($("#assign_quantity").val() == 0) {
        alert("Please enter seed quantity !!");
        $("#warning_assigned").show();
      } else {
        assignForProcessing(
          $("#stock_in_id").val(),
          $("#assign_quantity").val(),
          $("#user").val()
        );
      }
    }
  });
});


// cheching if assigned seed is procceding available seed in inventory
const assignForProcessing = (stockInId, quantity, user) => {
  $.post(
    "get_data.php",
    {
      assignForProcessing: [stockInId, quantity, user],
    },
    (data) => {
      if (data == "quantity_exceeded") {
        alert("Quantity assigned is exceeding available quantity ");
      } else {
        alert(data);
         //openPdf(data);
      }
    }
  );
};


const openPdf  = data =>{

  const url = `../class/pdf_handler.php?grade_id=${data} & type=${"handover"}`;
  window.open(url, "_blank" ,{ data: data });
  setTimeout(() => {
    history.back();
  }, 1000);


}