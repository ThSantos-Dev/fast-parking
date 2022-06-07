<?php
/*****************************************************************************
 * Objetivo: Arquivo responsável pela manipulação de dados de Vaga (estrutura)
 *              Obs(Este arquivo fará ponte entre a API e a MODEL)
 * Autor: Thales
 * Data: 07/06/2022
 * Versão: 1.0
 */

// Import do arquivo de Configurações
require_once('../module/config.php');

// Import do arquivo de Modelagem de Vaga
require_once(SRC . 'model/bd/vaga.php');

/**
 * Função responsável por tratar os dados para inserção de Vaga
 * @author Thales Santos
 * @param Array $dados Informações da vaga: código, IDs: corredor, status e tipo de veículo
 * @return Bool True se foi inserido, senão um Array com uma mensagem de erro
 */
function inserirVaga($dados) {
    // Validação para verificar se os dados foram passados
    if(!empty($dados)) {
        // Validação para verificar se os campos obrigatórios foram informados: código, IDs: corredor, status e tipo de veículo e se são válidos
        if(
            is_numeric($dados['idCorredor']) && $dados['idCorredor'] > 0 
            && is_numeric($dados['idStatus']) && $dados['idStatus'] > 0 
            && is_numeric($dados['idTipoVeiculo']) && $dados['idTipoVeiculo'] > 0 
            && is_string($dados['codigo'])
        ){
            // Montando um array com os dados de acordo com o Model
            $vaga = array(
                "idCorredor"    => $dados['idCorredor'],
                "idStatusVaga"  => $dados['idStatus'],
                "idTipoVeiculo" => $dados['idTipoVeiculo'],
                "codigo"        => $dados['codigo']
            );

            // Chamando a model responsável por inserir nova vaga
            // Validando o retorno do BD
            if(insertVaga($vaga))
                return true;
            else 
                return MESSAGES['error']['Insert'][0];
        }
    } else 
        return MESSAGES['error']['Data'][0];
}

/**
 * Função responsável por tratar os dados para atualização de Vaga
 * @author Thales Santos
 * @param Array $dados Informações da vaga: código, IDs: corredor, status e tipo de veículo
 * @return Bool True se foi inserido, senão um Array com uma mensagem de erro
 */
function atualizarVaga($dados) {
    // Validação para verificar se os dados foram passados
    if(!empty($dados)) {
        // Validação para verificar se os campos obrigatórios foram informados: código, IDs: vaga, corredor, status e tipo de veículo e se são válidos
        if(
            is_numeric($dados['idVaga']) && $dados['idVaga'] > 0 &&
            is_numeric($dados['idCorredor']) && $dados['idCorredor'] > 0 
            && is_numeric($dados['idStatus']) && $dados['idStatus'] > 0 
            && is_numeric($dados['idTipoVeiculo']) && $dados['idTipoVeiculo'] > 0 
            && is_string($dados['codigo'])
        ){

            // Montando um array com os dados de acordo com o Model
            $vaga = array(
                "id"            => $dados['idVaga'],
                "idCorredor"    => $dados['idCorredor'],
                "idStatusVaga"  => $dados['idStatus'],
                "idTipoVeiculo" => $dados['idTipoVeiculo'],
                "codigo"        => $dados['codigo']
            );

            // Chamando a model responsável por atualizar vaga
            // Validando o retorno do BD
            if(updateVaga($vaga))
                return true;
            else 
                return MESSAGES['error']['Update'][0];
        }
    } else 
        return MESSAGES['error']['Data'][0];
}

/**
 * Função responsável por tratar os dados para pagar uma Vaga
 * @author Thales Santos
 * @param Int $id ID da vaga a ser apagada
 * @return Bool True se foi apagado, senão, Array com uma mensagem de erro.
 */
function excluirVaga($id) {
    // Validação para verificar se o id informado é válido
    if(is_numeric($id) && $id > 0) {
        // Validando o retorno  do BD
        if(deleteVaga($id))
            return true;
        else
            return MESSAGES['error']['Delete'][0];
    } else
        return MESSAGES['error']['IDs'][0] . " ID da inválido."; 
}


/**
 * Função responsável por buscar uma vaga pelo ID
 * @author Thales Santos
 * @param Int $id ID da vaga
 * @return Array Dados encontrados ou Mensagem de erro
 */
function buscarVaga($id) {
    // Validação para verificar se o id informado é válido
    if(is_numeric($id) && $id > 0) {
        // Chamando o arquivo de Model responsável pela busca de Vaga por ID
        $resposta = selectByIdVaga($id);

        // Validação para verificar o retorno do BD
        if(is_array($resposta) && count($resposta) > 0) 
            return $resposta;
        elseif(is_bool($resposta) && $resposta == false)
            return MESSAGES['error']['Select'][0];
    } else 
        return MESSAGES['error']['IDs'][0];

}

/**
 * Função responsável por retornar todos as vagas
 * @author Thales Santos
 * @param Void
 * @return Array Dados encontrados ou Mensagem de erro
 */
function listaVagas() {
    // Chamando a model responsável pela listagem das vagas e validando o seu retorno
    $resposta = selectAllVagas();
    
    // Validação para verificar se há dados retornados
    if(is_array($resposta)) 
        return $resposta;
    elseif(is_bool($resposta) && $resposta == false) 
        return MESSAGES['error']['Select'][0];
}


/**
 * Função responsável por listar as vagas por determinado tipo de Status
 * @author Thales Santos
 * @param Int $id ID do Status que deseja
 * @return Array Dados encontrados ou Mensagem de erro
 */
function listaVagasPorStatus($id) {
    // Validação para verificar se o ID do Status informado é um ID válido
    if(is_numeric($id) && $id > 0) {
        // Chamando a função da Model que faz a listagem por status
        $resposta = selectByStatusVaga($id);
        
        // Validando o retorno do BD
        if(is_array($resposta) && count($resposta) > 0)
            return $resposta;
        else 
            return MESSAGES['error']['Select'][0]; 

    } else 
        return MESSAGES['error']['IDs'][0];
}

/**
 * Função responsável por listar as vagas por Tipo de Veículo
 * @author Thales Santos
 * @param Int $id Tipo do veículo desejado
 * @return Array Dados encontrados ou com uma Mensagem de erro
 */
function listaVagasPorTipoVeiculo($id) {
        // Validação para verificar se o ID do Status informado é um ID válido
        if(is_numeric($id) && $id > 0) {
            // Chamando a função da Model que faz a listagem por status
            $resposta = selectByTipoVaga($id);
            
            // Validando o retorno do BD
            if(is_array($resposta) && count($resposta) > 0)
                return $resposta;
            else 
                return MESSAGES['error']['Select'][0]; 
    
        } else 
            return MESSAGES['error']['IDs'][0];
}












?>