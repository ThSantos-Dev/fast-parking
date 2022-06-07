<?php
/*****************************************************************************
 * Objetivo: Arquivo responsável pela manipulação de dados de Corredor (estrutura)
 *              Obs(Este arquivo fará ponte entre a API e a MODEL)
 * Autor: Thales
 * Data: 06/06/2022
 * Versão: 1.0
 */

// Import do arquivo de Configurações
require_once('../module/config.php');

// Import do arquivo de Modelagem de Corredor
require_once(SRC . 'model/bd/corredor.php');


/**
 * Função responsável por tratar os dados para inserção de Corredor
 * @author Thales Santos
 * @param Array $dados Informações do Corredor - nome e telefone
 * @return Bool True se foi inserido, se não Array com uma mensagem de erro
 */
function inserirCorredor($dados) {
    // Validação para verificar se há conteúdo para inserção de Corredor
    if(!empty($dados)){
        // Validação para verificar se o campo obrigatório 'Nome' e 'idSetor' foi informado
        if(!empty($dados['nome']) && !empty($dados['idSetor'])){
            // Validação para verificar se o ID do setor é válido
            if(is_numeric($dados['idSetor']) && $dados['idSetor'] > 0) {
                // Chamando a model e passando os dados 
                if(insertCorredor($dados))
                    return true;
                else
                    return MESSAGES['error']['Insert'][0];
            } else
                return MESSAGES['error']['IDs'][0];

        } else 
            return MESSAGES['error']['Data'][1];
    } else
        return MESSAGES['error']['Data'][0];
 }


/**
 * Função responsável por tratar os dados para excluir um Corredor
 * @author Thales Santos
 * @param Int $id ID do corredor a ser excluído
 * @return Bool True se foi excluido, senão, um Array com uma mensagem de erro
 *  */ 
function excluirCorredor($id) {
    // Validação para verificar se o id informado é válido
    if(is_numeric($id) && $id > 0) {
        // Validando o retorno  do BD
        if(deleteCorredor($id))
            return true;
        else
            return MESSAGES['error']['Delete'][0];
    } else
        return MESSAGES['error']['IDs'][0] . " ID do Corredor inválido."; 
}

/**
 * Função responsável por tratar os dados para atuzalização de Corredor
 * @author Thales Santos
 * @param Array $dados Informações do Corredor (nome e IDs: setor e corredor)
 * @return Bool True se o registro foi atualizado ou um Array com uma mensagem de erro
 */
function atualizarCorredor($dados) {
    // Validação para verificar se há conteúdo para atualização de Corredor
    if(!empty($dados)){
        if(is_numeric($dados['id']) && $dados['id'] > 0){
            // Validação para verificar se o campo obrigatório 'Nome' e 'idSetor' foi informado
            if(!empty($dados['nome']) && !empty($dados['idSetor'])){
                // Validação para verificar se o ID do setor é válido
                if(is_numeric($dados['idSetor']) && $dados['idSetor'] > 0) {
                    // Chamando a model e passando os dados 
                    if(updateCorredor($dados))
                        return true;
                    else
                        return MESSAGES['error']['Insert'][0];
                } else
                    return MESSAGES['error']['IDs'][0] . " ID do Setor é inválido";

            } else 
                return MESSAGES['error']['Data'][1];
        } else 
            return MESSAGES['error']['IDs'][0] . " ID do Corredor é inválido";
    } else
        return MESSAGES['error']['Data'][0];
}

/**
 * Função responsável por retornar os dados de todos os Corredores cadastrados
 * @author Thales Santos
 * @param Void
 * @return Array Dados encontrados ou uma mensagem de erro
 *  */ 
function listaCorredores() {
    // Chamando a função responsável por retornar os dados de todos os Corredores
    $resposta = selectAllCorredores();

    // Validação para verificar se houve retorno de dados por parte do BD
    if(is_array($resposta) && count($resposta) > 0)  
        return $resposta;
    elseif(is_bool($resposta) && $resposta == false) 
        return MESSAGES['error']['Select'][0];
}
?>