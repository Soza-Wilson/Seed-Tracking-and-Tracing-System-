$(document).ready(() => {
  $("#generate_pdf").click(() => {
    const url =
      "../class/pdf_handler.php? lot_number=" +
      $("#lot_number").find(":selected").val() +
      "";
    window.open(url, "_blank"), go_back();
  });

  const go_back = () => {
    setTimeout(() => {
      history.back();
    }, 0);
  };
});
