// =============================
// modals.js – Versão Segura e Organizada
// =============================
console.log('✅ modals.js carregado com sucesso');

// =============================
// Funções Genéricas de Modal
// =============================
function openModal(id) {
    const modal = document.getElementById(id);
    if (modal) modal.classList.remove('hidden');
}

function closeModal(id) {
    const modal = document.getElementById(id);
    if (modal) modal.classList.add('hidden');
}

// =============================
// Funções Específicas de Abertura
// =============================
function openBarChartModal() { openModal('barChartModal'); }
function openLineChartModal() { openModal('lineChartModal'); }
function openColumnChartModal() { openModal('columnChartModal'); }
function openPieChartModal() { openModal('pieChartModal'); closeRightSidebar?.(); }
function openComboChartModal() { openModal('comboChartModal'); closeRightSidebar?.(); }
function openStatCardModal() { openModal('statCardModal'); closeRightSidebar?.(); }
function openMultiStatsModal() { openModal('multiStatsModal'); closeRightSidebar?.(); }
function openTableModal() { openModal('tableModal'); closeRightSidebar?.(); }
function openMapModal() { openModal('mapModal'); closeRightSidebar?.(); }

// =============================
// Fechamento Específico
// =============================
function closeBarChartModal() { closeModal('barChartModal'); }
function closeLineChartModal() { closeModal('lineChartModal'); }
function closeColumnChartModal() { closeModal('columnChartModal'); }
function closePieChartModal() { closeModal('pieChartModal'); }
function closeComboChartModal() { closeModal('comboChartModal'); }
function closeStatCardModal() { closeModal('statCardModal'); }
function closeMultiStatsModal() { closeModal('multiStatsModal'); }
function closeTableModal() { closeModal('tableModal'); }
function closeMapModal() { closeModal('mapModal'); }
function closePreview() { closeModal('chartPreview'); }

// =============================
// Função de Notificação
// =============================
function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
    notification.textContent = message;
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 3000);
}

// =============================
// Funções de Pré-visualização
// =============================
function setPreview(title, bgColor, textColor, content) {
    const previewContainer = document.getElementById('previewContainer');
    if (!previewContainer) return;
    previewContainer.innerHTML = `
        <div class="w-full h-full flex flex-col items-center justify-center">
            <h4 class="text-lg font-semibold mb-4">${title}</h4>
            <div class="${bgColor} p-8 rounded-lg">
                ${content}
            </div>
        </div>
    `;
    openModal('chartPreview');
}

function previewChart() {
    const title = document.getElementById('chartTitle')?.value || 'Gráfico de Barras';
    const x = document.getElementById('xAxis')?.value || '';
    const y = document.getElementById('yAxis')?.value || '';
    setPreview(title, 'bg-blue-100', 'text-blue-700', `
        <p class="text-blue-700">Pré-visualização do gráfico de barras</p>
        <p class="text-sm text-blue-600 mt-2">Eixo X: ${x}</p>
        <p class="text-sm text-blue-600">Eixo Y: ${y}</p>
    `);
    closeBarChartModal();
}

function previewLineChart() {
    const title = document.getElementById('lineChartTitle')?.value || 'Gráfico de Linhas';
    const x = document.getElementById('lineXAxis')?.value || '';
    setPreview(title, 'bg-green-100', 'text-green-700', `
        <p class="text-green-700">Pré-visualização do gráfico de linhas</p>
        <p class="text-sm text-green-600 mt-2">Período: ${x}</p>
    `);
    closeLineChartModal();
}

function previewColumnChart() {
    const title = document.getElementById('columnChartTitle')?.value || 'Gráfico de Colunas';
    const type = document.getElementById('columnType')?.value || '';
    setPreview(title, 'bg-purple-100', 'text-purple-700', `
        <p class="text-purple-700">Pré-visualização do gráfico de colunas</p>
        <p class="text-sm text-purple-600 mt-2">Tipo: ${type}</p>
    `);
    closeColumnChartModal();
}

function previewPieChart() {
    const title = document.getElementById('pieChartTitle')?.value || 'Gráfico Circular';
    const categories = document.getElementById('pieCategories')?.value || '';
    setPreview(title, 'bg-pink-100', 'text-pink-700', `
        <p class="text-pink-700">Pré-visualização do gráfico circular</p>
        <p class="text-sm text-pink-600 mt-2">Categorias: ${categories}</p>
    `);
    closePieChartModal();
}

// =============================
// Adicionar ao Dashboard
// =============================
function addChartToDashboard(type, title, description) {
    const container = document.getElementById('customChartsContainer');
    if (!container) return;
    const newChart = document.createElement('div');
    newChart.className = 'grid-card bg-white rounded-lg shadow p-6';
    newChart.innerHTML = `
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">${title}</h3>
            <button onclick="this.parentElement.parentElement.remove()" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="h-64 bg-gray-50 rounded flex items-center justify-center">
            <p class="text-gray-500">${description}</p>
        </div>
    `;
    container.appendChild(newChart);
    showNotification(`${type} adicionado ao dashboard!`);
}

// =============================
// Fechar Modais ao clicar fora
// =============================
document.addEventListener('DOMContentLoaded', () => {
    console.log('🧩 Modals inicializados com segurança');
    const modals = [
        'barChartModal', 'lineChartModal', 'columnChartModal',
        'pieChartModal', 'comboChartModal', 'statCardModal',
        'multiStatsModal', 'tableModal', 'mapModal', 'chartPreview'
    ];

    modals.forEach(id => {
        const modal = document.getElementById(id);
        if (modal) {
            modal.addEventListener('click', e => {
                if (e.target === modal) closeModal(id);
            });
        }
    });
});
