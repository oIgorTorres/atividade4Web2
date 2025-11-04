<?php
$dia = "";
$resultado = "";
$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $dia = $_POST["dia"];

    
    if ($dia === "" || !is_numeric($dia)) {
        $erros[] = "Por favor, insira um número.";
    } else {
        $dia = (int)$dia;

        
        switch ($dia) {
            case 1:
                $resultado = "1 - Domingo";
                break;
            case 2:
                $resultado = "2 - Segunda-feira";
                break;
            case 3:
                $resultado = "3 - Terça-feira";
                break;
            case 4:
                $resultado = "4 - Quarta-feira";
                break;
            case 5:
                $resultado = "5 - Quinta-feira";
                break;
            case 6:
                $resultado = "6 - Sexta-feira";
                break;
            case 7:
                $resultado = "7 - Sábado";
                break;
            default:
                $erros[] = "Número inválido! Digite um número entre 1 e 7.";
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ex. 7: Cálculo usando switch</title> 
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
    <h2>Cálculo de dias da semana</h2> 

    <?php
    if (count($erros) > 0) {
        echo "<div class='erro'><ul>";
        foreach ($erros as $erro) { echo "<li>$erro</li>"; }
        echo "</ul></div>";
    }
    ?>

    <form method="post" action="">
        <label for="dia">Insira um número de 1 a 7:</label> 
        <input type="text" id="dia" name="dia" placeholder="" value="<?= htmlspecialchars($dia) ?>"> 
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
