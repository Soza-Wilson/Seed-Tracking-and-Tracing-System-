$(document).ready(() => {
  $(".warning_text").css("color", "red").hide();
  $("#register_name").prop("readonly", true);
  $("#status").prop("readonly", true);
  $(".request_for_approval").hide();
  $("#existingName").hide();

  $("#save_grower").click(() => {
    let fields = checkTextfield();
    if (fields > 0) {
      alert("Please fill out all required fields !!");
    } else {
      checkName();
    }
  });

  $("#activate_grower").click(()=>{

     let conf = confirm("Are you sure ?");

     if(conf){
      
      if($("#fileDirectory").val()==""){
       
        alert("Please select contract file first !!")

      }
      else{

        activate_grower($('#grower_id').val(),$('#tempFile').val(),$('#user').val());

      }
     
     }
      
  });

  $("#activate_back").click(()=>{
  
    window.history.back();


  });

  $("#grower_filter").click(()=>{
           
 let filterData = [$("#creditorName").val(),$("#type").val()];

 $.post(
  "get_data.php",
  {
    growerListFilter: filterData,
  },
  (data) => {
   $("#dataTable").html(data);

  })
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

  function activate_grower(grower_id,file,user){
             let contractData = [grower_id,file,user]
    $.post(
      "get_data.php",
      {
       activateGrower: contractData,
      },
      (data) => {
        alert(data);
        // if (data == true) {
        //   alert(
        //     "Error: Grower name already exists (Rename or activate already existing Grower )"
        //   );
        // } else {
        //   registerGrower();
        // }
      }
    );


  }

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
            "Error: Grower name already registered ,if inactive Rename or activate already existing grower"
          );
           
          let filterData = [$("#creditor_name").val(),"inactive"];

          $.post(
           "get_data.php",
           {
             growerListFilter: filterData,
           },
           (data) => {     

            $("#existingNameTable").html(data);
            $("#existingName").show();
         
           })



        } else {
          registerGrower();
        }
      }
    );
  }

  // register grower

  function registerGrower() {
    let growerData = [
      "internal",
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

    $.post(
      "get_data.php",
      {
        registerContract: contractData,
      },
      (data) => {
        if (data !== "") {
          alert(data);
          window.location.reload();
        } else {
          alert("Error: Grower not registered ");
          window.location.reload();
        }
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

  // Update grower

  $("#update_grower").click(() => {
    let checktext = checkTextfield();
  
    if (checktext <= 1) {
      updateGrower();
    }
  });
  function updateGrower() {
    request_approval(
      "Update grower details",
      $("#grower_id").val(),
      "Production",
      $("#user").val(),
      $("#user_name").val(),
      $("#user_name").val() +
        " requesting to update grower details for " +
        $("#creditor_name").val()
    );
  }

  //Request For approval (update grower)
 

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
          $(".request_for_approval").show();
          $("#update_grower").hide();

          return data;
        }
      );
    } else {
      alert("Request already sent. Enter conformation code to continue");
    }
  }

   /// Confirm approval code 

  $("#confirm_code").click(() => {
    let accessCode = $("#code").val();
    let approvalId = $("#approvalId").val();
    let grower_id = $("#grower_id").val();

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
          if (data == "valid") {

            let grower_data = [grower_id,$('#creditor_name').val(),$('#creditor_phone').val(),$('#creditor_email').val(),$('#tempFile').val()];
          
              $.post(
                "get_data.php",
                {
                  updateGrowerDetails: grower_data,
                },
                function (data) {

                 if(data=="updated"){

                  alert("Grower details updated");
                  window.location.reload();


                 }
                  // alert("Certificate deleted");
                  // window.history.back();
                }
              );
           
          } else {
            alert("code is Invalid ");
          }
        }
      );
    }
  });

  $('#fileDirectory').change(()=>{
    uploadFile();
  } 
  );


  // pagenation


  

  // pagenation

  let table = $("#dataTable");
  let rowsPerPage = 5;
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
