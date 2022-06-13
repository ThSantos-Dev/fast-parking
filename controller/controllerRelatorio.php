<?php
/*****************************************************************************
 * Objetivo: Arquivo responsável pela manipulação de dados de Relatório
 *              Obs(Este arquivo fará ponte entre a API e a MODEL)
 * Autor: Thales
 * Data: 06/06/2022
 * Versão: 1.0
 */

// Import do arquivo de Configurações
require_once('../module/config.php');

// Import do arquivo de Modelagem de Relatório
require_once(SRC . 'model/bd/relatorio.php');

/**
 * Função responsável por trazer o relatório diário de rendimentos
 * @author Thales Santos
 * @param Date $data Data desejada
 * @return Array Dados encontrados
 */
function geraRelatorioDiario($data) {
    // Validação para verificar se a data informada é uma data válida
    if(!empty($data)){
        // Chamando a model para listar o rendimento diário de acordo com a data especificada
        $resposta = dailyReport($data);

        // Validação para verificar o retorno do BD
        if(is_array($resposta)) 
            // Retornando os dados 
            return $resposta;
        else 
            return MESSAGES['error']['Select'][0];

    } else 
        return MESSAGES['error']['Data'][1];
}

/**
 * Função reponsável por trazer o relatório mensal de rendimentos
 * @author Thlaes Santos
 * 
 * 
 */






?>