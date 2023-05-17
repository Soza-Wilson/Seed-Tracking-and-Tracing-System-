$(document).ready(function () {
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

  $("#grower_search").on("input", function () {
    var grower_search_value = $("#grower_search").val();
    $.post(
      "farm_get_certificate.php",
      {
        grower_search_value: grower_search_value,
      },
      function (data) {
        $("#grower_search_result").html(data);
      }
    );

    /* 
           

        
    

         var select = $('#creditor_source').find(':selected');
            var data = select.val();
            $.post('get_creditors.php',{data: data, result_value: result_value},function(data){
            $('#search_result').html(data);
        
        */
  });

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

  //js code for crop details

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
          } else if($("#variety_type").val() == "-" || $("#variety_type").val() == "opv"){
            $(".hybrid_items").hide();
          }
        }
      );
    }
  });

  //js coede for retriving or required certificates (main, male and femaile certificates)

  //js code for retriving location details

  //js code for adding farm location

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
  //// js code checking to retrive right certificate

  //retriving main certificate data

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

  $("#seed_breeding").change(() => {
    if ($("#seed_breeding").val() == "single_cross") {
      $(".single_cross_items").hide();
      $(".inbred_items").show();
    } else if ($("#seed_breeding").val() == "inbred") {
      $(".single_cross_items").show();
      $(".inbred_items").hide();
    }
  });

  $("#save_farm").click(() => {
    let conformation = confirm("Are you sure");
    if (conformation == true) {
      register_farm();
    }
  });

  // velify user data
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

    if($("#variety_type").val()=="-"||$("#variety_type").val()=="opv"){

      if (
      $("#main_certificate").val() == "no_certificate_selected" ||
      $("#main_certificate").val() == "not_selected"
    ) {
      $("#warning_main_certificate").show();
      emptyFields = emptyFields + 1;
    }

    if ($("#main_quantity").val() == 0) {
      $("#warning_certificate_quantity").show();
      emptyFields = emptyFields + 1;
    }



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


  ///removing warning texts for empty fields 






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

  function register_farm() {
    farm_data = [
      $("#grower_search_result").val(),
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
      "-"
    ];

    if ($("#variety_type").val() == "-" || $("#variety_type").val() == "opv") {
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
          (farm_data[10] = $("#female_quantity").val(),
          farm_data[20]="hybrid_inbred");

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
          registerFarm: farm_data,
        },
        (data) => {
          if(data=="added"){

            alert("Registered");
            window.location.reload();
          }

          else{

            alert("Error: something went wrong ");
            window.location.reload();


          }
        }
      );
    }
  }
});
