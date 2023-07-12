$(document).ready(() => {
  $(".warning-text").css("color", "red").hide();
  $("#creditorName").on("input", () => {
    getStockInIds($("#creditorName").val());
  });
  $("filterSeed").click(() => {
    filterAssignedSeed();
  });
});

const filterAssignedSeed = (growerName, stockInId, fromDate, toDate) => {
  let seedData = [growerName, stockInId, fromDate, toDate];
  $.post(
    "get_data.php",
    {
      filterHandoOverData: seedData,
    },
    (data) => {
      alert(data);
    }
  );
};

const getStockInIds = (growerName) => {
  $.post(
    "get_data.php",
    {
      getStockInId: growerName,
    },
    (data) => {
      $("#stock_in_id").html(data)
    }
  );
};
