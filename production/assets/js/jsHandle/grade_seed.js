$(document).ready(function () {
    $("#warning_assigned").css("color", "red").hide();

    $("#assign_seed").click(()=>{

        let prompt = confirm("Are you sure ?");

        if(prompt=true){

            
            if($("#assign_quantity").val()==0){

                alert("Please enter seed quantity !!");
                $("#warning_assigned").show();
                
            }
            else{     

                  seedData = [$("#stock_in_id").val(),$("#assign_quantity").val()];

                $.post(
                    "get_products.php",
                    {
                     assignSeed:seedData,
                    },
                    (data) => {
                     alert(data);
                    }
                  );




            }


        }



    });


});