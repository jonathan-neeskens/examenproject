<?php

include 'head.php';

$pagetitle = "Registrer - Choose your shoes";
$brand = $_GET['brandID'];

?>
<title>Keep Running - <?= $pagetitle ?></title>

    <div class="bit-1 bg-green full_height wide_wrapper">
        <h1 class="white_color">1. What shoes do you have?</h1>
        <div class="brands active">
        <h3 class="white_color"> Choose your brand </h3>
            <?php if (!$brand) : ?>
                <?php
                    $brandsArray = getBrands();

                    foreach($brandsArray as $brand) :
                ?>

            <div alt="<?= $brand[1] ?>" class="brand box" style="background: url('img/logos/<?= $brand[2] ?>')"></div>

            <?php endforeach; ?>
            <?php else : ?>
                <div alt="nike" class="brand box" style="border: 5px solid #000; background: url('')"></div>
            <?php endif; ?>
        </div>

        <?php if ($brand){ $status = "active"; } else{ $status = "inactive"; }?>
        <div class="models <?= $status ?>">
        <h3 class="white_color"> Choose your model </h3>
            <?php if(!$brand) : ?>
            <div class="model box"></div>
            <?php else : ?>
                <?php
                $brandsArray = getModels($brandID);
                foreach($brandsArray as $brand) :
                    ?>

                    <div alt="<?= $brand[1] ?>" class="brand box" style="background: url('img/logos/<?= $brand[2] ?>')"></div>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

<script>

</script>
</body>
