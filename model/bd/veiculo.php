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
 * Função responsável por inserir um Veículo
 * @author Thales Santos
 * @param Array $dados Informações do veículo
 *                      (placa, fabricante, modelo, Id: cor, tipo do veículo e cliente)
 * @return Bool True se foi inserido, senão, false. 
 */
function insertVeiculo($dados) {
    // Abrindo a conexão com o BD
    $conexao = conexaoMySQL();

    // Variável de ambiente
    $statusResposta = (bool) false;

    // Script SQL para inserir um Veículo
    $sql = "INSERT INTO tblVeiculo(
                        placa,
                        fabricante,
                        modelo,
                        idCor,
                        idTipoVeiculo,
                        idCliente
                    )
                    VALUES(
                        '{$dados['placa']}',
                        '{$dados['fabricante']}',
                        '{$dados['modelo']}',
                        {$dados['idCor']},
                        {$dados['idTipoVeiculo']},
                        {$dados['idCliente']}
                    )";

    // Validação para verificar se o Script SQL está correto
    if(mysqli_query($conexao, $sql)) {
        // Validação para verificar se houve a inserção
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    // Solicitando o funções da conexão
    fecharConexaoMySQL($conexao);

    return $statusResposta;
}

/**
 * Função responsável por listar TODOS os veículos estacionados
 * @author Thales Santos
 * @param Array $filtros Filtros desejados
 *                               (Tipo e Placa)
 * @return Array Dados encontrados, ou false se não houve registros encontrados.
 */
function selectByEstacionado($filtros = array())
{
    // Abrindo conexão com o BD
    $conexao = conexaoMySQL();

    // Script SQL para listar TODOS os veículos estacionados
    $sql = "SELECT 
                tblMovimentacao.id,
                tblMovimentacao.dataEntrada,
                tblMovimentacao.horaEntrada,
                tblMovimentacao.dataSaida,
                tblMovimentacao.horaSaida,
                tblMovimentacao.valor,

                tblVeiculo.placa,
                tblVeiculo.fabricante,
                tblVeiculo.modelo,
                
                tblCor.nome as cor,

                tblTipoVeiculo.nome as tipo,

                tblCliente.nome as cliente,
                tblCliente.telefone,
                
                upper(concat_ws('-', tblPiso.nome, tblSetor.nome, tblCorredor.nome, tblVaga.codigo)) as sigla,

                tblVaga.codigo as codigo,
                
                tblCorredor.nome as corredor,

                tblSetor.nome as setor,

                tblPiso.nome as piso

                FROM tblMovimentacao
                    INNER JOIN tblVeiculo 
                        ON tblMovimentacao.idVeiculo = tblVeiculo.id
                    INNER JOIN tblCor
                        ON tblVeiculo.idCor = tblCor.id
                    INNER JOIN tblTipoVeiculo
                        ON tblVeiculo.idTipoVeiculo = tblTipoVeiculo.id
                    INNER JOIN tblCliente
                        ON tblVeiculo.idCliente = tblCliente.id
                    
                    INNER JOIN tblVaga
                        ON tblMovimentacao.idVaga = tblVaga.id

                    INNER JOIN tblCorredor
                        ON tblVaga.idCorredor = tblCorredor.id
                    INNER JOIN tblSetor
                        ON tblCorredor.idSetor = tblSetor.id
                    INNER JOIN tblPiso
                        ON tblSetor.idPiso = tblPiso.id
                    
                WHERE tblMovimentacao.dataSaida is null";

    // Validação para verificar se os filtros foram passados 
    if(!empty($filtros)) {
        // Validação para verificar se o filtro por TIPO foi solicitado 
        if (is_numeric($filtros['tipo']['id'])) {
            // Script SQL para listar TODOS os veículos estacionados pelo tipo
            $sql = "SELECT 
                        tblMovimentacao.id,
                        tblMovimentacao.dataEntrada,
                        tblMovimentacao.horaEntrada,
                        tblMovimentacao.dataSaida,
                        tblMovimentacao.horaSaida,
                        tblMovimentacao.valor,

                        tblVeiculo.placa,
                        tblVeiculo.fabricante,
                        tblVeiculo.modelo,
                        
                        tblCor.nome as cor,

                        tblTipoVeiculo.nome as tipo,

                        tblCliente.nome as cliente,
                        tblCliente.telefone,
                        
                        upper(concat_ws('-', tblPiso.nome, tblSetor.nome, tblCorredor.nome, tblVaga.codigo)) as sigla,

                        tblVaga.codigo as codigo,
                        
                        tblCorredor.nome as corredor,

                        tblSetor.nome as setor,

                        tblPiso.nome as piso

                        FROM tblMovimentacao
                            INNER JOIN tblVeiculo 
                                ON tblMovimentacao.idVeiculo = tblVeiculo.id
                            INNER JOIN tblCor
                                ON tblVeiculo.idCor = tblCor.id
                            INNER JOIN tblTipoVeiculo
                                ON tblVeiculo.idTipoVeiculo = tblTipoVeiculo.id
                            INNER JOIN tblCliente
                                ON tblVeiculo.idCliente = tblCliente.id
                            
                            INNER JOIN tblVaga
                                ON tblMovimentacao.idVaga = tblVaga.id

                            INNER JOIN tblCorredor
                                ON tblVaga.idCorredor = tblCorredor.id
                            INNER JOIN tblSetor
                                ON tblCorredor.idSetor = tblSetor.id
                            INNER JOIN tblPiso
                                ON tblSetor.idPiso = tblPiso.id
                            
                        WHERE tblMovimentacao.dataSaida is null
                            AND tblVeiculo.idTipoVeiculo = {$filtros['tipo']['id']}";
        } 
        elseif(!empty($filtros['placa'])) {
            $sql = "SELECT 
                        tblMovimentacao.id,
                        tblMovimentacao.dataEntrada,
                        tblMovimentacao.horaEntrada,
                        tblMovimentacao.dataSaida,
                        tblMovimentacao.horaSaida,
                        tblMovimentacao.valor,

                        tblVeiculo.placa,
                        tblVeiculo.fabricante,
                        tblVeiculo.modelo,
                        
                        tblCor.nome as cor,

                        tblTipoVeiculo.nome as tipo,

                        tblCliente.nome as cliente,
                        tblCliente.telefone,
                        
                        upper(concat_ws('-', tblPiso.nome, tblSetor.nome, tblCorredor.nome, tblVaga.codigo)) as sigla,

                        tblVaga.codigo as codigo,
                        
                        tblCorredor.nome as corredor,

                        tblSetor.nome as setor,

                        tblPiso.nome as piso

                        FROM tblMovimentacao
                            INNER JOIN tblVeiculo 
                                ON tblMovimentacao.idVeiculo = tblVeiculo.id
                            INNER JOIN tblCor
                                ON tblVeiculo.idCor = tblCor.id
                            INNER JOIN tblTipoVeiculo
                                ON tblVeiculo.idTipoVeiculo = tblTipoVeiculo.id
                            INNER JOIN tblCliente
                                ON tblVeiculo.idCliente = tblCliente.id
                            
                            INNER JOIN tblVaga
                                ON tblMovimentacao.idVaga = tblVaga.id

                            INNER JOIN tblCorredor
                                ON tblVaga.idCorredor = tblCorredor.id
                            INNER JOIN tblSetor
                                ON tblCorredor.idSetor = tblSetor.id
                            INNER JOIN tblPiso
                                ON tblSetor.idPiso = tblPiso.id
                            
                    WHERE tblMovimentacao.dataSaida is null
                        AND tblVeiculo.placa = '%{$filtros['placa']}%'";
        }
        // Validação para verificar se o filtro por TIPO  e Placa foi solicitado 
        elseif (!empty($filtros['tipo']['id']) && !empty($filtros['placa'])) {
            // Script SQL para listar TODOS os veículos estacionados pelo tipo e placa
            $sql = "SELECT 
                        tblMovimentacao.id,
                        tblMovimentacao.dataEntrada,
                        tblMovimentacao.horaEntrada,
                        tblMovimentacao.dataSaida,
                        tblMovimentacao.horaSaida,
                        tblMovimentacao.valor,

                        tblVeiculo.placa,
                        tblVeiculo.fabricante,
                        tblVeiculo.modelo,
                        
                        tblCor.nome as cor,

                        tblTipoVeiculo.nome as tipo,

                        tblCliente.nome as cliente,
                        tblCliente.telefone,
                        
                        upper(concat_ws('-', tblPiso.nome, tblSetor.nome, tblCorredor.nome, tblVaga.codigo)) as sigla,

                        tblVaga.codigo as codigo,
                        
                        tblCorredor.nome as corredor,

                        tblSetor.nome as setor,

                        tblPiso.nome as piso

                        FROM tblMovimentacao
                            INNER JOIN tblVeiculo 
                                ON tblMovimentacao.idVeiculo = tblVeiculo.id
                            INNER JOIN tblCor
                                ON tblVeiculo.idCor = tblCor.id
                            INNER JOIN tblTipoVeiculo
                                ON tblVeiculo.idTipoVeiculo = tblTipoVeiculo.id
                            INNER JOIN tblCliente
                                ON tblVeiculo.idCliente = tblCliente.id
                            
                            INNER JOIN tblVaga
                                ON tblMovimentacao.idVaga = tblVaga.id

                            INNER JOIN tblCorredor
                                ON tblVaga.idCorredor = tblCorredor.id
                            INNER JOIN tblSetor
                                ON tblCorredor.idSetor = tblSetor.id
                            INNER JOIN tblPiso
                                ON tblSetor.idPiso = tblPiso.id
                            
                        WHERE tblMovimentacao.dataSaida is null
                            AND tblVeiculo.idTipoVeiculo = {$filtros['tipo']['id']}
                            AND tblVeiculo.placa = '%{$filtros['placa']}%'";
        }
    }

    $resposta = mysqli_query($conexao, $sql);

    // Validação para verificar se houve dados encontrados
    if ($resposta) {
        // Convertendo os dados obtidos em  array
        $contador = 0;
        while ($resultado = mysqli_fetch_assoc($resposta)) {
            // Montando um array personalizado com os dados obtidos
            $arraydados[$contador] = array(
                "id" => $resultado['id'],

                "cliente" => array(
                    "nome" => $resultado['cliente'],
                    "telefone" => $resultado['telefone']
                ),

                "veiculo" => array(
                    "placa" => $resultado['placa'],
                    "fabricante" => $resultado['fabricante'],
                    "modelo" => $resultado['modelo'],
                    "cor" => $resultado['cor'],
                    "tipo" => $resultado['tipo']
                ),

                "vaga" => array(
                    "codigo" => $resultado['codigo'],
                    "sigla" => $resultado['sigla'],

                    "localizacao" => array(
                        "corredor" => $resultado['corredor'],
                        "setor" => $resultado['setor'],
                        "piso" => $resultado['piso']
                    )
                ),


                "entrada" => array(
                    "data" => $resultado['dataEntrada'],
                    "horario" => $resultado['horaEntrada']
                ),
                "saida" => array(
                    "data" => $resultado['dataSaida'],
                    "horario" => $resultado['horaSaida']
                )
            );

            // Incrementando o contador para que não haja sobrescrita dos dados
            $contador++;
        }
    }

    // Solitando o fechamento da conexão com o BD
    fecharConexaoMySQL($conexao);

    // Retornando os dados encontrados ou false
    return isset($arraydados) ? $arraydados : false;
}

/**
 * Função responsável por buscar os veículos por Tipo
 * @author Thales Santos
 * @param Int ID do Tipo do veículo
 * @return Array Dados encontrados ou false caso não haja resultados
 */
function selectByTipo($id)
{
    // Abrindo conexão com o BD
    $conexao = conexaoMySQL();

    // Script SQL para listar TODOS os veículos por Tipo
    $sql = "SELECT 
                tblMovimentacao.id,
                tblMovimentacao.dataEntrada,
                tblMovimentacao.horaEntrada,
                tblMovimentacao.dataSaida,
                tblMovimentacao.horaSaida,
                tblMovimentacao.valor,

                tblVeiculo.placa,
                tblVeiculo.fabricante,
                tblVeiculo.modelo,
                
                tblCor.nome as cor,

                tblTipoVeiculo.nome as tipo,

                tblCliente.nome as cliente,
                tblCliente.telefone,
                
                upper(concat_ws('-', tblPiso.nome, tblSetor.nome, tblCorredor.nome, tblVaga.codigo)) as sigla,

                tblVaga.codigo as codigo,
                
                tblCorredor.nome as corredor,

                tblSetor.nome as setor,

                tblPiso.nome as piso

                FROM tblMovimentacao
                    INNER JOIN tblVeiculo 
                        ON tblMovimentacao.idVeiculo = tblVeiculo.id
                    INNER JOIN tblCor
                        ON tblVeiculo.idCor = tblCor.id
                    INNER JOIN tblTipoVeiculo
                        ON tblVeiculo.idTipoVeiculo = tblTipoVeiculo.id

                    INNER JOIN tblCliente
                        ON tblVeiculo.idCliente = tblCliente.id
                    
                    INNER JOIN tblVaga
                        ON tblMovimentacao.idVaga = tblVaga.id

                    INNER JOIN tblCorredor
                        ON tblVaga.idCorredor = tblCorredor.id
                    INNER JOIN tblSetor
                        ON tblCorredor.idSetor = tblSetor.id
                    INNER JOIN tblPiso
                        ON tblSetor.idPiso = tblPiso.id
                    
            WHERE tblVeiculo.idTipoVeiculo = {$id}";

    $resposta = mysqli_query($conexao, $sql);

    // Validação para verificar se houve dados encontrados
    if ($resposta) {
        // Convertendo os dados obtidos em  array
        $contador = 0;
        while ($resultado = mysqli_fetch_assoc($resposta)) {
            // Montando um array personalizado com os dados obtidos
            $arraydados[$contador] = array(
                "id" => $resultado['id'],

                "cliente" => array(
                    "nome" => $resultado['cliente'],
                    "telefone" => $resultado['telefone']
                ),

                "veiculo" => array(
                    "placa" => $resultado['placa'],
                    "fabricante" => $resultado['fabricante'],
                    "modelo" => $resultado['modelo'],
                    "cor" => $resultado['cor'],
                    "tipo" => $resultado['tipo']
                ),

                "vaga" => array(
                    "codigo" => $resultado['codigo'],
                    "sigla" => $resultado['sigla'],

                    "localizacao" => array(
                        "corredor" => $resultado['corredor'],
                        "setor" => $resultado['setor'],
                        "piso" => $resultado['piso']
                    )
                ),


                "entrada" => array(
                    "data" => $resultado['dataEntrada'],
                    "horario" => $resultado['horaEntrada']
                ),
                "saida" => array(
                    "data" => $resultado['dataSaida'],
                    "horario" => $resultado['horaSaida']
                )
            );

            // Incrementando o contador para que não haja sobrescrita dos dados
            $contador++;
        }
    }

    // Solitando o fechamento da conexão com o BD
    fecharConexaoMySQL($conexao);

    // Retornando os dados encontrados ou false
    return isset($arraydados) ? $arraydados : false;
}

/**
 * Função responsável por buscar os veículos por Placa
 * @author Thales Santos
 * @param String $placa Placa do veículo
 * @return Array Dados encontrados ou false caso não haja resultados
 */
function selectByPlaca($placa)
{
    // Abrindo conexão com o BD
    $conexao = conexaoMySQL();

    // Script SQL para listar TODOS os veículos por Tipo
    $sql = "SELECT 
                tblMovimentacao.id,
                tblMovimentacao.dataEntrada,
                tblMovimentacao.horaEntrada,
                tblMovimentacao.dataSaida,
                tblMovimentacao.horaSaida,
                tblMovimentacao.valor,

                tblVeiculo.placa,
                tblVeiculo.fabricante,
                tblVeiculo.modelo,
                
                tblCor.nome as cor,

                tblTipoVeiculo.nome as tipo,

                tblCliente.nome as cliente,
                tblCliente.telefone,
                
                upper(concat_ws('-', tblPiso.nome, tblSetor.nome, tblCorredor.nome, tblVaga.codigo)) as sigla,

                tblVaga.codigo as codigo,
                
                tblCorredor.nome as corredor,

                tblSetor.nome as setor,

                tblPiso.nome as piso

                FROM tblMovimentacao
                    INNER JOIN tblVeiculo 
                        ON tblMovimentacao.idVeiculo = tblVeiculo.id
                    INNER JOIN tblCor
                        ON tblVeiculo.idCor = tblCor.id
                    INNER JOIN tblTipoVeiculo
                        ON tblVeiculo.idTipoVeiculo = tblTipoVeiculo.id

                    INNER JOIN tblCliente
                        ON tblVeiculo.idCliente = tblCliente.id
                    
                    INNER JOIN tblVaga
                        ON tblMovimentacao.idVaga = tblVaga.id

                    INNER JOIN tblCorredor
                        ON tblVaga.idCorredor = tblCorredor.id
                    INNER JOIN tblSetor
                        ON tblCorredor.idSetor = tblSetor.id
                    INNER JOIN tblPiso
                        ON tblSetor.idPiso = tblPiso.id
                    
            WHERE tblVeiculo.placa LIKE '%{$placa}%'";

    $resposta = mysqli_query($conexao, $sql);

    // Validação para verificar se houve dados encontrados
    if ($resposta) {
        // Convertendo os dados obtidos em  array
        $contador = 0;
        while ($resultado = mysqli_fetch_assoc($resposta)) {
            // Montando um array personalizado com os dados obtidos
            $arraydados[$contador] = array(
                "id" => $resultado['id'],

                "cliente" => array(
                    "nome" => $resultado['cliente'],
                    "telefone" => $resultado['telefone']
                ),

                "veiculo" => array(
                    "placa" => $resultado['placa'],
                    "fabricante" => $resultado['fabricante'],
                    "modelo" => $resultado['modelo'],
                    "cor" => $resultado['cor'],
                    "tipo" => $resultado['tipo']
                ),

                "vaga" => array(
                    "codigo" => $resultado['codigo'],
                    "sigla" => $resultado['sigla'],

                    "localizacao" => array(
                        "corredor" => $resultado['corredor'],
                        "setor" => $resultado['setor'],
                        "piso" => $resultado['piso']
                    )
                ),


                "entrada" => array(
                    "data" => $resultado['dataEntrada'],
                    "horario" => $resultado['horaEntrada']
                ),
                "saida" => array(
                    "data" => $resultado['dataSaida'],
                    "horario" => $resultado['horaSaida']
                )
            );

            // Incrementando o contador para que não haja sobrescrita dos dados
            $contador++;
        }
    }
}



?>