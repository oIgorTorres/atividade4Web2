<?php
// --- BLOCO DE PROCESSAMENTO (PHP) ---
$reais = "";
$resultado_dolar = null; 
$erros = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    
    if (isset($_POST['reais']) && !empty(trim($_POST['reais']))) {
        
        $reais_str = str_replace(',', '.', trim($_POST['reais']));
        $reais_valido = filter_var($reais_str, FILTER_VALIDATE_FLOAT);
        
        if ($reais_valido === false || $reais_valido <= 0) {
            $erros[] = "Valor inválido. Use apenas números (ex: 70.5).";
            $reais = htmlspecialchars(trim($_POST['reais']));
        } else {
            $reais = $reais_valido;
        }
    } else {
        $erros[] = "O campo de reais é obrigatório.";
    }


    if (count($erros) == 0) {
        $cotacao = 5.39; 
        $resultado_dolar = $reais / $cotacao; 


    }

}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ex. 1: Cálculo de reais para dolar</title>
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
        text-align: left;
    }

      #voltar{
            display: flex;
            padding-top: 25px;
        }

    </style>
</head>

<body>

<div>
        <h2>Conversor de real para dólar</h2>

        <?php
        if (count($erros) > 0) {
            echo "<div class='erro'><ul>";
            foreach ($erros as $erro) { echo "<li>$erro</li>"; }
            echo "</ul></div>";
        }
        ?>

        <form method="post" action="">
            <label for="reais">Valor em reais (R$):</label>
            <input type="text" id="reais" name="reais" placeholder="" value="<?= htmlspecialchars($reais) ?>">
            <input type="submit" value="Calcular valor">
        </form>

        <?php
        if ($resultado_dolar !== null && count($erros) == 0) {
            $dolar_formatado = number_format($resultado_dolar, 2, ',', '.');
            echo "<div class='resultado'>";
            echo "O valor de $reais reais em dólar será de: <strong>US$ $dolar_formatado</strong><br>";
            echo "</div>";
            
        }
        ?>
        <a id="voltar" href='./index.php'><strong> Voltar </strong> </a>
    </div>

    
</body>

</html>