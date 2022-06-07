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
 * Função responsável por inserir nova Vaga
 * @author Thales Santos
 * @param Array $dados Informações da vaga: código, IDs: corredor, status da vaga, tipo da veículo
 * @return Bool True se foi inserido, senão, false.
 */
function insertVaga($dados) {
    // Abrindo a conexão com o BD
    $conexao = conexaoMySQL();

    // Variável de ambiente
    $statusResposta = (bool) false;

    // Script SQL para inserir nova Vaga
    $sql = "INSERT INTO tblVaga(
                            idCorredor,
                            ativo,
                            idTipoVeiculo,
                            codigo
                        )
                        VALUES(
                            {$dados['idCorredor']},
                            {$dados['ativo']},
                            {$dados['idTipoVeiculo']},
                            {$dados['codigo']})";

    // Validação para verificar se o Script SQL está correto
    if(mysqli_query($conexao, $sql)){
        // Validação para verificar se houve a inserção 
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    // Solicitando o fechamento da conexão com o BD
    fecharConexaoMySQL($conexao);

    // Retonando o status da solicitação
    return $statusResposta;
}

/**
 * Função responsável por atualizar os dados de uma Vaga
 * @author Thales Santos
 * @param Array $dados Informações da vaga: código, IDs: vaga, corredor, status da vaga, tipo da veículo
 * @return Bool True se foi inserido, senão, false.
 */
function updateVaga($dados) {
        // Abrindo a conexão com o BD
        $conexao = conexaoMySQL();

        // Variável de ambiente
        $statusResposta = (bool) false;
    
        // Script SQL para inserir nova Vaga
        $sql = "UPDATE tblVaga SET
                    idCorredor      = {$dados['idCorredor']},
                    ativo           = {$dados['status']},
                    idTipoVeiculo   = {$dados['idTipoVeiculo']},
                    codigo          = {$dados['codigo']}
                WHERE id = {$dados['id']}";
    
        // Validação para verificar se o Script SQL está correto
        if(mysqli_query($conexao, $sql)){
            // Validação para verificar se houve a inserção 
            if(mysqli_affected_rows($conexao))
                $statusResposta = true;
        }
    
        // Solicitando o fechamento da conexão com o BD
        fecharConexaoMySQL($conexao);
    
        // Retonando o status da solicitação
        return $statusResposta;
}

/**
 * Função responsável por apagar uma Vaga
 * @author Thales Santos
 * @param Int $id Id da vaga a ser apagada
 * @return Bool True se foi apagado , senão, false.
 */
function deleteVaga($id) {
    // Abre a conexão com o BD
    $conexao = conexaoMySQL();

    // Variável de ambiente
    $statusResposta = (bool) false;

    // Script SQL para apagar uma vaga
    $sql = "DELETE FROM tblVaga 
                WHERE id = {$id}";

    // Validação para verificar se o Script SQL está correto
    if(mysqli_query($conexao, $sql)) {
        // Validação para verificar se o registro foi apagado
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    // Solicitando o fechamento da conexão com o BD
    fecharConexaoMySQL($conexao);

    return $statusResposta;
}

/**
 * Função responsável por listar TODAS as Vagas
 * @author Thales Santos
 * @param Void
 * @return Array Dados encontrados
 */
function selectAllVagas() {
    // Abrindo a conexão com o BD
    $conexao = conexaoMySQL();

    // Script SQL para listar todas as vagas
    $sql = "SELECT
                tblVaga.id,
                tblVaga.idTipoVeiculo,
                tblVaga.idStatusVaga,
                tblVaga.codigo AS codigo,

                tblStatusVaga.nome AS status,
       
                tblCorredor.nome AS corredor,

                tblSetor.nome AS setor,

                tblPiso.nome AS piso,

                upper(concat_ws('-', tblPiso.nome, tblSetor.nome, tblCorredor.nome, tblVaga.codigo)) as sigla

                FROM tblVaga
                    INNER JOIN tblTipoVeiculo
                        ON tblVaga.idTipoVeiculo = tblTipoVeiculo.id

                    INNER JOIN tblStatusVaga
                        ON tblVaga.idStatusVaga = tblStatusVaga.id
                    
                    INNER JOIN tblCorredor
                       ON tblVaga.idCorredor = tblCorredor.id
                   INNER JOIN tblSetor
                       ON tblCorredor.idSetor = tblSetor.id
                   INNER JOIN tblPiso
                       ON tblSetor.idPiso = tblPiso.id";
    
    $resposta = mysqli_query($conexao, $sql);
   
       // Validação para verificar se houve retorno
       if($resposta) {
           // Convertendo os dados obtidos em  array
           $contador = 0;
           while($resultado = mysqli_fetch_assoc($resposta)) {
               // Montando um array personalizado com os dados obtidos
               $arrayDados[$contador] = array(
                   "id" => $resultado['id'],
   
                    "codigo" => $resultado['codigo'],
                    "sigla" => $resultado['sigla'],
                    "status" => array(
                        "id" => $resultado['idStatusVaga'],
                        "situacao" => $resultado['status']
                    ),

                    "localizacao" => array(
                        "corredor" => $resultado['corredor'],
                        "setor" => $resultado['setor'],
                        "piso" => $resultado['piso']
                    )
               );

            // Incrementando o contador para que não haja sobrescrita dos dados
            $contador++;
           }
       }
   
   
       // Solitando o fechamento da conexão com o BD
       fecharConexaoMySQL($conexao);
   
       // Retornando os dados encontrados ou false
       return isset($arrayDados) ? $arrayDados : false;
}

/**
 * Função responsável por buscar dados de uma Vaga pelo ID
 * @author Thales Santos
 * @param Int $id ID da vaga
 * @return Array Dados encontrados ou false
 */
function selectByIdVaga($id){
    // Abrindo conexão com o BD
    $conexao = conexaoMySQL();

    // Script SQL para listar todas as vagas
    $sql = "SELECT
                tblVaga.id,
                tblVaga.idTipoVeiculo,
                tblVaga.idStatusVaga,
                tblVaga.codigo AS codigo,

                tblStatusVaga.nome AS status,

                tblCorredor.nome AS corredor,

                tblSetor.nome AS setor,

                tblPiso.nome AS piso,

                upper(concat_ws('-', tblPiso.nome, tblSetor.nome, tblCorredor.nome, tblVaga.codigo)) as sigla

                FROM tblVaga
                    INNER JOIN tblTipoVeiculo
                        ON tblVaga.idTipoVeiculo = tblTipoVeiculo.id

                    INNER JOIN tblStatusVaga
                        ON tblVaga.idStatusVaga = tblStatusVaga.id
                    
                    INNER JOIN tblCorredor
                        ON tblVaga.idCorredor = tblCorredor.id
                    INNER JOIN tblSetor
                        ON tblCorredor.idSetor = tblSetor.id
                    INNER JOIN tblPiso
                        ON tblSetor.idPiso = tblPiso.id
            WHERE tblVaga.id = {$id}";

    $resposta = mysqli_query($conexao, $sql);

    // Validação para verificar se houve retorno
    if($resposta) {
        // Convertendo os dados obtidos em  array
        if($resultado = mysqli_fetch_assoc($resposta)) {
            // Montando um array personalizado com os dados obtidos
            $arrayDados = array(
                "id" => $resultado['id'],

                "codigo" => $resultado['codigo'],
                "sigla" => $resultado['sigla'],
                "status" => array(
                    "id" => $resultado['idStatusVaga'],
                    "situacao" => $resultado['status']
                ),

                "localizacao" => array(
                    "corredor" => $resultado['corredor'],
                    "setor" => $resultado['setor'],
                    "piso" => $resultado['piso']
                )
            );

        }
    }


    // Solitando o fechamento da conexão com o BD
    fecharConexaoMySQL($conexao);

    // Retornando os dados encontrados ou false
    return isset($arrayDados) ? $arrayDados : false;

}

/**
 * Função responsável por listar as vagas por Status - Ocupadas / Livres
 * @author Thales Santos
 * @param Int $id ID que representa o Status 
 * @return Array Dados encontrados
 */
function selectByStatusVaga($id) {
    // Abrindo conexão com o BD
    $conexao = conexaoMySQL();

    // Script SQL para listar todas as vagas por status
    $sql = "SELECT
                tblVaga.id,
                tblVaga.idTipoVeiculo,
                tblVaga.idStatusVaga,
                tblVaga.codigo AS codigo,

                tblStatusVaga.nome AS status,
       
                tblCorredor.nome AS corredor,

                tblSetor.nome AS setor,

                tblPiso.nome AS piso,

                upper(concat_ws('-', tblPiso.nome, tblSetor.nome, tblCorredor.nome, tblVaga.codigo)) as sigla

                FROM tblVaga
                    INNER JOIN tblTipoVeiculo
                        ON tblVaga.idTipoVeiculo = tblTipoVeiculo.id

                    INNER JOIN tblStatusVaga
                        ON tblVaga.idStatusVaga = tblStatusVaga.id
                    
                    INNER JOIN tblCorredor
                       ON tblVaga.idCorredor = tblCorredor.id
                   INNER JOIN tblSetor
                       ON tblCorredor.idSetor = tblSetor.id
                   INNER JOIN tblPiso
                       ON tblSetor.idPiso = tblPiso.id
            WHERE tblVaga.idStatusVaga = {$id}";
    
    $resposta = mysqli_query($conexao, $sql);
   
       // Validação para verificar se houve retorno
       if($resposta) {
           // Convertendo os dados obtidos em  array
           $contador = 0;
           while($resultado = mysqli_fetch_assoc($resposta)) {
               // Montando um array personalizado com os dados obtidos
               $arrayDados[$contador] = array(
                   "id" => $resultado['id'],
   
                    "codigo" => $resultado['codigo'],
                    "sigla" => $resultado['sigla'],
                    "status" => array(
                        "id" => $resultado['idStatusVaga'],
                        "situacao" => $resultado['status']
                    ),

                    "localizacao" => array(
                        "corredor" => $resultado['corredor'],
                        "setor" => $resultado['setor'],
                        "piso" => $resultado['piso']
                    )
               );

            // Incrementando o contador para que não haja sobrescrita dos dados
            $contador++;
           }
       }
   
   
       // Solitando o fechamento da conexão com o BD
       fecharConexaoMySQL($conexao);
   
       // Retornando os dados encontrados ou false
       return isset($arrayDados) ? $arrayDados : false;


}

/**
 * Função responsável por listar as vagas por Tipo - Carro / Moto
 * @author Thales Santos
 * @param Int $id ID que representa o Tipo da vaga 
 * @return Array Dados encontrados
 */
function selectByTipoVaga($id) {
    // Abrindo conexão com o BD
    $conexao = conexaoMySQL();

    // Script SQL para listar todas as vagas por tipo
    $sql = "SELECT
                tblVaga.id,
                tblVaga.idTipoVeiculo,
                tblVaga.idStatusVaga,
                tblVaga.codigo AS codigo,

                tblStatusVaga.nome AS status,
       
                tblCorredor.nome AS corredor,

                tblSetor.nome AS setor,

                tblPiso.nome AS piso,

                upper(concat_ws('-', tblPiso.nome, tblSetor.nome, tblCorredor.nome, tblVaga.codigo)) as sigla

                FROM tblVaga
                    INNER JOIN tblTipoVeiculo
                        ON tblVaga.idTipoVeiculo = tblTipoVeiculo.id

                    INNER JOIN tblStatusVaga
                        ON tblVaga.idStatusVaga = tblStatusVaga.id
                    
                    INNER JOIN tblCorredor
                       ON tblVaga.idCorredor = tblCorredor.id
                   INNER JOIN tblSetor
                       ON tblCorredor.idSetor = tblSetor.id
                   INNER JOIN tblPiso
                       ON tblSetor.idPiso = tblPiso.id
            WHERE tblVaga.idTipoVeiculo = {$id}";
    
    $resposta = mysqli_query($conexao, $sql);
   
       // Validação para verificar se houve retorno
       if($resposta) {
           // Convertendo os dados obtidos em  array
           $contador = 0;
           while($resultado = mysqli_fetch_assoc($resposta)) {
               // Montando um array personalizado com os dados obtidos
               $arrayDados[$contador] = array(
                   "id" => $resultado['id'],
   
                    "codigo" => $resultado['codigo'],
                    "sigla" => $resultado['sigla'],
                    "status" => array(
                        "id" => $resultado['idStatusVaga'],
                        "situacao" => $resultado['status']
                    ),

                    "localizacao" => array(
                        "corredor" => $resultado['corredor'],
                        "setor" => $resultado['setor'],
                        "piso" => $resultado['piso']
                    )
               );

            // Incrementando o contador para que não haja sobrescrita dos dados
            $contador++;
           }
       }
   
   
       // Solitando o fechamento da conexão com o BD
       fecharConexaoMySQL($conexao);
   
       // Retornando os dados encontrados ou false
       return isset($arrayDados) ? $arrayDados : false;


}



?>