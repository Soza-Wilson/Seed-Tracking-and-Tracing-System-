$(document).ready(function () {

    $(".warning-text").css("color", "red").hide();
  
    
  const loaded = "1";

  $.post(
    "get_products.php",
    {
      loaded: loaded,
    },
    (data) => {
      $("#select_crop").html(data);
    }
  );
 
 
  $("#select_crop").change(function () {
    let crop_value = $("#select_crop").val();
    $("#warning_text").show();
  

    $.post(
      "get_products.php",
      {
        crop_value: crop_value,
      },
      (data) => {
        $("#select_variety").html(data);
      }
    );
  });


  $("#get_data").click(()=>{


   

    

    let filterData =[$("#creditorName").val(),$("#select_crop").val(),$("#select_variety").val(),$("#select_class").val(),$("#fromDateValue").val(),$("#toDateValue").val()];

 if(checkFilterFields()>0){

    alert("Please fill out all required text fields ");
 }
 else{
  toCsv();
    $.post(
        "get_data.php",
        {
          viewStockFilter: filterData,
          
        },
        (data) => {
    
        alert(data);
       

       
        }
      );


 }

   

    
  })



  function checkFilterFields(){

     let textField=0

    if($("#creditorName").val()==""){
        textField = textField+1;
        $("#warning_name").show();
    }
    if($("#select_crop").val()==0){
        textField = textField+1;
        $("#warning_crop").show();
    }
    if( $("#select_variety").val()=="not_selected"){
        textField = textField+1;
        $("#warning_variety").show();
    }
    if( $("#select_class").val()=="not_selected"){
        textField = textField+1;
        $("#warning_class").show();
    }
    if( $("#fromDateValue").val()==""){
        textField = textField+1;
        $("#warning_from").show();
    }
    if( $("#toDateValue").val()==""){
        textField = textField+1;
        $("#warning_to").show();
    }
    

    return textField;




  }

  function toCsv(){

    let creditor = $('#creditorName').val();
    let cropValue = $('#select_crop').val();
    let varietyValue = $('#select_variety').val();
    let classValue = $('#select_class').val();
    let from = $('#fromDateValue').val();
    let to = $('#toDateValue').val();
    let page_type ="sales_list";
    
    
    
    $('#creditor_hidden').val(creditor);
    $('#cropValueHidden').val(cropValue);
    $('#varietyValueHidden').val(varietyValue);
    $('#classValueHidden').val(classValue);
    $('#from_hidden').val(from);
    $('#to_hidden').val(to);
    $('#filter').val("haghgd");
    

  }




})