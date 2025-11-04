<?php
$n1 = "";
$n2 = "";
$operacao = "";
$resultado = "";
$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $n1 = $_POST["n1"];
    $n2 = $_POST["n2"];
    $operacao = $_POST["operacao"];

    
    if ($n1 === "" || $n2 === "") {
        $erros[] = "Por favor, preencha os dois números.";
    } elseif (!is_numeric($n1) || !is_numeric($n2)) {
        $erros[] = "Os valores devem ser numéricos.";
    } else {
        
        $n1 = (float)$n1;
        $n2 = (float)$n2;

        
        switch ($operacao) {
            case "somar":
                $resultado = "$n1 + $n2 = " . ($n1 + $n2);
                break;
            case "subtrair":
                $resultado = "$n1 - $n2 = " . ($n1 - $n2);
                break;
            case "multiplicar":
                $resultado = "$n1 × $n2 = " . ($n1 * $n2);
                break;
            case "dividir":
                if ($n2 == 0) {
                    $erros[] = "Erro: divisão por zero não é permitida.";
                } else {
                    $resultado = "$n1 ÷ $n2 = " . ($n1 / $n2);
                }
                break;
            default:
                $erros[] = "Selecione uma operação válida.";
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ex. 8: Calculadora com switch</title>
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

        h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            margin-bottom: 15px;
            text-align: center;
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
            text-align: center;
        }

        .erro {
            color: #d9534f;
            background-color: #f8d7da;
            border: 1px solid #d9534f;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        form {
            width: 300px;
        }

         #voltar{
            display: flex;
            padding-top: 25px;
        }

        
    </style>
</head>

<body>

<div>
    <h2>Calculadora com Switch</h2>

    <?php
    if (count($erros) > 0) {
        echo "<div class='erro'><ul>";
        foreach ($erros as $erro) { 
        echo "<li>$erro</li>"; }
        echo "</ul></div>";
    }
    ?>

    <form method="post" action="">
        <label for="n1">Número 1:</label>
        <input type="text" id="n1" name="n1" value="<?= htmlspecialchars($n1) ?>">

        <label for="n2">Número 2:</label>
        <input type="text" id="n2" name="n2" value="<?= htmlspecialchars($n2) ?>">

        <label for="operacao">Operação:</label>
        <select id="operacao" name="operacao">
            <option value="">-- Selecione --</option>
            <option value="somar" <?= $operacao == "somar" ? "selected" : "" ?>>Somar</option>
            <option value="subtrair" <?= $operacao == "subtrair" ? "selected" : "" ?>>Subtrair</option>
            <option value="multiplicar" <?= $operacao == "multiplicar" ? "selected" : "" ?>>Multiplicar</option>
            <option value="dividir" <?= $operacao == "dividir" ? "selected" : "" ?>>Dividir</option>
        </select>

        <input type="submit" value="Calcular">
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
