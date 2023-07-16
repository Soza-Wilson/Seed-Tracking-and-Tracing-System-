$(document).ready(function () {
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

  $("#new_variety").on("input", () => {
    if ($("#select_crop").val() == 0) {
      alert("Please select crop name first before adding new variety");
      $("#select_crop").attr("class", "form-control form-control-danger");
    } else {
      $("#select_crop").attr("class", "form-control form-control-primary");
      $.post(
        "get_data.php",
        {
          checkNewVarietyName: [
            $("#select_crop").val(),
            $("#new_variety").val(),
          ],
        },
        (data) => {
          if (data == "already_exists") {
            $("#new_variety").attr("class", "form-control form-control-danger");
          } else {
            $("#new_variety").attr(
              "class",
              "form-control form-control-primary"
            );
          }
        }
      );
    }
  });

  $("#save_variety").click(() => {
    if (confirm("Are you sure ?") == true) {
      if ($("#new_variety").val() == "") {
        alert("Fillout variety name !!");
        $("#new_variety").attr("class", "form-control form-control-danger");
      } else {
        $.post(
          "get_data.php",
          {
            checkNewVarietyName: [
              $("#select_crop").val(),
              $("#new_variety").val(),
            ],
          },
          (data) => {
            if (data == "already_exists") {
              alert("Error: Dubricated variety name !!");
            } else {
              registerVariety($("#select_crop").val(), $("#new_variety").val());
            }
          }
        );
      }
    }
  });

  $("#save_crop").click(() => {
    $.post(
      "get_data.php",
      {
        checkNewCropName: $("#new_crop").val(),
      },
      (data) => {
        if (data == "already_exists") {
          alert("Crop name already exist");
          $("#new_crop").attr("class", "form-control form-control-danger");
        } else {


          $.post(
            "get_data.php",
            {
              registerCrop: $("#new_crop").val(),
            },
            (data) => {
              if (data == "registered") {
                alert("New crop registered");
                window.location.reload();

              } else {
      
                
              }
            }
          );


        }
      }
    );
  });
});

$("#select_variety").change(() => {
  let crop = $("#select_crop").val();
  let variety = $("#select_variety").val();
  $.post(
    "get_pre_price.php",
    {
      crop_value: crop_value,
      variety_value: variety_value,
    },
    (data) => {
      $("#select_crop").val(data);
    }
  );
});

const registerVariety = (crop_id, variety) => {
  $.post(
    "get_data.php",
    {
      registerNewVariety: [crop_id, variety, $("#variety_type").val()],
    },
    (data) => {
      
   
      if (data == "registered") {
        alert("New variety registered ");
        window.location.reload();

      } else {
        alert("Error: Unable to register new variety");
      }
    }
  );
};
