<?php
/**
 * Objetivo: Arquivo de funções que manipularão o BD
 * Autor: Thales Santos
 * Data: 03/06/2022
 * Versão: 1.0
 */

// Import do arquivo responsável pela Conexão do BD 
require_once('conexaoMySQL.php');

/**
 * Função responsável por inserir novo Corredor
 * @author Thales Santos
 * @param Array $dados Informações do corredor: ID do Setor que o corredor pertencerá e nome.
 * @return Bool True se foi inserido e false caso de errado.
 */
function insertCorredor($dados) {
    // Abrindo a conexão com o BD
    $conexao = conexaoMySQL();

    // Variável de ambiente
    $statusResposta = (bool) false;

    // Script SQL para inserir um novo Corredor
    $sql = "INSERT INTO tblCorredor(
                            idCorredor,
                            nome
                    )
                    VALUES(
                            {$dados['idSetor']},
                            '{$dados['nome']}'
                    )";

    // Validação para verificar se o Script SQL está correto
    if(mysqli_query($conexao, $sql)) {
        // Validação para verificar se foi inserido novo registro
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    // Solicitando o fehcamento da conexão com o BD
    fecharConexaoMySQL($conexao);

    return $statusResposta;

}


/**
 * Função responsável por apagar um Corredor
 * @author Thales Santos
 * @param Int $id Id do corredor a ser apagado
 * @return Bool True se foi apagado , senão, false.
 */
function deleteCorredor($id) {
    // Abre a conexão com o BD
    $conexao = conexaoMySQL();

    // Variável de ambiente
    $statusResposta = (bool) false;

    // Script SQL para apagar um corredor
    $sql = "DELETE FROM tblCorredor 
                WHERE id = {$id}";

    // Validação para verificar se o Script SQL está correto
    if(mysqli_query($conexao, $sql)) {
        // Validação para verificar se o registro foi apagado
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    // Solicitando o fehcamento da conexão com o BD
    fecharConexaoMySQL($conexao);

    return $statusResposta;
}


/**
 * Função reponsável por atualizar um Corredor
 * @author Thales Santos
 * @param Array $dados Informações do corredor: nome, IDs: Corredor a ser atualizado e Setor que ele pertencerá
 * @return Bool True se foi atualizado, senão, false.
 */
function updateCorredor($dados) {
    // Abrindo conexão com o BD
    $conexao = conexaoMySQL();

    // Variável de ambiente
    $statusResposta = (bool) false;

    // Script SQL para atualizar um Corredor
    $sql = "UPDATE tblCorredor SET
                idSetor = {$dados['idSetor']},
                nome    = {$dados['nome']}
            WHERE id = '{$dados['id']}'";

    // Validação para verificar se o Script SQL está correto
    if(mysqli_query($conexao, $sql)) {
        // Validação para verificar se houve a atualização do registro
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    // Solicitando o fehcamento da conexão com o BD
    fecharConexaoMySQL($conexao);

    return $statusResposta;
}

/**
 * Função responsável por listar todos os Corredores
 * @param Void
 * @return Array Dados encontrados
 */
function selectAllCorredor() {
    // Abrindo conexão com o BD
    $conexao = conexaoMySQL();

    // Script SQL para listar todos os Corredores
    $sql = "SELECT 
                tblCorredor.id,
                tblCorredor.idSetor,
                tblCorredor.nome AS codigo,

                tblSetor.nome AS setor,

                tblPiso.id AS idPiso,
                tblPiso.nome AS piso

                FROM tblCorredor
                    INNER JOIN tblSetor
                        ON tblCorredor.idSetor = tblSetor.id
                    INNER JOIN tblPiso
                        ON tblSetor.idPiso = tblPiso.id";

}
?>