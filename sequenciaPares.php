<?php
$inicio = "";
$fim = "";
$resultado = "";
$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $inicio = $_POST["inicio"];
    $fim = $_POST["fim"];

    if ( $inicio === "" || $fim === "" || filter_var($inicio, FILTER_VALIDATE_INT) === false || filter_var($fim, FILTER_VALIDATE_INT) === false) {
        $erros[] = "Por favor, insira dois números inteiros válidos.";
    } elseif ($inicio > $fim) {
        $erros[] = "O número inicial deve ser menor ou igual ao número final.";
    } else {
        $inicio = (int)$inicio;
        $fim = (int)$fim;

        $pares = [];

        
        for ($i = $inicio; $i <= $fim; $i++) {
            if ($i % 2 == 0) { 
                $pares[] = $i;
            }
        }

        if (count($pares) > 0) {
            $resultado = "Pares entre $inicio e $fim: " . implode(", ", $pares);
        } else {
            $resultado = "Não há números pares entre $inicio e $fim.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ex. 12: Sequência de Pares</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f2f5;
        }

        div * {
            box-sizing: border-box;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .resultado {
            color: #0056b3;
            background-color: #e8f4ff;
            border: 1px solid #0056b3;
            padding: 10px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .erro {
            color: #d9534f;
            background-color: #f8d7da;
            border: 1px solid #d9534f;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

         #voltar{
            display: flex;
            padding-top: 25px;
        }
        
    </style>
</head>

<body>

<div>
    <h2>Sequência de Pares</h2>

    <?php
    if (count($erros) > 0) {
        echo "<div class='erro'><ul>";
        foreach ($erros as $erro) { echo "<li>$erro</li>"; }
        echo "</ul></div>";
    }
    ?>

    <form method="post" action="">
        <label for="inicio">Número inicial:</label>
        <input type="text" id="inicio" name="inicio" value="<?= htmlspecialchars($inicio) ?>">

        <label for="fim">Número final:</label>
        <input type="text" id="fim" name="fim" value="<?= htmlspecialchars($fim) ?>">

        <input type="submit" value="Exibir Pares">
    </form>

    <?php
    if ($resultado !== "" && count($erros) == 0) {
        echo "<div class='resultado'>$resultado</div>";
    }
    ?>
    <a id="voltar" href='./index.php'><strong> Voltar </strong> </a>
</div>

</body>
</html>
