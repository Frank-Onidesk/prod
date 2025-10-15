// Funções para modais de gráficos

// Modal de Barras
function openBarChartModal() {
    document.getElementById('barChartModal').classList.remove('hidden');
}

function closeBarChartModal() {
    document.getElementById('barChartModal').classList.add('hidden');
}

// Modal de Linhas
function openLineChartModal() {
    document.getElementById('lineChartModal').classList.remove('hidden');
}

function closeLineChartModal() {
    document.getElementById('lineChartModal').classList.add('hidden');
}

// Modal de Colunas
function openColumnChartModal() {
    document.getElementById('columnChartModal').classList.remove('hidden');
}

function closeColumnChartModal() {
    document.getElementById('columnChartModal').classList.add('hidden');
}

// Pré-visualização
function previewChart() {
    const title = document.getElementById('chartTitle').value || 'Gráfico de Barras';
    const previewContainer = document.getElementById('previewContainer');
    
    previewContainer.innerHTML = `
        <div class="w-full h-full flex flex-col items-center justify-center">
            <h4 class="text-lg font-semibold mb-4">${title}</h4>
            <div class="bg-blue-100 p-8 rounded-lg">
                <p class="text-blue-700">Pré-visualização do gráfico de barras</p>
                <p class="text-sm text-blue-600 mt-2">Eixo X: ${document.getElementById('xAxis').value}</p>
                <p class="text-sm text-blue-600">Eixo Y: ${document.getElementById('yAxis').value}</p>
            </div>
        </div>
    `;
    
    closeBarChartModal();
    document.getElementById('chartPreview').classList.remove('hidden');
}

function previewLineChart() {
    const title = document.getElementById('lineChartTitle').value || 'Gráfico de Linhas';
    const previewContainer = document.getElementById('previewContainer');
    
    previewContainer.innerHTML = `
        <div class="w-full h-full flex flex-col items-center justify-center">
            <h4 class="text-lg font-semibold mb-4">${title}</h4>
            <div class="bg-green-100 p-8 rounded-lg">
                <p class="text-green-700">Pré-visualização do gráfico de linhas</p>
                <p class="text-sm text-green-600 mt-2">Período: ${document.getElementById('lineXAxis').value}</p>
            </div>
        </div>
    `;
    
    closeLineChartModal();
    document.getElementById('chartPreview').classList.remove('hidden');
}

function previewColumnChart() {
    const title = document.getElementById('columnChartTitle').value || 'Gráfico de Colunas';
    const previewContainer = document.getElementById('previewContainer');
    
    previewContainer.innerHTML = `
        <div class="w-full h-full flex flex-col items-center justify-center">
            <h4 class="text-lg font-semibold mb-4">${title}</h4>
            <div class="bg-purple-100 p-8 rounded-lg">
                <p class="text-purple-700">Pré-visualização do gráfico de colunas múltiplas</p>
                <p class="text-sm text-purple-600 mt-2">Tipo: ${document.getElementById('columnType').value}</p>
            </div>
        </div>
    `;
    
    closeColumnChartModal();
    document.getElementById('chartPreview').classList.remove('hidden');
}

function closePreview() {
    document.getElementById('chartPreview').classList.add('hidden');
}

// Adicionar ao Dashboard
function addToDashboard() {
    const title = document.getElementById('chartTitle').value || 'Novo Gráfico';
    const container = document.getElementById('customChartsContainer');
    
    const newChart = document.createElement('div');
    newChart.className = 'grid-card bg-white rounded-lg shadow p-6';
    newChart.innerHTML = `
        <h3 class="text-lg font-semibold mb-4">${title}</h3>
        <div class="h-64 bg-gray-100 rounded flex items-center justify-center">
            <p class="text-gray-500">Gráfico de Barras - ${document.getElementById('xAxis').value} vs ${document.getElementById('yAxis').value}</p>
        </div>
    `;
    
    container.appendChild(newChart);
    closeBarChartModal();
    showNotification('Gráfico adicionado ao dashboard!');
}

function addLineChartToDashboard() {
    const title = document.getElementById('lineChartTitle').value || 'Gráfico de Linhas';
    const container = document.getElementById('customChartsContainer');
    
    const newChart = document.createElement('div');
    newChart.className = 'grid-card bg-white rounded-lg shadow p-6';
    newChart.innerHTML = `
        <h3 class="text-lg font-semibold mb-4">${title}</h3>
        <div class="h-64 bg-gray-100 rounded flex items-center justify-center">
            <p class="text-gray-500">Gráfico de Linhas - Evolução temporal</p>
        </div>
    `;
    
    container.appendChild(newChart);
    closeLineChartModal();
    showNotification('Gráfico de linhas adicionado ao dashboard!');
}

function addColumnChartToDashboard() {
    const title = document.getElementById('columnChartTitle').value || 'Gráfico de Colunas';
    const container = document.getElementById('customChartsContainer');
    
    const newChart = document.createElement('div');
    newChart.className = 'grid-card bg-white rounded-lg shadow p-6';
    newChart.innerHTML = `
        <h3 class="text-lg font-semibold mb-4">${title}</h3>
        <div class="h-64 bg-gray-100 rounded flex items-center justify-center">
            <p class="text-gray-500">Gráfico de Colunas Múltiplas</p>
        </div>
    `;
    
    container.appendChild(newChart);
    closeColumnChartModal();
    showNotification('Gráfico de colunas adicionado ao dashboard!');
}

function addToDashboardFromPreview() {
    // Reutiliza a função correspondente baseada no modal aberto
    if (!document.getElementById('barChartModal').classList.contains('hidden')) {
        addToDashboard();
    } else if (!document.getElementById('lineChartModal').classList.contains('hidden')) {
        addLineChartToDashboard();
    } else if (!document.getElementById('columnChartModal').classList.contains('hidden')) {
        addColumnChartToDashboard();
    }
    
    closePreview();
}

// Notificações
function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Fechar modais ao clicar fora
document.addEventListener('DOMContentLoaded', function() {
    // Modal de barras
    document.getElementById('barChartModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeBarChartModal();
        }
    });

    // Modal de linhas
    document.getElementById('lineChartModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLineChartModal();
        }
    });

    // Modal de colunas
    document.getElementById('columnChartModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeColumnChartModal();
        }
    });

    // Preview
    document.getElementById('chartPreview').addEventListener('click', function(e) {
        if (e.target === this) {
            closePreview();
        }
    });
});