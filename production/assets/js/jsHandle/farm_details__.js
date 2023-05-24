$(document).ready(() => {
  $(".warning_text").css("color", "red").hide();
  const loaded = "1";
  $(".warning_text").css("color", "red").hide();
  $(".hybrid_items").show();

  // set selected for items

  // set selected for class
  options = $("#select_class").find("option");
  set_selected_data("#select_class", options, $("#class").val(), "class");

  // set selected for land history

  options = $("#pre_select_crop").find("option");
  set_selected_data(
    "#pre_select_crop",
    options,
    $("#land_history_previous_year").val(),
    "land_history"
  );

  options = $("#other_select_crop").find("option");
  set_selected_data(
    "#other_select_crop",
    options,
    $("#land_history_other_year").val(),
    "land_history"
  );

  //  set selected for region and district

  options = $("#select_region").find("option");
  set_selected_data(
    "#select_region",
    options,
    $("#selected_region").val(),
    "region"
  );

  //  options = $("#pre_select_crop").find("option");
  //  set_selected_data(
  //    "#pre_select_crop",
  //    options,
  //    $("#land_history_previous_year").val(),
  //    "land_history"
  //  );

  $.post(
    "get_products.php",
    {
      loaded: loaded,
    },
    (data) => {
      $("#select_crop").html(data);
      let options = $("#select_crop").find("option");
      set_selected_data("#select_crop", options, $("#crop").val(), "crop");
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

          let options = $("#select_variety").find("option");
          set_selected_data(
            "#select_variety",
            options,
            $("#variety").val(),
            "crop"
          );

          $(".single_cross_items").show();
          $(".inbred_items").show();
        }
      );
    }
  });

  //get variety type

  // function check_crop_and_variety() {
  //   alert($("#select_crop").val());
  // }

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
          } else {
            $("#select_class").html(
              ' <option value="0">Select class</option> <option value="pre_basic">Pre-Basic</option><option value="basic">Basic</option><option value="certified">Certified</option> '
            );
          }

          if ($("#variety_type").val() == "hybrid") {
            $(".hybrid_items").show();
          } else if (
            $("#variety_type").val() == "-" ||
            $("#variety_type").val() == "opv"
          ) {
            $(".hybrid_items").hide();
            $(".single_cross_items").show();
            $(".inbred_items").show();
          }
        }
      );
    }
  });

  $("#seed_breeding").change(() => {
    if ($("#seed_breeding").val() == "single_cross") {
      $(".single_cross_items").hide();
      $(".inbred_items").show();
    } else if ($("#seed_breeding").val() == "inbred") {
      $(".single_cross_items").show();
      $(".inbred_items").hide();
    }
  });

  $("#select_region").change(() => {
    var region_data = $("#select_region").find(":selected");
    get_districts(region_data);
  });

  // function get all districts

  function get_districts(region_data) {
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
  }

  //  Action buttons
  //Request for approval button

  $("#update_farm_details").click(() => {
    let conformation = confirm("Are you sure ?");
    if (conformation == true) {
      request_approval(
        "Update farm details",
        $("#farm_id").val(),
        "Production",
        $("#request_id").val(),
        $("#user_name").val(),
        $("#user_name").val() +
          " requesting to update farm details for " +
          $("#grower_name").val()
      );
    }
  });

  // check approval code button
  $("#checkCode").click(() => {
    check_if_approved($("#accessCode").val(), $("#approvalId").val());
  });

  //  validate form data function

  function validateCertificateData(seedBreedingType) {
    let emptyFields = 0;

    if (seedBreedingType == "single_cross") {
      if (
        $("#main_certificate").val() == "no_certificate_selected" ||
        $("#main_certificate").val() == "not_selected"
      ) {
        $("#warning_main_certificate").show();
        emptyFields = emptyFields + 1;
      }

      if ($("#main_quantity").val() == 0) {
        $("#warning_main_quantity").show();
        emptyFields = emptyFields + 1;
      }
      return emptyFields;
    } else if (seedBreedingType == "inbred") {
      if (
        $("#male_certificate").val() == "no_certificate_selected" ||
        $("#male_certificate").val() == "not_selected"
      ) {
        $("#warning_male_certificate").show();
        emptyFields = emptyFields + 1;
      }

      if ($("#male_quantity").val() == 0) {
        $("#warning_male_quantity").show();
        emptyFields = emptyFields + 1;
      }

      if (
        $("#female_certificate").val() == "no_certificate_selected" ||
        $("#female_certificate").val() == "not_selected"
      ) {
        $("#warning_female_certificate").show();
        emptyFields = emptyFields + 1;
      }

      if ($("#female_quantity").val() == 0) {
        $("#warning_female_quantity").show();
        emptyFields = emptyFields + 1;
      }
      return emptyFields;
    }
  }

  function checkTextAllfield() {
    let emptyFields = 0;
    if (
      $("#grower_search_result").val() == "" ||
      $("#grower_search_result").val() == "0"
    ) {
      $("#warning_select_creditor").show();
      emptyFields = emptyFields + 1;
    }
    if ($("#select_crop").val() == "0") {
      $("#warning_crop").show();
      emptyFields = emptyFields + 1;
    }
    if (
      $("#select_variety").val() == "variety_not_selected" ||
      $("#select_variety").val() == "not_selected"
    ) {
      $("#warning_variety").show();
      emptyFields = emptyFields + 1;
    }
    if ($("#select_class").val() == "0") {
      $("#warning_class").show();
      emptyFields = emptyFields + 1;
    }

    if ($("#hectors").val() == 0) {
      $("#warning_hectors").show();
      emptyFields = emptyFields + 1;
    }

    if ($("#variety_type").val() == "-" || $("#variety_type").val() == "opv") {
      if (
        $("#main_certificate").val() == "no_certificate_selected" ||
        $("#main_certificate").val() == "not_selected"
      ) {
        $("#warning_main_certificate").show();
        emptyFields = emptyFields + 1;
      }

      // if ($("#main_quantity").val() == 0) {
      //   $("#warning_certificate_quantity").show();
      //   emptyFields = emptyFields + 1;
      // }
    }

    if ($("#pre_select_crop").val() == "0") {
      $("#warning_pre_year").show();
      emptyFields = emptyFields + 1;
    }

    if ($("#other_select_crop").val() == "0") {
      $("#warning_other_pre_year").show();
      emptyFields = emptyFields + 1;
    }

    if ($("#select_region").val() == "0") {
      $("#warning_region").show();
      emptyFields = emptyFields + 1;
    }

    if ($("#select_district").val() == "0") {
      $("#warning_district").show();
      emptyFields = emptyFields + 1;
    }

    if ($("#epa").val() == "") {
      $("#warning_epa").show();
      emptyFields = emptyFields + 1;
    }

    if ($("#area_name").val() == 0) {
      $("#warning_area_name").show();
      emptyFields = emptyFields + 1;
    }

    if ($("#address").val() == 0) {
      $("#warning_address").show();
      emptyFields = emptyFields + 1;
    }

    if ($("#physical_address").val() == 0) {
      $("#warning_physical_address").show();
      emptyFields = emptyFields + 1;
    }

    return emptyFields;
  }

  // Get registered certificates

  $("#search_main_certificate").on("input", function () {
    var main_certificate_value = $("#search_main_certificate").val();
    var main_quantity_value = $("#main_quantity").val();
    var crop_value = $("#select_crop").val();
    var variety_value = $("#select_variety").val();
    var class_result = $("#select_class").val();

    if (class_result == "certified") {
      var class_value = "basic";
    } else if (class_result == "basic") {
      var class_value = "pre_basic";
    }
    $.post(
      "farm_get_certificate.php",
      {
        main_certificate_value: main_certificate_value,
        main_quantity_value: main_quantity_value,
        crop_value: crop_value,
        variety_value: variety_value,
        class_value: class_value,
      },
      function (data) {
        $("#main_certificate").html(data);
      }
    );
  });

  // retriving male certificate data for hybrid maize

  $("#search_male_certificate").on("input", function () {
    /*var main_certificate_value = $('#search_male_certificate').val();
           var main_quantity_value = $('#male_quantity').val();
           var crop_value = $('#select_crop').val();
           var variety_value = $('#select_variety').val();


           $.post('farm_get_certificate.php',{male_certificate_value: male_certificate_value, male_quantity_value:
                                male_quantity_value, crop_value: crop_value, variety_value: variety_value},function(data){
                               $('#male_certificate').html(data);

                            });*/
    var male_quantity_value = $("#male_quantity").val();
    var crop_value = $("#select_crop").val();
    var variety_value = $("#select_variety").val();
    var male_certificate_value = $("#search_male_certificate").val();
    $.post(
      "farm_get_certificate.php",
      {
        male_certificate_value: male_certificate_value,
        crop_value: crop_value,
        variety_value: variety_value,
        male_quantity_value: male_quantity_value,
      },
      function (data) {
        $("#male_certificate").html(data);
      }
    );
  });

  // retriving female certificate data for hybrid maize

  $("#search_female_certificate").on("input", function () {
    var female_quantity_value = $("#female_quantity").val();
    var crop_value = $("#select_crop").val();
    var variety_value = $("#select_variety").val();
    var female_certificate_value = $("#search_female_certificate").val();
    $.post(
      "farm_get_certificate.php",
      {
        female_certificate_value: female_certificate_value,
        crop_value: crop_value,
        variety_value: variety_value,
        female_quantity_value: female_quantity_value,
      },
      function (data) {
        $("#female_certificate").html(data);
      }
    );
  });

  // Set selected for all selects options

  function set_selected_data(
    select_element,
    options,
    selected_value,
    select_type
  ) {
    // Loop through each option and do something
    options.each(function () {
      var value = $(this).val(); // Get the value of the option
      var text = $(this).text(); // Get the text of the option
      console.log("Value: " + value + ", Text: " + text);
    });

    var selectElement = $(select_element);

    selectElement.empty();
    $.each(options, function (index, option) {
      var optionElement = $("<option>")
        .val(option.value)
        .text(option.text)
        .appendTo(selectElement);
    });

    // Set a specific option as selected
    var selectedValue = selected_value;
    selectElement.val(selectedValue);

    if (select_type == "crop") {
      set_selected_variety();
    } else if (select_type == "region") {
      let region_data = $(select_element).find(":selected");
      get_districts(region_data);
      options = $("#select_district").find("option");
      set_selected_data(
        "#select_district",
        options,
        $("#selected_district").val(),
        "district"
      );
    }
  }

  // Change variety on set selected

  function set_selected_variety() {
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

          let options = $("#select_variety").find("option");
          set_selected_data(
            "#select_variety",
            options,
            $("#variety").val(),
            "variety"
          );

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
      );
    }
  }

  // Request for approval function
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

  function check_if_approved(accessCode, approvalId) {
    if (accessCode == "") {
      alert("Please Enter given approval code before submitting!!");
    } else {
      $.post(
        "get_data.php",
        {
          checkApprovalCode: accessCode,
          approvalId: approvalId,
        },
        function (data) {
          farm_data = [
            $("#farm_id").val(),
            $("#select_crop").val(),
            $("#select_variety").val(),
            $("#select_class").val(),
            $("#hectors").val(),
            $("#main_certificate").val(),
            $("#main_quantity").val(),
            $("#male_certificate").val(),
            $("#male_quantity").val(),
            $("#female_certificate").val(),
            $("#female_quantity").val(),
            $("#pre_select_crop").val(),
            $("#other_select_crop").val(),
            $("#select_region").val(),
            $("#select_district").val(),
            $("#epa").val(),
            $("#area_name").val(),
            $("#address").val(),
            $("#physical_address").val(),
            $("#user").val(),
            "-",
            $("#old_certificate").val(),
            $("#old_certificate_quantity").val(),
            $("#old_male_certificate").val(),
            $("#old_male_quantity").val(),
            $("#old_female_certificate").val(),
            $("#old_female_quantity").val(),
            $("#view_breeding_type").val(),
          ];

          if (data == "valid") {
            if (
              $("#variety_type").val() == "-" ||
              $("#variety_type").val() == "opv"
            ) {
              (farm_data[7] = "-"),
                (farm_data[8] = "-"),
                (farm_data[9] = "-"),
                (farm_data[10] = "-");
            } else if ($("#variety_type").val() == "hybrid") {
              if ($("#seed_breeding").val() == "not_selected") {
                alert("Please select breeding type");
              } else if ($("#seed_breeding").val() == "inbred") {
                (farm_data[5] = "-"),
                  (farm_data[6] = "-"),
                  (farm_data[7] = $("#male_certificate").val()),
                  (farm_data[8] = $("#male_quantity").val()),
                  (farm_data[9] = $("#female_certificate").val()),
                  ((farm_data[10] = $("#female_quantity").val()),
                  (farm_data[20] = "hybrid_inbred"));

                // validateCertificateData("inbred");
              } else if ($("#seed_breeding").val() == "single_cross") {
                (farm_data[5] = $("#main_certificate").val()),
                  (farm_data[6] = $("#main_quantity").val()),
                  (farm_data[7] = "-"),
                  (farm_data[8] = "-"),
                  (farm_data[9] = "-"),
                  (farm_data[10] = "-");
                // validateCertificateData("single_cross");
              }
            }

            if (checkTextAllfield() > 0) {
              alert("Please fill out all required fields !!");
            } else if (validateCertificateData($("#seed_breeding").val())) {
              alert("Please fill out all required certificate fields !!");
            } else {
              $.post(
                "get_data.php",
                {
                  updateFarm: farm_data,
                },
                (data) => {
                  if (data == "updated") {
                    alert("Farm updated successfully");
                    window.location.reload();
                  } else {
                    alert("Error: something went wrong ");
                    window.location.reload();
                  }
                }
              );
            }
          } else {
            alert("code is Invalid ");
          }
        }
      );
    }
  }

  // delete farm request 
  $("#delete_request").click(() => {
    let conformation = confirm("Are you sure ? ");
    if (conformation == true) {
      request_approval(
        "Delete registered farm",
        $("#farm_id").val(),
        "Production",
        $("#request_id").val(),
        $("#user_name").val(),
        $("#user_name").val() +
          " is requesting to delete farm entry for " +
          $("#grower_name").val()
      );
      $("#delete_request").hide();
    }
  });
  

  $("#checkCodeDelete").click(()=>{

check_delete_approved($("#accessCodeDelete").val(),$("#approvalId").val())
 
  })


function check_delete_approved(accessCode, approvalId) {
  if (accessCode == "") {
    alert("Please Enter given approval code before submitting!!");
  } else { 

    $.post(
      "get_data.php",
      {
        checkApprovalCode: accessCode,
        approvalId: approvalId,
      },
      function (data) {

        let farm_data = [
          $("#farm_id").val(),
          $("#view_breeding_type").val(),
          $("#old_certificate").val(),
          $("#old_certificate_quantity").val(),
          $("#old_male_certificate").val(),
          $("#old_male_quantity").val(),
          $("#old_female_certificate").val(),
          $("#old_female_quantity").val(),
        ]
      
        if (data == "valid") {

          $.post(
            "get_data.php",
            {
              deleteFarm: farm_data
            },
            function (data) {

         
              if (data == "deleted") {
                alert("Farm deleted successfully");
                window.location.reload();
              } else {
                alert("Error: something went wrong ");
                window.location.reload();
              }
            }
          );
      
        }

        else{

          alert("The code you entered is invalid, check and try again ");


        }




      })

    
   

}

}
});
