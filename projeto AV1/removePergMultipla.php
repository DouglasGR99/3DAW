<?php
if(isset($_POST['modificar'])) {
    $pergunta = $_POST['pergunta']; // Informação fornecida pelo usuário para identificar a linha a ser removida

    $linhas = file("perguntas.txt"); // Lê todas as linhas do arquivo em um array

    $indice_remover = -1;
    foreach($linhas as $indice => $linha) {
        $dados = explode(";", $linha);
        if($dados[0] == $pergunta) { // Verifica se a linha contém a pergunta fornecida
            $indice_remover = $indice;
            break;
        }
    }

    if($indice_remover !== -1) { // Se a linha for encontrada
        // Remove a linha da pergunta
        unset($linhas[$indice_remover]);

        // Remove as 5 linhas seguintes (respostas)
        for ($i = 1; $i <= 5; $i++) {
            unset($linhas[$indice_remover + $i]);
        }

        $arquivo = fopen("perguntas.txt", "w"); // Abre o arquivo em modo de escrita
        fwrite($arquivo, implode("", $linhas)); // Escreve as linhas restantes no arquivo
        fclose($arquivo);
        echo '<script type="text/javascript">
                alert("Pergunta e respostas removidas com sucesso!");
              </script>';
    } else {
        echo
        '<script type="text/javascript">
            let text = "Pergunta não encontrada, criar nova pergunta?";
            if (confirm(text) === true) {
                window.location.href = "criaPergMultipla.php";
            } else {
                window.location.href = "removePergMultipla.php";
            }
            </script>';
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remover Pergunta</title>
</head>
<body>
<header class="caixas">
    <h1>Remover Pergunta</h1>
    <nav>
        <a href="pagInicial.html"><button class="botaoBonito pagInicio">Voltar a pag Inicial</button></a>
        <a href="criaPergMultipla.php"><button class="botaoBonito pagCreate">Criar Pergunta</button></a>
        <a href="reportPerg.php"><button class="botaoBonito pagRead">Listar Perguntas</button></a>
        <a href="atualizaPergMultipla.php"><button class="botaoBonito pagUpdate">Atualizar Pergunta</button></a>
    </nav>
</header>

<main class="caixas">
    <form action="removePergMultipla.php" method="post">
        <label for="pergunta">Informe a pergunta a ser removida:</label>
        <input type="text" id="pergunta" name="pergunta">
        <br><br>
        <input type="submit" value="Remover pergunta" name="modificar" class="botaoBonito negativo">
    </form>
</main>
</body>
</html>