<?php
$base = $altura = "";
$area = null; 
$perimetro = null;
$erros = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    
    if (isset($_POST['base']) && !empty(trim($_POST['base']))) {
        
        $base_str = str_replace(',', '.', trim($_POST['base']));
        $base_valido = filter_var($base_str, FILTER_VALIDATE_FLOAT);
        
        if ($base_valido === false || $base_valido <= 0) {
            $erros[] = "Valor inválido no campo de base. Use apenas números (ex: 70.5).";
            $base = htmlspecialchars(trim($_POST['base']));
        } else {
            $base = $base_valido;
        }
    } else {
        $erros[] = "O campo de base é obrigatório.";
    }



    
    if (isset($_POST['altura']) && !empty(trim($_POST['altura']))) {
        
        $altura_str = str_replace(',', '.', trim($_POST['altura']));
        $altura_valido = filter_var($altura_str, FILTER_VALIDATE_FLOAT);
        
        if ($altura_valido === false || $altura_valido <= 0) {
            $erros[] = "Valor inválido no campo de altura. Use apenas números (ex: 70.5).";
            $altura = htmlspecialchars(trim($_POST['altura']));
        } else {
            $altura = $altura_valido;
        }
    } else {
        $erros[] = "O campo de altura é obrigatório.";
    }


    if (count($erros) == 0) {
        $area = $base * $altura;
        $perimetro = (2 *($base + $altura));


    }

}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ex. 2: Cálculo de área e perímetro de retângulo </title>
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
        <h2>Cálculo de área e perímetro de retângulo</h2>

        <?php
        if (count($erros) > 0) {
            echo "<div class='erro'><ul>";
            foreach ($erros as $erro) { echo "<li>$erro</li>"; }
            echo "</ul></div>";
        }
        ?>

        <form method="post" action="">
            <label for="base">Tamanho da base (Metros):</label>
            <input type="text" id="base" name="base" placeholder="Insira a base" value="<?= htmlspecialchars($base) ?>">
            <label for="altura">Tamanho da altura (Metros):</label>
            <input type="text" id="altura" name="altura" placeholder="Insira a altura" value="<?= htmlspecialchars($altura) ?>">
            <input type="submit" value="Calcular valor">
        </form>

        <?php
        if ($area !== null && $perimetro !== null && count($erros) == 0) {
            $area_formatado = number_format($area, 2, ',', '.');
            $perimetro_formatado = number_format($perimetro, 2, ',', '.');
            echo "<div class='resultado'> <ul>";
            echo "<li>A área do Retângulo são/é de: <strong>$area_formatado m²</strong><br></li>";
            echo "<li>O perímetro do Retângulo são/é de: <strong>$perimetro_formatado m²</strong><br></li>";
            echo "</ul>
          
            </div>";
            
        }
        ?>
            <a id="voltar" href='./index.php'><strong> Voltar </strong> </a>
    </div>

</body>

</html>