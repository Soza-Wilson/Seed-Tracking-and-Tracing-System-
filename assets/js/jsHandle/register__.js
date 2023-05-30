$(document).ready(() => {
  let user_value = "";

  $("#user_name").html(
    "<input type='text' class='form-control form-control-" +
      user_value +
      "' name='user_name' id='user_name' class='form-control' required=''></input>"
  );

  $("#register_user").click(() => {
    let issues = 0;
    let confirmomation = confirm("Are you sure ?");
    if (confirmomation == true) {
      if (input_validation(getUserInputData()) !== "") {
        alert(input_validation(getUserInputData()));
        issues++;
      }
      if (changePassWordField($("#password").val()) !== "") {
        alert(changePassWordField($("#password").val()));
        issues++;
      }
      if (confirmPassword() !== "") {
        alert(confirmPassword());
      }

      if (issues == 0) {
        let userData = getUserInputData();
        registerUser(userData);
      }
    } else {
      alert(user_value);
    }
  });

  function getUserInputData() {
    let userInputData = [
      { inputName: "fullname", inputValue: $("#fullname").val(), type: "text" },
      {
        inputName: "phone-number",
        inputValue: $("#phone-number").val(),
        type: "text",
      },
      {
        inputName: "email-address",
        inputValue: $("#email-address").val(),
        type: "text",
      },

      {
        inputName: "select-gender",
        inputValue: $("#select-gender").val(),
        type: "select",
      },
      {
        inputName: "date-of-birth",
        inputValue: $("#date-of-birth").val(),
        type: "date",
      },

      {
        inputName: "password",
        inputValue: $("#password").val(),
        type: "text",
      },
      {
        inputName: "confirm-password",
        inputValue: $("#password").val(),
        type: "text",
      },
    ];

    return userInputData;
  }

  function input_validation(userInputData) {
    let returnValue = "";
    userInputData.forEach((element) => {
      if (element.inputValue == "" && element.type == "text") {
        $("#div_" + element.inputName + "").html(
          "<input type='text' class='form-control form-control-danger' name='" +
            element.inputName +
            "' id='" +
            element.inputName +
            "' class='form-control' required=''></input><div class='col-form-label form-control-danger'>Please enter " +
            element.inputName +
            "<i class='icofont icofont-warning'></i></div>"
        );

        returnValue = "Check textfields";
      } else if (element.inputValue == "" && element.type == "date") {
        $("#div_" + element.inputName + "").html(
          "<input type='date' class='form-control form-control-danger' name='" +
            element.inputName +
            "' id='" +
            element.inputName +
            "' class='form-control' required=''></input><div class='col-form-label form-control-danger'>Please enter " +
            element.inputName +
            "<i class='icofont icofont-warning'></i></div>"
        );
      } else if (element.inputValue == "" && element.type == "select") {
        let options = $("#" + element.inputName + "").find("option");
        $("#div_" + element.inputName + "").html(
          "<select class='form-control form-control-danger' name='" +
            element.inputName +
            "' id='" +
            element.inputName +
            "'></select></input><div class='col-form-label form-control-danger'>Please  " +
            element.inputName +
            "<i class='icofont icofont-warning'></i></div>"
        );
        returnValue = "Check textfields";
        set_select_data("#" + element.inputName + "", options);
      }
    });

    return returnValue;
  }

  function set_select_data(select_element, options) {
    // Loop through each option and do something
    options.each(function () {
      var value = $(this).val(); // Get the value of the option
      var text = $(this).text(); // Get the text of the option
    });
    var selectElement = $(select_element);
    selectElement.empty();
    $.each(options, function (index, option) {
      var optionElement = $("<option>")
        .val(option.value)
        .text(option.text)
        .appendTo(selectElement);
    });
  }

  function checkPasswordStrength(password) {
    // Define the criteria for a strong password
    const minLength = 8;
    const minUpperCase = 1;
    const minLowerCase = 1;
    const minDigits = 1;
    const minSpecialChars = 1;

    // Check the length of the password
    if (password.length < minLength) {
      return "Password should be at least " + minLength + " characters long.";
    }

    // Check the presence of uppercase letters
    if (!password.match(/[A-Z]/g)) {
      return (
        "Password should contain at least " +
        minUpperCase +
        " uppercase letter."
      );
    }

    // Check the presence of lowercase letters
    if (!password.match(/[a-z]/g)) {
      return (
        "Password should contain at least " +
        minLowerCase +
        " lowercase letter."
      );
    }

    // Check the presence of digits
    if (!password.match(/[0-9]/g)) {
      return "Password should contain at least " + minDigits + " digit.";
    }

    // Check the presence of special characters
    if (!password.match(/[!@#$%^&*()\-_=+{}[\]|\\;:'",.<>/?]/g)) {
      return (
        "Password should contain at least " +
        minSpecialChars +
        " special character."
      );
    }

    // Password meets all the criteria, considered strong
    return "strong";
  }

  $("#password").on("input", () => {
    changePassWordField($("#password").val());
  });
  function changePassWordField(password) {
    let strength = "";
    let passwordStrength = checkPasswordStrength(password);
    if (passwordStrength == "strong") {
      $("#password-suggestion").html(
        "<div class='col-form-label form-control-success'>" +
          passwordStrength +
          "<i class='icofont icofont-check'></i></div>"
      );
    } else {
      $("#password-suggestion").html(
        " <p class=' text-left m-b-0 text-danger'>" +
          passwordStrength +
          "<i class='icofont icofont-warning'></i></p>"
      );
      strength = "Check password strength";
    }
    return strength;
  }

  $("#confirm-password").on("input", () => {
    confirmPassword();
  });

  function confirmPassword() {
    let passwordMatch = "";
    if ($("#password").val() !== $("#confirm-password").val()) {
      $("#conformation").html(
        " <p class=' text-left m-b-0 text-danger'> Password does not match with conformation <i class='icofont icofont-warning'></i></p>"
      );
      // user_value ="Check Confirm-Password";
      passwordMatch = "Make sure password matches conformation";
    } else {
      $("#conformation").html(
        " <p class=' text-left m-b-0 text-success'> well done <i class='icofont icofont-check'></i></p>"
      );
    }

    return passwordMatch;
  }

  function registerUser() {
    let userInput = [];
    getUserInputData().forEach((element) => {
      userInput.push(element.inputValue);
    });
    $.post(
      "get_data.php",
      {
        registerUser: userInput,
      },
      (data) => {
        if (data == "registered") {
          alert("Your account has been registered");
          window.location="../index.php";
        } else {
          alert(data);
          window.location.reload();
        }
      }
    );
  }
});
