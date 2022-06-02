<?php
/**
 * Objetivo: Arquivo de funções que manipularão o BD
 * Autor: Thales Santos
 * Data: 02/06/2022
 * Versão: 1.0
 */

// Import do arquivo responsável pela Conexão do BD 
require_once('conexaoMySQL.php');

/** Função responsável por criar Moviementação (entrada do veículo) 
*   @author Thales Santos 
*   @param Array $dados Informações da movimentação 
*                       (Data/Hora entrada, id do veículo, id do cliente).
*   @return Bool True se foi inserido, senão, false.
* */
function insertMovimentacao($dados) {
    // Abrindo conexão com o BD
    $conexao = conexaoMySQL();

    // Variável de ambiente
    $statusResposta = (bool) false;

    // Script SQL para inserir uma Movimentação (entrada)
    $sql = "INSERT INTO tblMovimentacao(
                        dataEntrada,
                        horaEntrada,
                        idVaga,
                        idVeiculo
                    )
                    VALUES(
                        '{$dados['dataEntrada']}',
                        '{$dados['horaEntrada']}',
                         {$dados['idVaga']},
                         {$dados['idVeiculo']}
                )
    ";

    // Validação para verificar se o Script está correto
    if(mysqli_query($conexao, $sql)) {
        // Validação para verificar se houve inserção no BD
        if(mysqli_affected_rows($conexao)) 
            $statusResposta = true;
    }

    // Solicitando o fechamento da conexão 
    fecharConexaoMySQL($conexao);

    // Retornando o status da solicitação
    return $statusResposta;
}

?>