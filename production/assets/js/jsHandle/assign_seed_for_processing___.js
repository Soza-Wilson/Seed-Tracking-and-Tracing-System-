$(document).ready(() => {
  $("#process_seed").click(() => {
    if (confirm('Are you sure')){
       assign_seed_data();

    
    }
    
  });

  let seed_data = [];

  const assign_seed_data = () => {
    let processId = "-";
    let processTypeId = "-";
 
    if ($("#process_id").val()!= null) {
      processId = $("#process_id").val();
      processTypeId = $("#passed_process_type_id").val();
    }
    seed_data = [
      $("#grade_id").val(),
      $("#type").val(),
      $("#assign_quantity").val(),
      $("#grade_outs_quantity").val(),
      $("#trash_quantity").val(),
      $("#available_quantity").val(),
      processId,
      processTypeId,
    ];

    process_seed(processId);
  };

  const process_seed = () => {
    const type = $("#type").val().toString(); 
  
    
    if (type == "Cleaning") {
      $.post(
        "get_data/seed_processing_data.php",
        {
          cleanSeed: seed_data,
        },
        (data) => {
          alert(data);
          window.location='process_seed.php';
        }
      );
    } else {
      $.post(
        "get_data/seed_processing_data.php",
        {
          processSeed: seed_data,
        },
        (data) => {
         alert(data);
       window.location='process_seed.php';
        }
      );
    }
  };
});
