<?php
$notas = ["", "", "", "", ""]; // valores padrão para repopular o formulário
$media = null;
$resultado = "";
$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $notas = $_POST['notas']; // recebe todas as notas em um array

    // Validação
    $notas_validas = [];

    foreach ($notas as $indice => $valor) {
        $valor = trim($valor);
        $valor_corrigido = str_replace(',', '.', $valor); // permite números com vírgula

        // Verifica se está vazio
        if ($valor === "") {
            $erros[] = "A nota " . ($indice + 1) . " é obrigatória.";
        } 

        // Verifica se é número válido entre 0 e 10
        elseif (filter_var($valor_corrigido, FILTER_VALIDATE_FLOAT, ["options" => ["min_range" => 0, "max_range" => 10]]) === false) {
            $erros[] = "A nota " . ($indice + 1) . " deve ser um número entre 0 e 10.";
        } 
        else {
            $notas_validas[] = (float)$valor_corrigido;
        }

        $notas[$indice] = htmlspecialchars($valor);
    }

    // Se não houver erros, calcula a média
    if (count($erros) == 0) {
        $soma = array_sum($notas_validas); // soma todos os valores
        $media = $soma / count($notas_validas);
        $resultado = "Média das notas: <strong>" . number_format($media, 1, ",", ".") . "</strong>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Média de 5 Notas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        div {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            width: 300px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            text-align: center;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 6px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .erro {
            color: #b10000;
            background-color: #ffe5e5;
            border: 1px solid #b10000;
            padding: 8px;
            border-radius: 6px;
            margin-bottom: 10px;
        }
        .resultado {
            color: #0056b3;
            background-color: #e8f4ff;
            border: 1px solid #0056b3;
            padding: 10px;
            border-radius: 6px;
            margin-top: 15px;
            text-align: center;
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
        <div>
            <label for="nota1">Nota 1:</label>
            <input type="text" id="nota1" name="notas[]" value="<?= $notas[0] ?>">
        </div>
        <div>
            <label for="nota2">Nota 2:</label>
            <input type="text" id="nota2" name="notas[]" value="<?= $notas[1] ?>">
        </div>
        <div>
            <label for="nota3">Nota 3:</label>
            <input type="text" id="nota3" name="notas[]" value="<?= $notas[2] ?>">
        </div>
        <div>
            <label for="nota4">Nota 4:</label>
            <input type="text" id="nota4" name="notas[]" value="<?= $notas[3] ?>">
        </div>
        <div>
            <label for="nota5">Nota 5:</label>
            <input type="text" id="nota5" name="notas[]" value="<?= $notas[4] ?>">
        </div>

        <div>
            <input type="submit" value="Calcular Média">
        </div>
    </form>

    
    <?php if ($resultado): ?>
        <div class="resultado"><?= $resultado ?></div>
    <?php endif; ?>
</div>
</body>
</html>
