<?php
$distancia = $combustivel = "";
$consumoMedio = null; 
$erros = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    
    if (isset($_POST['distancia']) && !empty(trim($_POST['distancia']))) {
        
        $distancia_str = str_replace(',', '.', trim($_POST['distancia']));
        $distancia_valido = filter_var($distancia_str, FILTER_VALIDATE_FLOAT);
        
        if ($distancia_valido === false || $distancia_valido <= 0) {
            $erros[] = "Valor inválido no campo de distância. Use apenas números (ex: 70.5).";
            $distancia = htmlspecialchars(trim($_POST['distancia']));
        } else {
            $distancia = $distancia_valido;
        }
    } else {
        $erros[] = "O campo de distância é obrigatório.";
    }



    
    if (isset($_POST['combustivel']) && !empty(trim($_POST['combustivel']))) {
        
        $combustivel_str = str_replace(',', '.', trim($_POST['combustivel']));
        $combustivel_valido = filter_var($combustivel_str, FILTER_VALIDATE_FLOAT);
        
        if ($combustivel_valido === false || $combustivel_valido <= 0) {
            $erros[] = "Valor inválido no campo de combustível. Use apenas números (ex: 70.5).";
            $combustivel = htmlspecialchars(trim($_POST['combustivel']));
        } else {
            $combustivel = $combustivel_valido;
        }
    } else {
        $erros[] = "O campo de combustível é obrigatório.";
    }


    if (count($erros) == 0) {
        $consumoMedio = $distancia / $combustivel;


    }

}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ex. 3: Calcular consumo de combustível</title>
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
        <h2>Cálculo de consumo médio de combustível</h2>

        <?php
        if (count($erros) > 0) {
            echo "<div class='erro'><ul>";
            foreach ($erros as $erro) { echo "<li>$erro</li>"; }
            echo "</ul></div>";
        }
        ?>

        <form method="post" action="">
            <label for="distancia">Distância percorrida (Km):</label>
            <input type="text" id="distancia" name="distancia" placeholder="Insira a distância" value="<?= htmlspecialchars($distancia) ?>">
            <label for="combustivel">Combustível abastecido (Litros):</label>
            <input type="text" id="combustivel" name="combustivel" placeholder="Insira o combustivel" value="<?= htmlspecialchars($combustivel) ?>">
            <input type="submit" value="Calcular valor">
        </form>

        <?php
        if ($consumoMedio !== null && count($erros) == 0) {
            $consumoMedio_formatado = number_format($consumoMedio, 2, ',', '.');
            echo "<div class='resultado'> <ul>";
            echo "<li>O consumo médio são/é de: <strong>$consumoMedio_formatado (km/l)</strong><br></li>";
            echo "</ul>
          
            </div>";
            
        }
        ?>
            <a id="voltar" href='./index.php'><strong> Voltar </strong> </a>
    </div>

</body>

</html>