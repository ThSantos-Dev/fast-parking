<?php
/*****************************************************************************
 * Objetivo: Arquivo responsável pela manipulação de dados de Movimentação (entrada / saida)
 *              Obs(Este arquivo fará ponte entre a API e a MODEL)
 * Autor: Thales
 * Data: 08/06/2022
 * Versão: 1.0
 */

// Import do arquivo de Configurações
require_once('../module/config.php');

// Import do arquivo de Modelagem de Movimentação
require_once(SRC . 'model/bd/movimentacao.php');

/**
 * Função responsável por registrar uma Entrada
 * @author Thales Santos
 * @param Array $dados Dados: id do veículo e da vaga
 * @return Array Dados da entrada gerada ou mensagem de erro
 */
function registrarEntrada($dados) {
    // Validação para verificar se há dados para inserção
    if(!empty($dados)){
        // Validação para verificar se os ids foram passados e se são válidos
        if(
            is_numeric($dados['idVeiculo']) && $dados['idVeiculo'] > 0
            && is_numeric($dados['idVaga']) && $dados['idVaga'] > 0
        ) {

            // Chamando a model para inserir a Movimentação
            $resposta = insertMovimentacao($dados);
                        
            if(is_numeric($resposta) && $resposta > 0) {
                // Chamando a model para buscar as informações de registro
                $dados = selectByIdMovimentacao($resposta);

                // Validando o retorno do BD
                if(is_array($dados)) 
                    return $dados;
                elseif(is_bool($dados) && $dados == false)
                    return MESSAGES['error']['IDs'][1];
            }
            else
                return MESSAGES['error']['Insert'][0];
        } else
            return MESSAGES['error']['IDs'][0];

    } else 
        return MESSAGES['error']['Data'][0];

}

// $dados = array(
//     "idVeiculo" => 1,
//     "idVaga" => 2,

// );

// echo '<pre>';
//     echo print_r(registrarEntrada($dados));
// echo '</pre>';














?>