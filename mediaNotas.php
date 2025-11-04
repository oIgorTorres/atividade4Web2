<?php
// --- BLOCO DE PROCESSAMENTO (PHP) ---
$n1 = $n2 = "";
$media = null;
$erros = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Lista de notas para facilitar a validação
    $notas_postadas = [
        'n1' => $_POST['n1'] ?? null,
        'n2' => $_POST['n2'] ?? null,
    ];
    
    $notas_validas = [];
    
    $opcoes_filtro = ["options" => ["min_range" => 0, "max_range" => 10]];

    foreach ($notas_postadas as $chave => $valor) {
        if (isset($valor) && trim($valor) !== '') {

            $valor_corrigido = str_replace(',', '.', trim($valor));
            
            $nota_filtrada = filter_var($valor_corrigido, FILTER_VALIDATE_FLOAT, $opcoes_filtro);
            
            if ($nota_filtrada === false) {
                $erros[] = "Nota " . substr($chave, 1) . " inválida. Deve ser um número entre 0 e 10.";
                $$chave = htmlspecialchars(trim($valor)); 
            } else {
                $notas_validas[] = $nota_filtrada;
                $$chave = $nota_filtrada; 
            }
        } else {
            $erros[] = "Nota " . substr($chave, 1) . " é obrigatória.";
        }
    }


    
    if (count($notas_validas) == 2) {
        $soma = $notas_validas[0] + $notas_validas[1];
        $media = $soma / 2;
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ex. 4: Média Aritmética</title>
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
    <h2>Calculadora de Média Aritmética</h2>
    <p>Digite as três notas (de 0 a 10).</p>


    <?php
    if (count($erros) > 0) {
        echo "<div class='erro'><ul>";
        foreach ($erros as $erro) { echo "<li>$erro</li>"; }
        echo "</ul></div>";
    }
?>

     <form method="post" action="">
        <div>
            <label for="n1">Nota 1:</label>
            <input type="text" id="n1" name="n1" value="<?= htmlspecialchars($n1) ?>">
        </div>
        <div>
            <label for="n2">Nota 2:</label>
            <input type="text" id="n2" name="n2" value="<?= htmlspecialchars($n2) ?>">
        </div>
        <div>
            <input type="submit" value="Calcular Média">
        </div>
    </form>

     <?php
    if ($media !== null && count($erros) == 0) {
        $media_formatada = number_format($media, 2, ',', '.');
        echo "<div class='resultado'>A média das notas é: <strong>$media_formatada</strong></div>";
    }
    ?>
    <a id="voltar" href='./index.php'><strong> Voltar </strong> </a>
</div>

   


</body>
</html>
