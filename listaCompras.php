<?php
$itens_disponiveis = ["Arroz", "Feijão", "Leite", "Ovos"];
$itens = [];
$erros = [];
$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $itens = $_POST['itens'] ?? [];

    
    if (empty($itens)) {
        $erros[] = "Selecione pelo menos um item.";
    }

    if (count($erros) == 0) {
        $resultado = "Itens selecionados:<ul>";
        foreach ($itens as $item) {
            $resultado .= "<li>" . htmlspecialchars($item) . "</li>";
        }
        $resultado .= "</ul>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ex. 14: Lista de Compras</title>
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
    <h2>Selecione seus Itens</h2>

    <?php
    if (count($erros) > 0) {
        echo "<div class='erro'><ul>";
        foreach ($erros as $erro) echo "<li>$erro</li>";
        echo "</ul></div>";
    }
    ?>

    <form method="post" action="">
        <?php foreach ($itens_disponiveis as $item): ?>
            <label>
                <input type="checkbox" name="itens[]" value="<?= htmlspecialchars($item) ?>" <?= in_array($item, $itens) ? 'checked' : '' ?>>
                <?= htmlspecialchars($item) ?>
            </label><br>
        <?php endforeach; ?>

        <input type="submit" value="Enviar">
    </form>

    <?php 
    if ($resultado && count($erros) == 0) {
        echo "<div class='resultado'>$resultado</div>";
    }
    ?>
    <a id="voltar" href='./index.php'><strong> Voltar </strong> </a>
</div>
</body>
</html>
