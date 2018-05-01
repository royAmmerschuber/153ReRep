<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <?php include_once "head.php"?>
    <script src="/153ReRep/layout/js/main.js"></script>
</head>
<body>
<?php include_once "header.php" ?>

<div>
    <div>
        <button onclick="newReportWin()">create new report</button>

    </div>
    <div>

    </div>
    <div class="edit-frame">
        <button id="btnClose" class="btn-primary" onclick="closeEditFrame()">X</button>
        <div id="content-frame">

        </div>
    </div>
</div>


<?php include_once "footer.php" ?>
<?php

if(!isset($fav)){
    $fav="";
}
if(isset($_GET["search"])){
    echo "<script>loadListS(\"".$_GET["search"]."\",\"$fav\");";

}else{
    echo "<script>loadList(\"$fav\");";
}
?>
$(document).ready(function(){
$("#searchSubmit")[0].onclick=null;
$("#searchSubmit").click(loadList);
});
</script>
</body>
</html>