$(document).ready(() => {
 

  $("#quantity").on("input", function () {
    var quantity = $("#quantity").val();
    var price_per_kg = $("#quantity").val();
    var total = result * price_per_kg;

    alert(total);
    // Print entered value in a div box
    //$("#result").text($(this).val());
  });

  const loaded = "1";

  $.post(
    "../production/get_products.php",
    {
      loaded: loaded,
    },
    (data) => {
      $("#select_crop").html(data);
    }
  );

  $("#select_crop").change(() => {
    let data = $("#select_crop").find(":selected");

    if (data.val() == "0") {
      alert("please select Crop ");
    } else {
      let crop_value = $("#select_crop").val();

      $.post(
        "../production/get_products.php",
        {
          crop_value: crop_value,
        },
        (data) => {
          $("#select_variety").html(data);
          priceForMaize();
        }
      );
    }
  });

  $("#select_variety").change(() => {
    let crop_value = $("#select_crop").val();
    let variety_value = $("#select_variety").val();

    $.post(
      "get_price.php",
      {
        crop_value: crop_value,
        variety_value: variety_value,
      },
      (data) => {
        $("#pre_basic").html(data);
      }
    );
  });

  $("#breeder").on("input", () => {
    if (checkVariety("breeder") == "notSelected") {
      alert("Please select variety");
    } else {
      $("#certified").prop("readonly", "true").val("");
      $("#basic").prop("readonly", "true").val("");
      $("#pre_basic").prop("readonly", "true").val("");
    }
  });

  $("#certified").on("input", () => {
    if (checkVariety("certified") == "notSelected") {
      alert("Please select variety");
    } else {
      $("#breeder").prop("readonly", "true").val("");
    }
  });
  $("#basic").on("input", () => {
    if (checkVariety("basic") == "notSelected") {
      alert("Please select variety");
    } else {
      $("#breeder").prop("readonly", "true").val("");
    }
  });
  $("#pre_basic").on("input", () => {
    if (checkVariety("pre_basic") == "notSelected") {
      alert("Please select variety");
    } else {
      $("#breeder").prop("readonly", "true").val("");
    }
  });

  $("#set_prices").click(() => {
    let conformation = confirm("are you sure ?");
    if(conformation == true){
      setPrices()


    }
  });

  const setPrices = () => {
    
    const data = [
      $("#select_crop").val(),
      $("#select_variety").val(),
      $("#breeder").val(),
      $("#pre_basic").val(),
      $("#basic").val(),
      $("#certified").val(),
    ];

    $.post(
      "get_data.php",
      {
        setNewPrices: data,
      },
      (data) => {
        if(data=="updated"){

          alert("Prices updated ");
          window.location.reload();
        }
      }
    );
  };

  const priceForMaize = () => {
    if ($("#select_crop").val() == "CP001") {
      $("#preBasicContainer").hide();
      $("#basicContainer").hide();
      $("#breederContainer").show();
    } else {
      $("#preBasicContainer").show();
      $("#basicContainer").show();
      $("#breederContainer").show();
    }
  };

  const checkVariety = (textField) => {
    if ($("#select_variety").val() == "not_selected") {
      $("#" + textField + "").val("");
      return "notSelected";
    } else if ($("#select_variety").val() == "0") {
      $("#" + textField + "").val("");
      return "notSelected";
    } else {
      return "selected";
    }
  };
});
