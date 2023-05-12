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

          if ($("#variety_type").val() == "hybrid") {
            $(".hybrid_items").show();
          }
          else{

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
  $("#save_farm").click(() => {
    //let validateValue = checkTextfield();

    // if (validateValue > 0) {
    //   alert("Please fill out all required fileds !!");
    //   register_farm();
    // }

    register_farm()
  });

  // velify user data
  function checkTextfield() {
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

  function register_farm() {
  
    let main_certificate = $("#main_certificate").val();
    let main_quantinty =  $("#main_quantity").val();
    let male_certificate =  $("#male_certificate").val();
    let male_quantity= $("#male_quantity").val();
    let female_certificate= $("#female_certificate").val();
    let female_quantity= $("#female_quantity").val();
  


    if ($("#variety_type").val() == "-" || $("#variety_type").val() == "opv") {
      hybrid_data = {
        male_certificate: "-",
        male_quantity: "-",
        female_certificate: "-",
        female_quantity: "-",
      };
    } else if ($("#variety_type").val() == "hybrid") {

      if($("#seed_breeding").val()=="not_selected"){

        alert("Please select breeding type")
      }
      else if(($("#seed_breeding").val()=="inbred")){

        male_certificate= $("#male_certificate").val(),
        male_quantity= $("#male_quantity").val(),
        female_certificate= $("#female_certificate").val(),
        female_quantity= $("#female_quantity").val()  

        male_certificate= "-",
        male_quantity= "-"
      
      }

      else if(($("#seed_breeding").val()=="single_cross")){

        main_certificate= $("#main_certificate").val(),
        main_quantinty= $("#main_quantity").val(),

        male_certificate= "-",
        male_quantity= "-",
        female_certificate="-",
        female_quantity= "-"  


      }
         
         
    }

    farm_data = [
      $("#grower_search_result").val(),
      $("#select_crop").val(),
      $("#select_variety").val(),
      $("#select_class").val(),
      $("#hectors").val(),
      main_certificate,
      main_quantity,
      male_certificate,
      male_quantity,
      female_certificate,
      female_quantity,
      $("#pre_select_crop").val(),
      $("#other_select_crop").val(),
      $("#select_region").val(),
      $("#select_district").val(),
      $("#epa").val(),
      $("#area_name").val(),
      $("#address").val(),
      $("#physical_address").val(),
    ];
   
    alert(farm_data[6]);

    $.post(
      "get_creditors.php",
      {
        registerFarm: farm_data,
      },
      function (data) {
        
      }
    );
  }
});
