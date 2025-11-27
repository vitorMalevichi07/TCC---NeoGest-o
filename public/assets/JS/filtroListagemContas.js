const mapaAcentos = {
    'á': 'a','à': 'a','ã': 'a','â': 'a','é': 'e','è': 'e',
    'ê': 'e','í': 'i','ì': 'i','î': 'i','ó': 'o','ò': 'o',
    'õ': 'o','ô': 'o','ú': 'u','ù': 'u','û': 'u','ç': 'c'
};

// Inputs de filtro
let inputDescricao  = document.querySelector('input[name=busca_descricao]');
let selectCategoria = document.querySelector('select[name=filtro_categoria]');
let merda = document.querySelector('select[name=filtro_tipo]');
let inputData = document.querySelector('input[name=filtro_data]');

var data;

// Função para normalizar texto
function normalizarTexto(txt) {
    return txt.toLowerCase()
        .replace(/[áàãâéèêíìîóòõôúùûç]/g, m => mapaAcentos[m] || m)
        .replace(/[^a-z0-9\s]/g, '');
}

// Monta a tabela no DOM
const montarTabela = (data) => {
    let html = '';
    data.forEach(function(item){  
        function recorrencia (item) {
            switch(item.recorrencia) {
                case 0: return "Única";
                case 1: return "Semanal";
                case 2: return "15 dias";
                case 3: return "Mensal";
                case 4: return "Anual";
            }
            return "Não definida";
        }
        const formatarData = (dataStr) => {
            const [ano, mes, dia] = dataStr.split('-');
            const data = new Date(ano, mes - 1, dia); // meses começam em 0
            return data.toLocaleDateString('pt-BR');
        };
        function categoria(item) {
            switch(item.categoria) {
                case 0: return '<div class="pagar">Pagar</div>';
                case 1: return '<div class="receber">Receber</div>';
            }
            return '<div class="nao-definido">Não definido</div>';
        }
        function tipo (item){
            switch(item.tipo) {
                case 1: return "Fornecedor";
                case 2: return "Funcionário";
                case 3: return "Cliente";
                case 4: return "Gasto Fixo";
                case 5: return "Outros";
            }
            return "Não definido";
        }
        html += `<tr class="text-center text-align-center">`;
        html += `<td>${item.descricao}</td>`;
        html += `<td> R$${item.valor}</td>`;
        html += `<td>${categoria(item)}</td>`;
        html += `<td>${tipo(item)}</td>`;
        html += `<td>${recorrencia(item)}</td>`;
        html += `<td>${formatarData(item.data_vencimento)}</td>`;
        html += `<td>
                    <button  class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar" data-id="${item.id}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button  class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalExcluir" data-id="${item.id}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>`;
        html += `</tr>`;
    });
    document.querySelector('#body_table').innerHTML = html;
}

// Buscar dados do PHP com todos os filtros
function pegar_dados() {
    let descricao = inputDescricao ? normalizarTexto(inputDescricao.value) : '';
    let categoria = selectCategoria ? selectCategoria.value : '';
    let tipo = merda ? merda.value : '';
    let data_filtro = inputData ? inputData.value : '';
    let ajax = new XMLHttpRequest();

    const url = `http://localhost/Projeto-TCC/public/assets/PHP/modalFinanceiro/listagemContas/filtragem.php?descricao=${encodeURIComponent(descricao)}&categoria=${encodeURIComponent(categoria)}&bosta=${encodeURIComponent(tipo)}&data=${encodeURIComponent(data_filtro)}`;
    ajax.open("GET", url, true);

    ajax.onreadystatechange = () => {
        if (ajax.readyState == 4 && ajax.status == 200) {
            data = JSON.parse(ajax.responseText);
            montarTabela(data);
        }
    }
    ajax.send();
}

// Eventos para atualizar a tabela dinamicamente
[inputDescricao, selectCategoria, merda, inputData].forEach(el => {
    if (el) el.addEventListener('input', pegar_dados);
});

window.onload = () => {
    pegar_dados();
};