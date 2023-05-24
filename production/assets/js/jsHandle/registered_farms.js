$(document).ready(function () {
  const loaded = "1";
  $(".warning-text").css("color", "red").hide();

  $.post(
    "get_products.php",
    {
      loaded: loaded,
    },
    (data) => {
      $("#select_crop").html(data);
    }
  );

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

  //    Filter by grower name

  $("#creditorName").on("input", () => {
    $.post(
      "get_data.php",
      {
        farm_filter_by_grower: $("#creditorName").val(),
      },
      function (data) {
        $("#dataTable").html(data);
        toCsv("grower_filter");
      }
    );
  });

  //    Filter by Crop details

  $("#get_crop_data").click(()=>{

  let crop_details = [
    $("#select_crop").val(),
    $("#select_variety").val(),
    $("#select_class").val(),
  ];
  $.post(
    "get_data.php",
    {
      farm_filter_by_crop: crop_details,
    },
    function (data) {
      $("#dataTable").html(data);
      toCsv("crop_filter");
    }
  );



});

$("#select_district").change(()=>{

    let location_details = [
        $("#select_region").val(),
        $("#select_district").val(),
       
      ]; 

      $.post(
        "get_data.php",
        {
          farm_filter_by_location: location_details,
        },
        function (data) {

          
        $("#dataTable").html(data);
        toCsv("location_filter");
     
        }
      );

    
})



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

  function toCsv(type) {

    let creditor = $("#creditorName").val();
    let cropValue = $("#select_crop").val();
    let varietyValue = $("#select_variety").val();
    let classValue = $("#select_class").val();
    let region = $("#select_region").val();
    let district = $("#select_district").val();
    let filter_type =type;

    $("#creditor_hidden").val(creditor);
    $("#cropValueHidden").val(cropValue);
    $("#varietyValueHidden").val(varietyValue);
    $("#classValueHidden").val(classValue);
    $("#region_hidden").val(region);
    $("#district_hidden").val(district);
    $("#filter").val(filter_type);
  }
    
  
});
