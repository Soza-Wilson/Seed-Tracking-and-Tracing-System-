$(document).ready(function () {
  $(document).ready(function () {
    $("#pass").click(function () {
      $("#fail").prop("checked", false);
    });

    $("#fail").click(function () {
      $("#pass").prop("checked", false);
    });
    $("#save").click(function () {
      if (!checkIfEmpty()) {
        saveTest();
      }
    });
    // germination text

    //germination text

    $("#germination").on("input", function () {
      checkPercentage("germination");
    });
    $("#moisture_content").on("input", function () {
      checkIfNuts("moisture_content");
      checkPercentage("moisture_content");
    });
    $("#oil_content").on("input", function () {
      checkIfNuts("oil_content");
      checkPercentage("oil_content");
    });
    //shelling text
    $("#shelling").on("input", function () {
      checkIfNuts("shelling");
      checkPercentage("shelling");
    });
    // purity text
    $("#purity").on("input", function () {
      checkPercentage("purity");
    });
    // defects text
    $("#defects").on("input", function () {
      checkPercentage("defects");
    });
  });

  const getGrade = () => {
    if ($("#pass").prop("checked", true)) {
      return "passed";
    } else { 
      return "failed";
    }

    
  };

  const saveTest = () => {
    alert(getGrade());
    // data = [
    //   $("#stock_id").find(":selected").val(),
    //   $("#germination").val(),
    //   $("#shelling").val(),
    //   $("#purity").val(),
    //   $("#defects").val(),
    //   $("#oil_content").val(),
    //   $("#moisture_content").val(),
    // ];
    // $.post(
    //   "get_data/lab_test_data.php",
    //   {
    //     test_seed: data,
    //   },
    //   (data) => {
    //     alert(data);
    //     //  window.location='process_seed.php';
    //   }
    // );
  };

  const checkIfEmpty = () => {
    // checking if test is for groundnuts
    // check if all required data is filledout
    // if required data fields are empty return issues
    let textFields = [];
    let issues = false;
    const forGnutsFields = [
      "germination",
      "moisture_content",
      "oil_content",
      "shelling",
      "purity",
      "defects",
    ];
    const forOtherFields = ["germination", "purity", "defects"];

    const crop = $("#hidden_crop").val().toLowerCase();
    const crop_array = crop.split("_");
    crop_array[0] == "gnuts"
      ? (textFields = forGnutsFields)
      : (textFields = forOtherFields);
    textFields.forEach((element) => {
      if ($("#" + element + "").val() == "") {
        [
          alert(element + " percentage is required"),
          $("#" + element + "").attr(
            "class",
            "form-control form-control-danger"
          ),
          (issues = true),
        ];
      }
    });
    return issues;
  };

  const checkPercentage = (fieldValue) => {
    const value = $("#" + fieldValue + "").val();
    value > 100
      ? [
          alert("" + fieldValue + " percentage value should be less than 100"),
          $("#" + fieldValue + "").val(""),
          $("#" + fieldValue + "").attr(
            "class",
            "form-control form-control-danger"
          ),
        ]
      : $("#" + fieldValue + "").attr(
          "class",
          "form-control form-control-success"
        );
  };

  const checkIfNuts = (fieldValue) => {
    const crop = $("#hidden_crop").val().toLowerCase();
    const crop_array = crop.split("_");
    crop_array[0] == "gnuts"
      ? $("#" + fieldValue + "").attr(
          "class",
          "form-control form-control-success"
        )
      : [
          alert(
            "" + fieldValue + " percentage is only available for Ground nuts "
          ),
          $("#" + fieldValue + "").val(""),
          $("#" + fieldValue + "").attr(
            "class",
            "form-control form-control-danger"
          ),
        ];
  };
});
