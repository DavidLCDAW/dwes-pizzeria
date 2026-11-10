<?php
// Las cantidades están en céntimos
$sizes = ["mini" => 295, "media" => 495, "maxi" => 895];
$bases = ["normal" => 0, "crujiente" => 100, "rellena" => 200];
$salsas = ["barbacoa" => 95, "carbonara" => 145];
$ingredientes = ["pollo" => 55, "bacon" => 75, "jamón" => 95, "cebolla" => 45, "aceitunas" => 55, "pimiento" => 65];

$form = "block";
$table = "none";


$size =  $_GET["size"] ?? "";
$base =  $_GET["base"] ?? "";
$salsa =  $_GET["salsa"] ?? "";
$ingrediente =  $_GET["ingrediente"]  ?? [];

if (!empty($size) && !empty($base)) {
    $form = "none";
    $table = "flex";

    // $size = $sizes[$size] / 100;
    $size = $sizes[$size];
    $base = $bases[$base];
    $salsa = $salsas[$salsa] ?? 0;

    $total = $size + $base + $salsa;
    foreach ($ingrediente as $value) {
        $precio = $ingredientes[$value];
        $total += $precio;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <main class="container">
        <section class="my-4 row justify-content-center">
            <div class="col-12 col-md-6 col-lg-5">
                <form style="display: <?= $form ?>;">
                    <div class=" mb-3">
                        <label for="size" class="form-label">
                            Tamaño:
                        </label>
                        <select name="size" class="form-select">
                            <?php foreach ($sizes as $key => $value): ?>
                                <option value="<?= $key ?>"><?= $key . ": ". $value / 100 . "€"?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="base" class="form-label">
                            Base:
                        </label>
                        <select name="base" class="form-select">
                            <?php foreach ($bases as $key => $value): ?>
                                <option value="<?= $key ?>"><?= $key . ": " . $value / 100 . "€" ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="mb-3 form-check">
                        <label for="" class="form-check-label">
                            Salsa:
                        </label>
                        <br>
                        <?php foreach ($salsas as $key => $value): ?>
                            <?= ucfirst($key) ?>
                            <input type="radio" name="salsa" class="form-check-input" value="<?= $key ?>">
                                <?= $value / 100 ."€" ?>
                            <br>
                        <?php endforeach ?>
                    </div>

                    <div class="mb-3 form-check">
                        <label for="" class="form-check-label">
                            Ingredientes:
                        </label>
                        <br>
                        <?php foreach ($ingredientes as $key => $value): ?>
                            <?= ucfirst($key) ?>
                            <input type="checkbox" name="ingrediente[]" class="form-check-input" value="<?= $key ?>">
                            <?= ": " .$value / 100 ."€" ?>
                            <br>
                        <?php endforeach ?>
                    </div>

                    <button class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </section>
        <section class="mt-3 row justify-content-center " style="display: <?= $table ?>;">
            <article class="col-12 col-md-6 col-lg-5">
                <table class="table table-striped table-bordered border-secondary shadow">
                    <tr>
                        <th scope="row">Tamaño</th>
                        <td><?php printf("%05.2f€", $size / 100) . "€" ?? "" ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Base</th>
                        <td><?php printf("%05.2f€", $base / 100 ?? "") ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Salsa</th>
                        <td><?php printf("%05.2f€", $salsa / 100) . "€" ?? "" ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Ingredientes</th>
                        <td>
                            <?php if (empty($ingrediente)): ?>
                                0€
                            <?php else: ?>
                                <?php foreach ($ingrediente as $value): ?>
                                    <?= ucfirst($value) . ": " ?>
                                    <?php printf("%05.2f€", $ingredientes[$value] / 100) ?>
                                    <br>
                                <?php endforeach ?>
                            <?php endif ?>
                        </td>

                    </tr>
                    <tr>
                        <th scope="row">Total</th>
                        <td><?php printf("%05.2f€",$total /100) ?></td>
                    </tr>
                </table>
            </article>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-mrcw6zmfylzcla8nl+ntuvf0sa7msxsp1uyjomp4yleunsfap+jcxn/twtiaxvxm" crossorigin="anonymous"></script>
</body>

</html>
