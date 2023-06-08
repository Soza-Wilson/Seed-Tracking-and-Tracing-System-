$(document).ready(() => {

    // var data_value = "admin_stock_out_chart";
    Stock_bar_chart();
    stock_pie_chart();
    seed_stock();
    // $.post('', {
    //     admin_stock_out_value : data_value;
    // }, function(data) {
    //     $('#stock_out_chart').html(data);





    // });




    // $('#get_data').click(() => {




    //     let fromDateValue = $('#fromDateValue').val();
    //     let toDateValue = $('#toDateValue').val();
    //     let typeValue = $('#typeValue').val();
    //     let bankAccount = $('#select_bank_name').val();


    //     $.post('../finance/get_creditors.php', {
    //         fromDateValue: fromDateValue,
    //         toDateValue: toDateValue,
    //         typeValue: typeValue,
    //         bankAccount: bankAccount   
    //     }, data => {
    //         $('#ledger_table').html(data);

    //     });


    // });




    var data_value = "bank";

    $.post('../finance/get_creditors.php', {
        data_value: data_value
    }, function(data) {
        $('#select_bank_name').html(data);


    });


});


function Stock_bar_chart() {


    const labels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
    ];

    const data = {
        labels: labels,
        datasets: [{
            label: 'Stock out Quantity For 2022',
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)',
                'rgba(45, 189, 79, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)',

            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)',
                'rgb(45, 189, 79,)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)',

            ],
            borderWidth: 1,

            data: [32, 10, 5, 2, 20, 30, 30, 5, 10, 5, 2, 20, 3, 45],
        }]
    };

    const config = {
        type: 'line',
        data: data,
    };
    const myChart = new Chart(
        document.getElementById('stock_out_chart'),
        config
    );

}


function stock_pie_chart() {



    const data = {
        labels: [
            'Certified',
            'Uprocessed',
            'Uncertified'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [300, 50, 100],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    const config = {
        type: 'doughnut',
        data: data,
    };

    const myChart = new Chart(
        document.getElementById('inventory_chart'),
        config
    );



}


function seed_stock() {



//     <?php

//     $sql = "SELECT crop.crop_ID,crop.crop, SUM(stock_in.quantity) AS quantity FROM stock_in
// INNER JOIN crop ON crop.crop_ID = stock_in.crop_ID GROUP BY crop.crop_ID";
//     $result = mysqli_query($con, $sql);

//     $result = $con->query($sql);
//     foreach ($result as $row) {
//         $day[] = $row['crop'];
//         $amount[] = $row['quantity'];
//     }


//     ?>





//     const data = {
//         labels: <?php echo json_encode($day) ?>,
//         datasets: [{
//             label: 'Stock out Quantity For 2022',
//             backgroundColor: [
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(255, 159, 64, 0.2)',
//                 'rgba(255, 205, 86, 0.2)',
//                 'rgba(75, 192, 192, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(153, 102, 255, 0.2)',
//                 'rgba(201, 203, 207, 0.2)',
//                 'rgba(45, 189, 79, 0.2)',
//                 'rgba(255, 159, 64, 0.2)',
//                 'rgba(255, 205, 86, 0.2)',
//                 'rgba(75, 192, 192, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(153, 102, 255, 0.2)',
//                 'rgba(201, 203, 207, 0.2)',

//             ],
//             borderColor: [
//                 'rgb(255, 99, 132)',
//                 'rgb(255, 159, 64)',
//                 'rgb(255, 205, 86)',
//                 'rgb(75, 192, 192)',
//                 'rgb(54, 162, 235)',
//                 'rgb(153, 102, 255)',
//                 'rgb(201, 203, 207)',
//                 'rgb(45, 189, 79,)',
//                 'rgb(255, 159, 64)',
//                 'rgb(255, 205, 86)',
//                 'rgb(75, 192, 192)',
//                 'rgb(54, 162, 235)',
//                 'rgb(153, 102, 255)',
//                 'rgb(201, 203, 207)',

//             ],
//             borderWidth: 1,

//             data: <?php echo json_encode($amount) ?>,
//         }]
//     };

//     const config = {
//         type: 'bar',
//         data: data,
//         options: {
//             scales: {
//                 y: {
//                     beginAtZero: true
//                 }
//             }
//         },
//     };
//     const myChart = new Chart(
//         document.getElementById('seed_stock'),
//         config
//     );



}
