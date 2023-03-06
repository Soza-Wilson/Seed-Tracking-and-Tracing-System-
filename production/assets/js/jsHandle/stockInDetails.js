$(document).ready(() => {

  $("#warning_text").css("color", "red").hide();


  //getting crop data

  const loaded = "1";

  $.post('get_products.php', {
    loaded: loaded

  }, data => {
    $('#select_crop').html(data);



  });

  $('#select_crop').change(function () {


    let crop_value = $('#select_crop').val();
    $("#warning_text").show();

    $.post('get_products.php', {
      crop_value: crop_value

    }, data => {
      $('#select_variety').html(data);



    });




  });




  $("#quantity").on("input",()=>{$("#warning_text").show()});

  // getting certificarte data
  $("#search_certificate").on("input", function () {


    var stockIn_quantity = $('#quantity').val();
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
    }, function (data) {
      $('#certificate').html(data);



    });

  });




  if ($("#seed_source").val() == "MUSECO") {

    $(".seed_details").hide();

  }


  // Approval request 
  $("#request_approval").click(() => {



    if ($("#approvalId").val() == "") {

      $("#approvalId").val(() => {

        const characters = "0123456789";
        let code = "APV";
        for (let i = 0; i < 8; i++) {
          code += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return code;
      });


      let approvalId = $("#approvalId").val();
      let actionName = "update_stock_in";
      let depertment = "production";
      let action_id = $("#stock_in_id").val();
      let request_id = $("#request_id").val();
      let requestedName = $("#user_name").val();
      let description = requestedName + " is requesting to update stock in details";




      $.post('get_data.php', {
        updateStockInRequest: actionName,
        depertment: depertment,
        action_id: action_id,
        request_id: request_id,
        requestedName: requestedName,
        approvalId: approvalId,
        description: description
      }, function (data) {

        alert("Request sent to Admin. Enter approval code to continue...");
        $('#approval_label').html(data);

      });

      function generateCode() {
        let code = "";
        const characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789()";
        for (let i = 0; i < 8; i++) {
          code += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return code;
      }




    }

    else { alert("Request already sent. Enter conformation code to continue") }






  });

  ///

  // Update stock In function



  //check if approved code is valid 

  $("#checkCode").click(() => {

    let accessCode = $("#accessCode").val();
    let approvalId = $("#approvalId").val();

    if (accessCode == "") {

      alert("Please insert given approval code before submitting!!")

    }
    else {


      $.post('get_data.php', {
        checkApprovalCode: accessCode,
        approvalId: approvalId,



      }, function (data) {

        if (data == "valid") {

          let crop = $("#crop").val();
          let variety = $("#variety").val();
          let seedClass = $("#class").val();
          let quantity = $("#quantity").val();
          let creditorId =$("#creditorId").val();
          let certificate = $("#seedCertificate").val();
          let description = $("#description").val();
          let seedReceiveNote = $("#srn").val();
          let stockInId =$("#stockInId").val();
          let binCardNumber =$("#bin_card").val();
          let bags = $("#number_of_bags").val();
          let dir = $("#image").val();
          
          if($("#image").val()==""){
               
            dir = $("#directory").val();

          }

          if ($("#select_variety").val() != "0") {

             crop = $("#select_crop").val();
             variety = $("#select_variety").val();
             seedClass = $("#select_class").val();
             certificate = $("#certificate").val();

          }

          $.post('get_data.php', {
            updateStockIn:crop,
            stockInId:stockInId,
            creditorId:creditorId,
            variety: variety,
            seedClass: seedClass,
            quantity: quantity,
            certificate: certificate,
            seedReceiveNote: seedReceiveNote,
            binCardNumber:binCardNumber,
            bags: bags,
            dir: dir,
            description: description
          }, function (data) {

            alert(data)


            // alert("Entry successfully updated");
            // window.location = "view_stock_in.php";


          });





        }
        else {

          alert("Code is Invalid. Check and add again ");

        }

      });




    }







  });





});