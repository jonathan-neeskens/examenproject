<?php
    if (isset($_POST['submit_run'])){
        $arrData = array($_SESSION['userID'], $_POST['distance'], $_POST['percentage'], $_POST['time'], $_POST['wear']);

        addRun($arrData);
    }

    include 'head.php';
?>

<body class="bg-green">

    <div class="popup_addrun bg-white active">
        <a onclick="disableCover()"> <i class="fa fa-times"></i></a>
        <h2> Add a new run </h2>
        <form method="post" action="#">
            <label for="distance">distance in kilometres</label>
            <input type="number" required name="distance" id="distance"><br>
            <label for="percentage">percentage of height difference</label>
            <input type="number" class="form-field" required name="percentage" id="percentage"><br>
            <label for="time">time in hours</label>
            <input type="number" class="form-field" required name="time" id="time"><br>
            <span>percentage of wear: </span> <span class="wear_percentage">  </span> <br>
            <input type="hidden" class="wear_value" name="wear"><br>
            <input type="submit" class="button-green" name="submit_run" value="Submit your run">
        </form>
    </div>

    <script>
        if (validateForm() == true){
            alert('All fields are filled in');
        }

        jQuery( "#distance" ).keyup(function() {
            calculateWear();
        });

        jQuery( "#percentage" ).keyup(function() {
            calculateWear();
        });

        jQuery( "#time" ).keyup(function() {
            calculateWear();
        });

        function calculateWear(){
            var rawWear= ((jQuery("#distance").val() * 10) * (jQuery("#percentage").val() / 50)) / 75;

            var wear=Math.round(rawWear*1000)/1000;

            jQuery(".wear_percentage").html(wear + ' %');
            jQuery(".wear_value").val(wear);
        }

        function validateForm() {
            var isValid = true;
            jQuery('.form-field').each(function() {
                if ( jQuery(this).val() === '' )
                    isValid = false;
            });
            return isValid;
        }

    </script>
<?php include 'footer.php'; ?>
</body>