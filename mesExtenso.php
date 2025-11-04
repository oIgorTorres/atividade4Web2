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
                $resultado = "1 - Janeiro";
                break;
            case 2:
                $resultado = "2 - Fevereiro";
                break;
            case 3:
                $resultado = "3 - Março";
                break;
            case 4:
                $resultado = "4 - Abril";
                break;
            case 5:
                $resultado = "5 - Maio";
                break;
            case 6:
                $resultado = "6 - Junho";
                break;
            case 7:
                $resultado = "7 - Julho";
                break;
            case 8:
                $resultado = "8 - Agosto";
                break;
            case 9:
                $resultado = "9 - Setembro";
                break;
            case 10:
                $resultado = "10 - Outubro";
                break;
            case 11:
                $resultado = "11 - Novembro";
                break;
            case 12:
                $resultado = "12 - Dezembro";
                break;
            default:
                $erros[] = "Número inválido! Digite um número entre 1 e 12.";
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ex. 9: Cálculo com mês extenso</title> 
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
    <h2>Cálculo com mês extenso com Switch</h2> 

    <?php
    if (count($erros) > 0) {
        echo "<div class='erro'><ul>";
        foreach ($erros as $erro) { echo "<li>$erro</li>"; }
        echo "</ul></div>";
    }
    ?>

    <form method="post" action="">
        <label for="dia">Insira um número de 1 a 12:</label> 
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
