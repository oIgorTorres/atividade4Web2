<?php
$ano_nascimento = "";
$idade = null;
$resultado = "";
$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ano_nascimento = trim($_POST['ano_nascimento']);

    if ($ano_nascimento === "" || filter_var($ano_nascimento, FILTER_VALIDATE_INT) === false || $ano_nascimento < 1900 || $ano_nascimento > date("Y")) {
        $erros[] = "Por favor, insira um ano de nascimento válido.";
    } else {

        $ano_nascimento = (int)$ano_nascimento;

        $idade = date("Y") - $ano_nascimento;

    }

     if (count($erros) == 0) {
    
        if ($idade >= 18 && $idade < 70) {
            $resultado = "Idade: $idade anos — Voto Obrigatório.";
        } elseif (($idade >= 16 && $idade < 18) || $idade >= 70) {
            $resultado = "Idade: $idade anos — Voto Facultativo.";
        } else {
            $resultado = "Idade: $idade anos — Não pode votar.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ex. 5: Calculadora de Idade e Voto</title>
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
        box-sizing: border-box;
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
    <h2>Calculadora de Idade e Situação do Voto</h2>

    <?php
    if (count($erros) > 0) {
        echo "<div class='erro'><ul>";
        foreach ($erros as $erro) { echo "<li>$erro</li>"; }
        echo "</ul></div>";
    }
    ?>

    <form method="post" action="">
        <label for="ano_nascimento">Ano de Nascimento:</label>
        <input type="text" id="ano_nascimento" name="ano_nascimento" value="<?= htmlspecialchars($ano_nascimento) ?>">
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
