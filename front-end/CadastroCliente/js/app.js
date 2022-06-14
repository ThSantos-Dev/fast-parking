/**
 * Arquivo principal que chama as outras funções
 * @author Thales Santos
 * @date 14/06/2022
 */

'use strict'

// Imports
import {getVagas, saveEntry} from './services.js'


const teste = {
    "cliente": {
        "nome": "Thales Santos",
        "telefone": "4002-8922"
    },
    "veiculo": {
        "placa": "aaaa-000",
        "fabricante": "chevrolet",
        "modelo": "Cruze LTZ 2.0",
        "idCor": 1,
        "idTipoVeiculo": 8
    },
    "idVaga": 3
}
 saveEntry(teste)
    

/**
 * Função responsável por resgatar os dados para registrar entrada
 * 
 */

