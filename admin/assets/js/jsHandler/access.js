


$(document).ready(() => {
    $("#approve_access").click(() => {

        let code = "";
        const characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        for (let i = 0; i < 8; i++) {
            code += characters.charAt(Math.floor(Math.random() * characters.length));
        }

        //getting user Id and approval ID

        let userId = $("#user").val();
        let approvalId = $("#approval_id").val();
        alert(approvalId);
      
        let user_data = prompt("Enter Password to approve");
        if(user_data==true){
            alert("CONFIRMATION CODE : "+code);
            $.post('get_data.php', {
                grantUserAccess: approvalId,
                approvalCode:code,
                userId: userId,
                
    
            }, function (data) {
    
                window.location='grant_access_pending.php';
    
            });


        }
        else if(user_data==false){

            $.post('get_data.php', {
               denyUserAccess: approvalId
            
            }, function (data) {
    
                window.location='grant_access_pending.php';
    
            })

        }

       


    })
})