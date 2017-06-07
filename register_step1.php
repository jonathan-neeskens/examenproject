<?php

include 'head.php';

$pagetitle = "Register";
$brandID = $_GET['brandID'];

?>
<title>Keep Running - <?= $pagetitle ?></title>
<body class="bg-green">
    <div class="bit-1  full_height small_wrapper">
        <h2 class="white_color">1. What shoes do you have?</h2>
        <div class="brands active">
        <h3 class="white_color"> Choose your brand </h3>
            <?php if (!$brandID) : ?>
                <?php
                    $brandsArray = getBrands();

                    foreach($brandsArray as $brand) :
                ?>

            <div alt="<?= $brand[1] ?>" onclick="chooseBrand('<?= $brand[0] ?>')" class="brand box" style="background: url('img/logos/<?= $brand[2] ?>')"></div>
            <?php endforeach; ?>
            <?php else : ?>
                <?php
                $brandArray = getBrandByID($brandID);

                foreach($brandArray as $singlebrand) :
                    ?>

                    <div alt="<?= $singlebrand[1] ?>" class="brand box active" style="background: url('img/logos/<?= $singlebrand[2] ?>')"> <a href="register_step1.php">  </a></div>

                    <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php if ($brandID){ $status = "active"; } else{ $status = "inactive"; }?>
        <div class="models <?= $status ?>">
        <h3 class="white_color"> Choose your model </h3>
            <?php if(!$brandID) : ?>
            <div class="box inactive"> CHOOSE A <BR> BRAND FIRST </div>
            <?php else : ?>
                <?php
                $modelsArray = getModelsByBrandID($brandID);
                foreach($modelsArray as $model) :
                    ?>
                <div alt="<?= $model[2] ?>" class="model box" onclick="chooseModel('<?= $model[1] ?>')">
                    <div class="img" style='background: url("img/models/<?= $model[3] ?>")'> </div>
                    <div class="modelName">
                        <span><?= $model[2] ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

<script>
    function chooseBrand(brandID) {
        window.location.href = "?brandID=" + brandID;
    }
</script>
</body>
