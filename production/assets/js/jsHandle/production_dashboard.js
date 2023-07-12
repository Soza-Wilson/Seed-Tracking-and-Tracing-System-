$(document).ready(() => {
  getInvatory();
  getStockIn();
  getStockOut();
  inventoryChart();
});

const inventoryChart = () => {
  let lebels = [];

  $.post(
    "get_data.php",
    {
      dashboardInventoryChart: "",
    },
    function (data) {
     
      lebels = data;
    }
  );

  const data = {
    labels: lebels,
    datasets: [
      {
        label: "My First Dataset",
        data: [2, 10, 5],
        backgroundColor: [
          "rgb(90,171, 77)",
          "rgb(54, 162, 235)",
          "rgb(255, 205, 86)",
        ],
        hoverOffset: 4,
      },
    ],
  };

  const config = {
    type: "doughnut",
    data: data,
  };

  const myChart = new Chart(document.getElementById("inventory_chart"), config);
};

function stock_pie_chart() {
  // <?php
  // $sql = "SELECT stock_in.status, SUM(stock_in.available_quantity) AS quantity FROM stock_in INNER JOIN crop ON crop.crop_ID = stock_in.crop_ID GROUP BY stock_in.status;";
  // $result = mysqli_query($con, $sql);
  // $result = $con->query($sql);
  // foreach ($result as $row) {
  //     $labels[] = $row['status'];
  //     $amount[] = $row['quantity'];
  // }
  // ?>
}

// const data = {
//     labels: data,
//     datasets: [{
//         label: 'My First Dataset',
//         data:data,
//         backgroundColor: [
//             'rgb(90,171, 77)',
//             'rgb(54, 162, 235)',
//             'rgb(255, 205, 86)'
//         ],
//         hoverOffset: 4
//     }]
// };

// const config = {
//     type: 'doughnut',
//     data: data,
// };

// const myChart = new Chart(
//     document.getElementById('inventory_chart'),
//     config
// );

//  getting block data
const getInvatory = () => {
  $.post(
    "get_data.php",
    {
      get_inventory: "",
    },
    function (data) {
      $("#block_inventory").html(data);
    }
  );
};

const getStockIn = () => {
  $.post(
    "get_data.php",
    {
      get_stock_in: "",
    },
    function (data) {
      $("#block_stock_in").html(data);
    }
  );
};

const getStockOut = () => {
  $.post(
    "get_data.php",
    {
      get_stock_out: "",
    },
    function (data) {
      $("#block_stock_out").html(data);
    }
  );
};
