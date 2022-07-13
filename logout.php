<html>
<head><title>Logging out</title>
<body>
<?php
session_start();
session_destroy();

echo"<h1 align=\"center\"><small>Thank you for your time</small><h1>
<br /><meta http-equiv=Refresh content=2;url=index.php>";
?>


<body>

</html>