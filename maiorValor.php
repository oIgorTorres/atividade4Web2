<?php
$numeros = ["", "", "", "", ""]; 
$erros = [];
$resultado = "";
$maior = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $numeros = $_POST['numeros']; 

    $numeros_validos = [];

    foreach ($numeros as $indice => $valor) {
        $valor = trim($valor);
        $valor_corrigido = str_replace(',', '.', $valor); 

        if ($valor === "") {
            $erros[] = "O campo número " . ($indice + 1) . " é obrigatório.";
        } else if (!is_numeric($valor_corrigido)) {
            $erros[] = "O campo número " . ($indice + 1) . " deve conter apenas números.";
        } else {
            $numeros_validos[] = (float)$valor_corrigido;
        }

        
        $numeros[$indice] = htmlspecialchars($valor);
    }

    
    if (count($erros) == 0 && count($numeros_validos) > 0) {
        $maior = $numeros_validos[0]; 

        foreach ($numeros_validos as $num) {
            if ($num > $maior) {
                $maior = $num; 
            }
        }

        $resultado = "O maior número digitado foi: <strong>" . number_format($maior, 2, ",", ".") . "</strong>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Maior Número</title>
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
    <h2>Encontrar o Maior Número</h2>

    <?php
    if (count($erros) > 0) {
        echo "<div class='erro'><ul>";
        foreach ($erros as $erro) echo "<li>$erro</li>";
        echo "</ul></div>";
    }
    ?>

    <form method="post" action="">
        <?php for ($i = 0; $i < 5; $i++): ?>
            <label for="n<?= $i ?>">Número <?= $i + 1 ?>:</label>
            <input type="text" id="n<?= $i ?>" name="numeros[]" value="<?= htmlspecialchars($numeros[$i]) ?>">
        <?php endfor; ?>

        <input type="submit" value="Encontrar Maior">
    </form>

    <?php if ($resultado && count($erros) == 0): ?>
        <div class="resultado"><?= $resultado ?></div>
    <?php endif; ?>
    <a id="voltar" href='./index.php'><strong> Voltar </strong> </a>
</div>
</body>
</html>
