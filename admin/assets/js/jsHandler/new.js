$(document).ready(function(){


   
    
       $("#approve_access").click(() => {

        let access = confirm("Are you sure ?")
        if (access == true) {
            let user_id = $('#user').val();
            let approval_id = $('#approval_id').val();

            let code = "";
            const characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            for (let i = 0; i < 8; i++) {
                code += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            alert(code)

            $.post('get_data.php', {
                grantUserAccess: approval_id,
                approvalCode: code,
                userId: user_id,
            }, function(data) {

                window.location="grant_access_pending.php";
                
            })




        }
        else if (access == false) {

            window.location="grant_access_pending.php";
        }

    });


    $("#deny_access").click(()=>{

    let access = confirm("Deny access. Are you sure ?");

    if(access==true){
        
        let approval_id = $('#approval_id').val();
      
        $.post('get_data.php', {
            denyUserAccess: approval_id,
            
        }, function(data) {

            window.location="grant_access_pending.php";
            
        })




    }

    else if (access == false) {

        window.location="grant_access_pending.php";
    }


    });
})