$(document).ready(() => {
  $("#approve_order").click(() => {
    aprrove_order($("#order_id").val(), "approve");
  });

  $("#deny_order").click(() => {
    aprrove_order($("#order_id").val(), "deny");
  });
});
const aprrove_order = (order_id, action) => {
  let conformation = confirm("Are you sure ?");

  if (conformation == true) {
    let data = [order_id, action];

    $.post(
      "get_data.php",
      {
        approveOrder: data,
      },
      (data) => {
        alert(data);
      }
    );
  }
};
