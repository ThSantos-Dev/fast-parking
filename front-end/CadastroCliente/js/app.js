/**
 * Arquivo principal que chama as outras funções
 * @author Thales Santos
 * @date 14/06/2022
 */

'use strict'

// Imports
import {saveEntry} from './services/entry.js'
import {getVagas} from './services/vacancy.js'


/**
 * Função responsável por resgatar os dados para registrar entrada
 * @author Thales Santos 
 * @param {Void}
 * @return {Boolean}
 *  */
const getDataEntry = async () =>{
    // Regatando os valores dos selects
    const selectTipoVeiculo = document.getElementById('tipoVeiculo')
    const idTipoVeiculo     = selectTipoVeiculo.options[selectTipoVeiculo.selectedIndex].dataset.id

    const selectCor = document.getElementById('CorVeiculo')
    const idCor     = selectCor.options[selectCor.selectedIndex].dataset.id

    const selectFabricante = document.getElementById('lista-marca')
    const fabricante       = selectFabricante.options[selectFabricante.selectedIndex].text

    const selectModelo = document.getElementById('lista-modelos')
    const modelo       =  selectModelo.options[selectModelo.selectedIndex].text

    const selectVaga   = document.getElementById('vagaVeiculo')
    const idVaga       = selectVaga.options[selectVaga.selectedIndex].dataset.id

    // Montando um Objeto com todos os dados
    const dados = {
        cliente: {
            nome:       document.getElementById('NomeCliente').value,
            telefone:   document.getElementById('telefoneCliente').value
        },

        veiculo: {
            placa:          document.getElementById('placa').value,
            modelo:         modelo,
            fabricante:     fabricante,
            idCor:          idCor,
            idTipoVeiculo:  idTipoVeiculo
        },

        idVaga: idVaga
    }
    
    const response = await saveEntry(dados)
    console.log(response.message)

}

/**
 * Função responsável por criar uma lista com as vagas disponíveis
 * @author Thales Santos
 * @param {Void} 
 * @return {Void}
 */
const createVecancyList = async () =>{
    // Resgatando o id do tipo de veiculo
    const selectTipoVeiculo = document.getElementById('tipoVeiculo')
    const idTipoVeiculo     = selectTipoVeiculo.options[selectTipoVeiculo.selectedIndex].dataset.id
    
    // Resgatando as vagas disponíveis
    const vagas = await getVagas(idTipoVeiculo)

    // Variável que receberá as Options
    let options = '';

    if(vagas.length > 0) {
        await vagas.forEach((vaga) => {
            
            options += `<option data-id="${vaga.id}">${vaga.sigla} - ${vaga.tipo.toUpperCase()}</option>`
        })
    }

    // Adicionando as options no select de vagas
    document
        .getElementById('vagaVeiculo')
        .innerHTML = options !== '' ? options : '<option value="" selected>NÃO HÁ VAGAS DISPONÍVEIS</option>'
}


// Adiconando os eventos 
document
    .getElementById('cadastra')
    .addEventListener('click', getDataEntry)

document
    .getElementById('tipoVeiculo')
    .addEventListener('change', createVecancyList)