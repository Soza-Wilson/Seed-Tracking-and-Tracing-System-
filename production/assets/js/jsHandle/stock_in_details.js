$(document).ready(()=>{

  $("#request_approval").click(()=>{

   let actionName = "update_stock_in";
   let depertment = "production";
   let action_id = $("#stock_in_id").val();
   let request_id =$("#request_id").val();
   let requestedName = $("#user_name").val();
  let  description = requestedName+" is requesting to update stock in details";
 



   $.post('get_data.php', {
    updateStockInRequest:actionName,
    depertment:depertment,
    action_id:action_id,
    request_id:request_id,
    requestedName:requestedName,
    description:description
}, function(data) {

    alert("Request sent to Admin. Enter approval code to continue...");
    $('#approval_label').html(data);

});

function generateCode() {
    let code = "";
    const characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()";
    for (let i = 0; i < 8; i++) {
      code += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return code;
  }
  
  


 
  });



});