/**
 * Arquivo responsável por realizar as requisições para a API
 * @author Thales Santos
 * @date 14/06/2022
 */

'use strict'

// URL BASE DA API
const BASE_API = 'http://localhost/senai/fastparking/api'

/*_________     Vagas    __________ */

/**
 * Função responsável por retornar as vagas livres para seleção
 * @author Thales Santos
 * @param {Void}
 * @return {JSON}
 */
const getVagas = async () => {
    // Realizando requisição para a API
    const response = await fetch(`${BASE_API}/vaga/livres`)

    // Resgatando o JSON da requisição
    const data = await response.json()

    console.log(data)

    // Retornando os dados
    return data
}



/*_________     Entrada    __________ */

/**
 * Função responsável por registrar a entrada 
 * @author Thales Santos
 * @param {Object} data Dados da entrada
 * @return {Void}
 */
const saveEntry = async (data) => {
    // Configurando a requisição
    const options = {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'content-type': 'application/json'
        }
    }

    // Realizando a requisição
    const response = await fetch(`${BASE_API}/movimentacao/entrada`, options)

    // Pegando os dados retornados pela API 
    const teste = await response.json()

    console.log(teste)

}



// Exports
export {getVagas, saveEntry}