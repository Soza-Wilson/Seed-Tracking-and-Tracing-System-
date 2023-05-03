$(document).ready(() => {

  $(".warning_text").css("color", "red").hide();

  $("#save_grower").click(() => {
    let fields = checkTextfield();
    if (fields > 0) {
      alert("Please fill out all required fields !!");
    } else {
      checkName();
    }
  });

  $("#creditor_name").on("input", () => {
    $("#warning_creditor_name").hide();
  });
  $("#creditor_phone").on("input", () => {
    $("#warning_creditor_name").hide();
  });

  $("#fileDirectory").on("input", () => {
    $("#warning_contract").hide();
    uploadFile();
  });

  function checkTextfield() {
    let emptyFields = 0;
    if ($("#creditor_name").val() == "") {
      $("#warning_creditor_name").show();
      emptyFields = emptyFields + 1;
    }
    if ($("#creditor_phone").val() == "") {
      $("#warning_creditor_phone").show();
      emptyFields = emptyFields + 1;
    }
    if ($("#fileDirectory").val() == "") {
      $("#warning_contract").show();
      emptyFields = emptyFields + 1;
    }

    return emptyFields;
  }

  function checkName() {
    $.post(
      "get_data.php",
      {
        checkGrowerName: $("#creditor_name").val(),
      },
      (data) => {
        if (data == true) {
          alert(
            "Error: Grower name already exists (Rename or activate already existing Grower )"
          );
        } else {
          registerGrower();
        }
      }
    );
  }

  // register grower

  function registerGrower() {
    let growerData = [
      "MUSECO",
      $("#creditor_name").val(),
      $("#creditor_phone").val(),
      $("#creditor_email").val(),
      $("#user").val(),
    ];

    $.post(
      "get_data.php",
      {
        registerGrower: growerData,
      },
      (data) => {
        if (data !== "") {
          addContract(data);
        } else {
          alert("Error: Grower not registered ");
          window.location.reload();
        }
      }
    );
  }

  function addContract(creditorID) {
    let contractData = [creditorID, $("#user").val(), $("#tempFile").val()];

    alert(contractData[1]);

    $.post(
      "get_data.php",
      {
        registerContract: contractData,
      },
      (data) => {
        alert(data);

        // if(data !==""){
        //     addContract(data);

        // }
        // else{

        //     alert("Error: Grower not registered ");
        //     window.location.reload();

        // }
      }
    );
  }

  /// upload file using PHP
  function uploadFile() {
    let formData = new FormData();
    let fileInput = document.querySelector("#fileDirectory");
    formData.append("growerFile", fileInput.files[0]);

    fetch("upload.php", { method: "POST", body: formData })
      .then((response) => response.json())
      .then((data) => {
        filename = data.filename;
        $("#tempFile").val(filename);
      })
      .catch((error) => {
        console.log(error);
      });
  }

  // pagenation

 let table = $("#dataTable");






  

  let rowsPerPage = 2;
  let currentPage = 1;

  function buildTable() {
   let start = (currentPage - 1) * rowsPerPage;
   let end = start + rowsPerPage;

    table.find("tbody tr").hide();
    table.find("tbody tr").slice(start, end).show();

    buildPagination();
  }

  function buildPagination() {
   let totalRows = table.find("tbody tr").length;
   let totalPages = Math.ceil(totalRows / rowsPerPage);

   let pagination = $("#pagination");
    pagination.html("");

    for (var i = 1; i <= totalPages; i++) {
     let link = $("<a>");
      link.attr("href", "#");
      link.html(i);

      if (i == currentPage) {
        link.addClass("active");
      }

      link.on("click", function () {
        currentPage = parseInt($(this).html());
        buildTable();
        return false;
      });

      pagination.append(link);
    }
  }

  buildTable();
});
