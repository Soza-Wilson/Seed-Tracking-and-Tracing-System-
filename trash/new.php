<script src="jquery-2.2.4.min.js"></script>
<script>
function getname(){
	$("#loadericon").show();
    jQuery.ajax({
	url:"getname.php";
    data:'search='+$("#search").val(),
    type: "POST",
    success:function(data){
	 $("#productcode").html(data);
     $("#loadericon").hide(); 	
	},   	
	error:function(){}
	}); 	
}
</script>

<form role="" method="POST">
<input type="text" onkeyup="getname()" id="search" name="search"/>

<p id="product"></p>
</form>