$(document).ready(function() {

    const loaded = "1";

$.post('get_products.php', {
loaded: loaded

}, data => {
$('#select_crop').html(data);



});


    $("#creditor_search").on("input", function() {

        var data = $('#creditor_source').find(':selected');

        if (data.val() == "source_not_selected") {

            alert("please select source first ");
        } else {

            var result_value = $('#creditor_search').val();
            var select = $('#creditor_source').find(':selected');
            var data = select.val();
            $.post('get_creditors.php', {
                data: data,
                result_value: result_value
            }, function(data) {
                $('#search_result').html(data);

            })
        }




    });



    $("#farm_search").on("input", function() {

        var farm_value = $('#farm_search').val();
        var grower_value = $('#search_result').find(':selected');
        var grower_data = grower_value.val();

        $.post('get_creditors.php', {
            farm_value: farm_value,
            grower_data: grower_data
        }, function(data) {
            $('#search_farm_result').html(data);





        })

    });


    $("#search_certificate").on("input", function() {


        var stockIn_quantity = $('#external_quantity').val();
        var stockIn_certificate = $('#search_certificate').val();
        var crop_value = $('#select_crop').val();
        var variety_value = $('#select_variety').val();
        var class_value = $('#select_class').val();


       



        $.post('get_creditors.php', {
            stockIn_certificate: stockIn_certificate,
            stockIn_quantity: stockIn_quantity,
            crop_value: crop_value,
            variety_value: variety_value,
            class_value: class_value
        }, function(data) {
            $('#certificate').html(data);



        });

    });

    $('#select_crop').change(function() {

       
        let crop_value = $('#select_crop').val();
       
       $.post('get_products.php', {
           crop_value: crop_value
          
       }, data => {
           $('#select_variety').html(data);



       });




    });


    $('#creditor_source').change(function() {


        var data = $('#creditor_source').find(':selected');

        if (data.val() == "source_not_selected") {
            alert("please select source ");
        } else if (data.val() == "MUSECO") {

            document.getElementById('creditor_name').readOnly = true;
            document.getElementById('creditor_email').readOnly = true;
            document.getElementById('creditor_phone').readOnly = true;
            document.getElementById('creditor_description').readOnly = true;

            var search_value = data.val();

            $.post('get_creditors.php', {
                search_value: search_value,
                data: data
            }, function(data) {

                $('#search_result').html(data);

            })

        } else if (data.val() == "External") {

            document.getElementById('creditor_name').readOnly = false;
            document.getElementById('creditor_email').readOnly = false;
            document.getElementById('creditor_phone').readOnly = false;
            document.getElementById('creditor_description').readOnly = false;

        }

    });




    $('#search_farm_result').change(function() {

        var data = $('#search_farm_result').find(':selected');
        var search_farm_result = data.val();

        $.post('get_creditors.php', {
            search_farm_result: search_farm_result
        }, function(data) {



            fetch("farm_data.json")

                .then(response => response.json())
                .then(data => {

                    $('#farm_crop').empty();
                    $('#farm_crop').append(new Option(data.crop, data.crop_id));

                    $('#farm_variety').empty();
                    $('#farm_variety').append(new Option(data.variety, data.variety_id));
                    $('#farm_class').empty();
                    $('#farm_class').append(new Option(data.farm_class, data.farm_class));

                    $('#farm_physical_address').empty();

                    $('#farm_physical_address').val(data.address);

                })





            // $('#farm_crop').html(data)


            // $('#farm_crop').empty();
            // $('#farm_crop').append(new Option(crop, crop_id));


            // $('#farm_variety').empty();
            // $('#farm_variety').append(new Option(variety, variety_id));
            // $('#farm_class').empty();
            // $('#farm_class').append(new Option(class_value, class_value));

            // $('#farm_physical_address').empty();

            // ('#farm_physical_address').append(new text("working"));

        })








    });



});