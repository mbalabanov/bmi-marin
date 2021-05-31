<?php

function bmiAuswertung($weight, $height, $gender)
{
    $bmiResult = intval($weight) * 10000 / (intval($height) * intval($height));
    $bmiEvaluation = '';

    if ($gender == 'male') {
        switch (true) {
            case ($bmiResult < '20'):
                $bmiEvaluation = 'Untergewicht';
                break;
            case ($bmiResult >= '20' && $bmiResult <= '25'):
                $bmiEvaluation = 'Normalgewicht';
                break;
            case ($bmiResult >= '26' && $bmiResult <= '30'):
                $bmiEvaluation = 'Übergewicht';
                break;
            case ($bmiResult > '30'):
                $bmiEvaluation = 'schweres Übergewicht';
                break;
        };
    } elseif ($gender == 'female') {
        switch (true) {
            case ($bmiResult < '19'):
                $bmiEvaluation = 'Untergewicht';
                break;
            case ($bmiResult >= '19' && $bmiResult <= '24'):
                $bmiEvaluation = 'Normalewicht';
                break;
            case ($bmiResult >= '25' && $bmiResult <= '30'):
                $bmiEvaluation = 'Übergewicht';
                break;
            case ($bmiResult > '30'):
                $bmiEvaluation = 'schweres Übergewicht';
                break;
            default:
                $bmiEvaluation = 'Normalgewicht';
        };
    };


    $bmi = [
        'wert' => round($bmiResult),
        'bewertung' => $bmiEvaluation
    ];

    return $bmi;
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>BMI Calculator</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h1>BMI Calculator</h1>
                <h2>Marin Balabanov</h2>
                <p>Bitte geben Sie Ihre Körpergröße und Körpergewicht ein, um Ihren <strong>Body Mass Index</strong> zu berechnen.</p>
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <div class="row mb-3">
                        <div class="col-md-4 mt-4">
                            <label for="height" class="form-label">Körpergröße in cm<sup class="text-danger">*</sup></label>
                            <input type="number" class="form-control" id="height" name="height" aria-describedby="height" required>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label for="weight" class="form-label">Körpergewicht in kg<sup class="text-danger">*</sup></label>
                            <input type="number" class="form-control" id="weight" name="weight" aria-describedby="weight" required>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label for="gender" class="form-label">Geschlecht</label>
                            <select class="form-select" id="gender" name="gender" aria-label="Default select example">s
                                <option value="male" selected>Männlich</option>
                                <option value="female">Weiblich</option>
                            </select>
                        </div>
                    </div>
                    <p><sup class="text-danger">*</sup> Erforderliches Feld.</p>
                    <button type="submit" class="btn btn-primary">Berechnen</button>
                </form>

                <?php
                if (isset($_POST['weight']) && isset($_POST['height']) && isset($_POST['gender'])) {
                    $bmiResult = bmiAuswertung($_POST['weight'], $_POST['height'], $_POST['gender']);
                    echo "<div class='alert alert-primary text-center mt-4' role='alert'>Your <strong>Body Mass Index</strong> is $bmiResult[wert].<br/>
                Sie haben <strong>$bmiResult[bewertung]</strong>.</div>";
                }
                ?>

            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>