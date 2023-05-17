$(document).ready(() => {
  $(".warning_text").css("color", "red").hide();

  const loaded = "1";
  $(".warning_text").css("color", "red").hide();
  $(".hybrid_items").hide();

  $.post(
    "get_products.php",
    {
      loaded: loaded,
    },
    (data) => {
      $("#select_crop").html(data);
    }
  );

  $("#search_certificate").on("input", function () {
    var data = $("#quantity_result").val();

    var certificate_value = $("#search_certificate").val();
    var crop_value = $("#select_crop").val();
    var variety_value = $("#select_variety").val();
    var class_value = $("#select_class").val();

    $.post(
      "get_creditors.php",
      {
        certificate_value: certificate_value,
        data: data,
        crop_value: crop_value,
        variety_value: variety_value,
        class_value: class_value,
      },
      function (data) {
        $("#certificate").html(data);
      }
    );
  });

  //Get variety

  $("#select_crop").change(function () {
    var data = $("#select_crop").find(":selected");

    if (data.val() == "0") {
      alert("please select Crop ");
    } else {
      let crop_value = $("#select_crop").val();

      $.post(
        "get_products.php",
        {
          crop_value: crop_value,
        },
        (data) => {
          $("#select_variety").html(data);
        }
      );
    }
  });

  //get variety type

  $("#select_variety").change(() => {
    if ($("#select_variety").val() == "not_selected") {
      alert("Select Variety to continue");
    } else {
      $.post(
        "get_products.php",
        {
          variety_type: $("#select_variety").val(),
        },
        (data) => {
          $("#variety_type").html(data);

          let selectedCrop = $("#select_crop").val();

          if (selectedCrop == "CP001") {
            $("#select_class").html(
              ' <option value="0">Select class</option> <option value="certified">Certified</option> '
            );
          }

          if ($("#variety_type").val() == "hybrid") {
            $(".hybrid_items").show();
          } else if (
            $("#variety_type").val() == "-" ||
            $("#variety_type").val() == "opv"
          ) {
            $(".hybrid_items").hide();
          }
        }
      );
    }
  });

  $("#select_region").change(function () {
    var region_data = $("#select_region").find(":selected");
    if (region_data.val() == "0") {
    } else if (region_data.val() == "central") {
      $("#select_district").empty();
      var myOptions = [
        {
          text: "Select District",
          value: "0",
        },
        {
          text: "Dedza",
          value: "dedza",
        },
        {
          text: "Dowa",
          value: "dowa",
        },
        {
          text: "Kasungu",
          value: "kasungu",
        },
        {
          text: "Lilongwe",
          value: "lilongwe",
        },
        {
          text: "Mchinji",
          value: "mchinji",
        },
        {
          text: "Nkhotakota",
          value: "nkhotakota",
        },
        {
          text: "Ntcheu",
          value: "ntcheu",
        },
        {
          text: "Ntchisi",
          value: "ntchisi",
        },
        {
          text: "Salima",
          value: "salima",
        },
      ];

      $.each(myOptions, function (i, el) {
        $("#select_district").append(new Option(el.text, el.value));
      });
    } else if (region_data.val() == "northern") {
      $("#select_district").empty();
      var myOptions = [
        {
          text: "Select District",
          value: "0",
        },
        {
          text: "Chitipa",
          value: "chitipa",
        },
        {
          text: "Kalonga",
          value: "kalonga",
        },
        {
          text: "Likoma",
          value: "likoma",
        },
        {
          text: "Mzimba",
          value: "mzimba",
        },
        {
          text: "Mkhata Bay",
          value: "mchinji",
        },
        {
          text: "Rumphi",
          value: "rumphi",
        },
      ];

      $.each(myOptions, function (i, el) {
        $("#select_district").append(new Option(el.text, el.value));
      });
    } else if (region_data.val() == "southern") {
      $("#select_district").empty();
      var myOptions = [
        {
          text: "Select District",
          value: "0",
        },
        {
          text: "Balaka",
          value: "balaka",
        },
        {
          text: "Blantyre",
          value: "blantyre",
        },
        {
          text: "Chikwawa",
          value: "chikwawa",
        },
        {
          text: "Chiradzulu",
          value: "chiradzulu",
        },
        {
          text: "Machinga",
          value: "machinga",
        },
        {
          text: "Mulanje",
          value: "mulanje",
        },
        {
          text: "Mwanza",
          value: "mwanza",
        },
        {
          text: "Nsanje",
          value: "nsanje",
        },
        {
          text: "Thyolo",
          value: "thyolo",
        },
        {
          text: "Phalombe",
          value: "phalombe",
        },
        {
          text: "Zomba",
          value: "zomba",
        },
        {
          text: "Neno",
          value: "neno",
        },
      ];

      $.each(myOptions, function (i, el) {
        $("#select_district").append(new Option(el.text, el.value));
      });
    }
  });

  $("#update_farm_details").click(() => {
    request_approval(
      "Update farm details",
      $("#farm_id").val(),
      "Production",
      $("#request_id").val(),
      $("#user_name").val(),
      $("#user_name").val() + " requesting to update farm details for " + $("#grower_name").val()
    );
  });

  $("#check_code").val().click(()=>{

   check_if_approved($("#access_code").va(),$("#approvalId").val(),)
  })

  // function check_crop_and_variety() {
  //   alert($("#select_crop").val());
  // }

  function request_approval(
    actionName,
    action_id,
    depertment,
    request_id,
    requestedName,
    description
  ) {
    if ($("#approvalId").val() == "") {
      $("#approvalId").val(() => {
        const characters = "0123456789";
        let code = "APV";
        for (let i = 0; i < 8; i++) {
          code += characters.charAt(
            Math.floor(Math.random() * characters.length)
          );
        }
        return code;
      });

      let approvalId = $("#approvalId").val();

      $.post(
        "get_data.php",
        {
          updateStockInRequest: actionName,
          depertment: depertment,
          action_id: action_id,
          request_id: request_id,
          requestedName: requestedName,
          approvalId: approvalId,
          description: description,
        },
        function (data) {
          alert("Request sent to Admin. Enter approval code to continue...");
          return data;
        }
      );
    } else {
      alert("Request already sent. Enter conformation code to continue");
    }
  }

  function check_if_approved(

     accessCode, 
     approvalId  
     
  )     {

    if (accessCode =="") {
      alert("Please Enter given approval code before submitting!!");
    } else {
      $.post(
        "get_data.php",
        {
          checkApprovalCode: accessCode,
          approvalId: approvalId,
        },
        function (data) {
          if (data == "valid") {

            alert("code is valid");
            
          } else {
            alert("code is Invalid ");
          }
        }
      );
    }


  }

     

 
});
