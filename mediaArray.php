<?php
$notas = ["", "", "", "", ""]; 
$media = null;
$resultado = "";
$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $notas = $_POST['notas']; 

   
    $notas_validas = [];

    foreach ($notas as $indice => $valor) {
        $valor = trim($valor);
        $valor_corrigido = str_replace(',', '.', $valor); 

        
        if ($valor === "") {
            $erros[] = "A nota " . ($indice + 1) . " é obrigatória.";
        } 
        
        else if (filter_var($valor_corrigido, FILTER_VALIDATE_FLOAT, ["options" => ["min_range" => 0, "max_range" => 10]]) === false) {
            $erros[] = "A nota " . ($indice + 1) . " deve ser um número entre 0 e 10.";
        } 
        else {
            $notas_validas[] = (float)$valor_corrigido;
        }

        $notas[$indice] = htmlspecialchars($valor);
    }

    
    if (count($erros) == 0) {
        $soma = array_sum($notas_validas); 
        $media = $soma / count($notas_validas);
        $resultado = "Média das notas: <strong>" . number_format($media, 1, ",", ".") . "</strong>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ex. 13: Média de 5 Notas</title>
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
    <h2>Calcular Média de 5 Notas</h2>

    <?php
    if (count($erros) > 0) {
        echo "<div class='erro'><ul>";
        foreach ($erros as $erro) echo "<li>$erro</li>";
        echo "</ul></div>";
    }
    ?>

    <form method="post" action="">
        
        <?php for ($i = 0; $i < 5; $i++): ?>
            <label>Nota <?= $i + 1 ?>:</label>
            <input type="text" name="notas[]" value="<?= htmlspecialchars($notas[$i]) ?>">
        <?php endfor; ?>
        <input type="submit" value="Calcular Média">
    </form>


   <?php 
   
   if ($resultado && count($erros) == 0){
    echo "<div class='resultado'>$resultado</div>";
   }
   
?>
<a id="voltar" href='./index.php'><strong> Voltar </strong> </a>
</div>
</body>
</html>
