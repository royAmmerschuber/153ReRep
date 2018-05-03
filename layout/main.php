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

        <button onclick="newReportWin('<?php $panelname="edit-main";echo $panelname ?>')">create new report</button>


    </div>
    <div>

    </div>
    <?php include_once "popup.php"?>
</div>


<?php include_once "footer.php" ?>
</body>
</html>