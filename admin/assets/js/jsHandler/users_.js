$(document).ready(() => {
  $("#departments").change(() => {
    let dep_data = $("#departments").val();
    if (dep_data === "0") {
      alert("Select department first");
    } else if (dep_data === "1") {
      $("#role").empty();
      var myOptions = [
        {
          text: "Select role",
          value: "0",
        },
        {
          text: "System admistrator ",
          value: "system_administrator",
        },
      ];

      $.each(myOptions, function (i, el) {
        $("#role").append(new Option(el.text, el.value));
      });
    } else if (dep_data === "2") {
      $("#role").empty();
      var myOptions = [
        {
          text: "Select role",
          value: "0",
        },
        {
          text: "Product system adminstrator ",
          value: "production_administrator",
        },
        {
          text: "Lab Technician",
          value: "lab_technician",
        },
        {
          text: "Warehouse Officer",
          value: "warehouse_officer",
        },
        {
          text: "Field Officer",
          value: "field_officer",
        },
      ];

      $.each(myOptions, function (i, el) {
        $("#role").append(new Option(el.text, el.value));
      });
    } else if (dep_data === "3") {
      $("#role").empty();
      var myOptions = [
        {
          text: "Select role",
          value: "0",
        },
        {
          text: "Marketing system adminstrator",
          value: "marketing_administrator  ",
        },
        {
          text: "Marketing Officer",
          value: "marketing_officer",
        },
      ];

      $.each(myOptions, function (i, el) {
        $("#role").append(new Option(el.text, el.value));
      });
    } else if (dep_data === "5") {
      $("#role").empty();
      var myOptions = [
        {
          text: "Select role",
          value: "0",
        },
        {
          text: "Finance system admistrator ",
          value: "finance_administrator",
        },
        {
          text: "Cashier",
          value: "cashier",
        },
      ];

      $.each(myOptions, function (i, el) {
        $("#role").append(new Option(el.text, el.value));
      });
    }
  });

  $("#allocateRole").click(() => {
    allocateUserToRole($("#userId").val());
  });

  $("#suspendAccount").click(() => {
    let conformation = confirm("Are you sure ?");

    if (conformation == true) {
      suspendAccount($("#userId").val());
    }
  });

  function suspendAccount(userID) {
    $.post(
      "get_data.php",
      {
        suspendUser: userID,
      },
      (data) => {
      
          if (data == "suspended") {
            alert("Your account has been suspended");
            // window.location.reload();
            history.back()
          } else {
            alert(data);
            window.location.reload();
          }
      }
    );
  }

  function allocateUserToRole(userID) {
    let conformation = confirm("Are you sure ?");
    if (conformation == true) {
      let returnData = validateInput(getAllocationData());
      allocateUser(returnData);
    }
  }

  function validateInput(data) {
    let selectData = [];
    data.forEach((element) => {
      if (element.department == 0 || element.position == 0) {
        alert("Select department and position !!");
        $("#departments").attr("class", "form-control form-control-danger");
      } else {
        selectData.push(element.department, element.position);
        // selectData.push(element.position);
      }
    });

    return selectData;
  }

  function getAllocationData() {
    let allocationData = [
      {
        department: $("#departments").val(),
        position: $("#role").val(),
      },
    ];

    return allocationData;
  }

  function allocateUser(allocationData) {
    allocationData.push($("#userId").val());

    $.post(
      "get_data.php",
      {
        allocateUser: allocationData,
      },
      (data) => {

          if (data == "registered") {
          
           alert("account has been allocated to new role");
           history.back();
          } else {
            alert(data);
            window.location.reload();
          }
      }
    );
  }
});
