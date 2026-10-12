<?php

//Conexão com o banco
require_once "conexao.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $acao = $_POST["acao"];


switch ($acao) {

    case "cadastrar":

        $cpf = $_POST["cpf"];
        $nome = $_POST["nome"];
        $data_nascimento = $_POST["data_nascimento"];
        $telefone = $_POST["telefone"];
        $email = $_POST["email"];

        $sql = "INSERT INTO pacientes
                (cpf, nome, data_nascimento, telefone, email)
                VALUES
                (:cpf, :nome, :data_nascimento, :telefone, :email)";

        $stmt = $conexao->prepare($sql);

        $stmt->execute([
            ":cpf" => $cpf,
            ":nome" => $nome,
            ":data_nascimento" => $data_nascimento,
            ":telefone" => $telefone,
            ":email" => $email
        ]);

        break;

    case "editar":

        $id = $_POST["id"];
        $cpf = $_POST["cpf"];
        $nome = $_POST["nome"];
        $data_nascimento = $_POST["data_nascimento"];
        $telefone = $_POST["telefone"];
        $email = $_POST["email"];

        $sql = "UPDATE pacientes
                SET cpf = :cpf,
                    nome = :nome,
                    data_nascimento = :data_nascimento,
                    telefone = :telefone,
                    email = :email
                WHERE id = :id";

        $stmt = $conexao->prepare($sql);

        $stmt->execute([
            ":cpf" => $cpf,
            ":nome" => $nome,
            ":data_nascimento" => $data_nascimento,
            ":telefone" => $telefone,
            ":email" => $email,
            ":id" => $id
        ]);

        break;

    case "excluir":

        $id = $_POST["id"];

        $sql = "DELETE FROM pacientes WHERE id = :id";

        $stmt = $conexao->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        break;

    default:
        http_response_code(400);
        exit("Ação inválida.");
}

    header("Location: index.php");
    exit;
}


$sql = "SELECT id, cpf, nome, data_nascimento, telefone, email, criado_em
        FROM pacientes
        ORDER BY id DESC";

$consulta = $conexao->query($sql);

$pacientes = $consulta->fetchAll(PDO::FETCH_ASSOC);

?>




<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pacientes</title>
</head>
<body>

<button type="button" onclick="document.getElementById('modalCadastro').showModal()">
    + Cadastrar paciente
</button>

<dialog id="modalCadastro">
    <h2>Cadastrar paciente</h2>

    <form method="POST" action="index.php">

        <input type="hidden" name="acao" value="cadastrar">

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required>
        <br><br>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>

        <label for="data_nascimento">Data de nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required>
        <br><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone">
        <br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email">
        <br><br>

        <button type="submit">Cadastrar</button>

        <button type="button" onclick="document.getElementById('modalCadastro').close()">
            Cancelar
        </button>

    </form>
</dialog>

    <h1>Pacientes cadastrados</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>CPF</th>
                <th>Nome</th>
                <th>Data de nascimento</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Criado em</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($pacientes as $paciente): ?>
                <tr>
                    <td><?= htmlspecialchars($paciente["id"]) ?></td>
                    <td><?= htmlspecialchars($paciente["cpf"]) ?></td>
                    <td><?= htmlspecialchars($paciente["nome"]) ?></td>
                    <td><?= htmlspecialchars($paciente["data_nascimento"]) ?></td>
                    <td><?= htmlspecialchars($paciente["telefone"]) ?></td>
                    <td><?= htmlspecialchars($paciente["email"]) ?></td>
                    <td><?= htmlspecialchars($paciente["criado_em"]) ?></td>
                    <td>
                        <button
                            type="button"
                            onclick="document.getElementById('modalEditar<?= $paciente['id'] ?>').showModal()"
                        >
                            Editar
                        </button>
                        <form method="POST" action="index.php"
                            onsubmit="return confirm('Tem certeza de que deseja excluir este paciente?');"
                            style="display: inline;">

                            <input type="hidden" name="acao" value="excluir">

                            <input
                                type="hidden"
                                name="id"
                                value="<?= htmlspecialchars($paciente['id']) ?>"
                            >

                            <button type="submit">Excluir</button>

                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php foreach ($pacientes as $paciente): ?>

    <dialog id="modalEditar<?= $paciente['id'] ?>">

        <h2>Editar paciente</h2>

        <form method="POST" action="index.php">

            <input type="hidden" name="acao" value="editar">

            <input
                type="hidden"
                name="id"
                value="<?= htmlspecialchars($paciente['id']) ?>"
            >

            <label for="cpf<?= $paciente['id'] ?>">CPF:</label>
            <input
                type="text"
                id="cpf<?= $paciente['id'] ?>"
                name="cpf"
                value="<?= htmlspecialchars($paciente['cpf'], ENT_QUOTES, 'UTF-8') ?>"
                required
            >
            <br><br>

            <label for="nome<?= $paciente['id'] ?>">Nome:</label>
            <input
                type="text"
                id="nome<?= $paciente['id'] ?>"
                name="nome"
                value="<?= htmlspecialchars($paciente['nome'], ENT_QUOTES, 'UTF-8') ?>"
                required
            >
            <br><br>

            <label for="data<?= $paciente['id'] ?>">Data de nascimento:</label>
            <input
                type="date"
                id="data<?= $paciente['id'] ?>"
                name="data_nascimento"
                value="<?= htmlspecialchars($paciente['data_nascimento'], ENT_QUOTES, 'UTF-8') ?>"
                required
            >
            <br><br>

            <label for="telefone<?= $paciente['id'] ?>">Telefone:</label>
            <input
                type="text"
                id="telefone<?= $paciente['id'] ?>"
                name="telefone"
                value="<?= htmlspecialchars($paciente['telefone'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
            >
            <br><br>

            <label for="email<?= $paciente['id'] ?>">E-mail:</label>
            <input
                type="email"
                id="email<?= $paciente['id'] ?>"
                name="email"
                value="<?= htmlspecialchars($paciente['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
            >
            <br><br>

            <button type="submit">Salvar alterações</button>

            <button
                type="button"
                onclick="document.getElementById('modalEditar<?= $paciente['id'] ?>').close()"
            >
                Cancelar
            </button>

        </form>

    </dialog>

<?php endforeach; ?>
</body>
</html>