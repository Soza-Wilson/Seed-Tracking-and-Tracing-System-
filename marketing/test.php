<html>


<div >

<h5 id="test_div"></h5>


</div>

<script type="text/javascript" src="../jquery/jquery.js"></script>
    <script type="text/javascript" >

$(document).ready(function(){


    alert('key working');

    //crop_data="waiting";

 /*   $.post('get_added_items.php',{ crop_data : crop_data  },function(data){

$('#test_div').val(data);


    });

*/    



});

$('#quantity').keyup(function(){

alert('key working');


});

</script>

<input id="quantity" type="text" class="form-control" name="quantity" >
<div id ="test_div">
    

</div>

</html>

<?php




?>