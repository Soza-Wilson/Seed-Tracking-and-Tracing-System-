$(document).ready(() => {
  $("#save_agro_dealer").click(() => {
    // form validation
    const inputList = [
      ["debtor_name", "text"],
      ["debtor_phone", "number"],
      ["debtor_email", "email"],
      ["file_directory", "file"]
    ];
    let issues = () =>
      inputList.forEach((element) => {
        alert(formValidation(element[0], element[1]));
      });

      issues()
  });
});

const findValue = ()=>{
  const arrayList = [1,3,4,6,8,9];

  for (let index = 0; index < arrayList.length; index++) {
    const element = array[index];
     element === 3 ? true : false 
  }
}
const formValidation = (field_id, type) => {
    let issues = false;
  //    checking if textfield is empty
  if ($("#" + field_id + "").val() == "") {
    alert("" + field_id + " is empty");
    $("#" + field_id + "").attr("class", "form-control form-control-danger");
    issues = true;
  }
  // cheking textfield for invalid chgaracters
  if (type == "email") {
    if (
      $("#" + field_id + "")
        .val()
        .match(/[!#$%^&*()\_=+{}[\]|\\;:'",<>/?]/g)
    ) {
      alert("" + field_id + " contains invalid characters");
      $("#" + field_id + "").attr("class", "form-control form-control-danger");
      issues = true;
    }
  } else if (type == "file") {
  } else {
    if (
      $("#" + field_id + "")
        .val()
        .match(/[!#$%^&*()\_=+{}[\]|\\;:@_'",<>/?]/g)
    ) {
      alert("" + field_id + " contains invalid characters");
      $("#" + field_id + "").attr("class", "form-control form-control-danger");
      issues = true;
    }
  }


  

  return issues;
};
