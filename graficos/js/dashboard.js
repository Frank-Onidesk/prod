// dashboard.js - Sistema Principal do Dashboard
console.log('🚀 Dashboard inicializado');

// ========== VARIÁVEIS GLOBAIS ==========
let currentChartType = '';
let currentChartConfig = {};
let chartCounter = 0;

// ========== SIDEBAR DIREITA ==========
function toggleRightSidebar() {
    const rightSidebar = document.getElementById('sidebarRight');
    
    if (rightSidebar) {
        rightSidebar.classList.toggle('hidden');
        
        // Mobile overlay
        if (window.innerWidth < 768 && !rightSidebar.classList.contains('hidden')) {
            createRightSidebarOverlay();
        } else {
            removeRightSidebarOverlay();
        }
    }
}

function closeRightSidebar() {
    const rightSidebar = document.getElementById('sidebarRight');
    if (rightSidebar) {
        rightSidebar.classList.add('hidden');
    }
    removeRightSidebarOverlay();
}

function createRightSidebarOverlay() {
    removeRightSidebarOverlay();
    
    const overlay = document.createElement('div');
    overlay.id = 'rightSidebarOverlay';
    overlay.className = 'fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden';
    overlay.onclick = closeRightSidebar;
    document.body.appendChild(overlay);
}

function removeRightSidebarOverlay() {
    const existingOverlay = document.getElementById('rightSidebarOverlay');
    if (existingOverlay) {
        existingOverlay.remove();
    }
}

// ========== SIDEBAR ESQUERDA ==========
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const btnOutside = document.getElementById('btnOutside');
    const btnInside = document.getElementById('btnInside');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (sidebar) {
        sidebar.classList.toggle('hidden');
        
        if (btnOutside) btnOutside.classList.toggle('hidden');
        if (btnInside) btnInside.classList.toggle('hidden');
        
        if (sidebar.classList.contains('hidden')) {
            if (overlay) overlay.classList.add('hidden');
        } else {
            if (window.innerWidth < 768 && overlay) {
                overlay.classList.remove('hidden');
            }
        }
    }
}

function toggleLeftSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (sidebar) {
        sidebar.classList.toggle('hidden');
        if (overlay) overlay.classList.toggle('hidden');
    }
}

// ========== SISTEMA DE GRÁFICOS ==========
function openUniversalModal(chartType) {
    currentChartType = chartType;
    const modal = document.getElementById('universalChartModal');
    const title = document.getElementById('universalModalTitle');
    const content = document.getElementById('universalModalContent');
    
    if (modal && title && content) {
        const titles = {
            'barras': 'Criar Gráfico de Barras',
            'linhas': 'Criar Gráfico de Linhas', 
            'circular': 'Criar Gráfico Circular',
            'estatistica': 'Criar Card de Estatística'
        };
        
        title.textContent = titles[chartType] || 'Criar Visualização';
        content.innerHTML = generateModalContent(chartType);
        modal.classList.remove('hidden');
        
        closeRightSidebar();
    }
}

function closeUniversalModal() {
    const modal = document.getElementById('universalChartModal');
    if (modal) {
        modal.classList.add('hidden');
    }
    currentChartConfig = {};
}

function generateModalContent(chartType) {
    const templates = {
        'barras': `
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Título do Gráfico</label>
                    <input type="text" id="chartTitle" placeholder="Ex: Vendas Mensais" 
                           class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Eixo X (Categorias)</label>
                    <input type="text" id="xAxis" placeholder="Ex: Janeiro, Fevereiro, Março..."
                           class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Valores (Eixo Y)</label>
                    <input type="text" id="yValues" placeholder="Ex: 100, 200, 150..."
                           class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex gap-4">
                    <button onclick="previewUniversalChart()" class="flex-1 bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">
                        Pré-visualizar
                    </button>
                    <button onclick="addUniversalChartToDashboard()" class="flex-1 bg-green-500 text-white py-2 rounded-md hover:bg-green-600">
                        Adicionar
                    </button>
                </div>
            </div>
        `,
        
        'estatistica': `
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Título do Card</label>
                    <input type="text" id="statTitle" placeholder="Ex: Total de Vendas" 
                           class="w-full px-3 py-2 border border-slate-300 rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Valor</label>
                    <input type="text" id="statValue" placeholder="Ex: 1.250" 
                           class="w-full px-3 py-2 border border-slate-300 rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Cor do Card</label>
                    <select id="statColor" class="w-full px-3 py-2 border border-slate-300 rounded-md">
                        <option value="blue">Azul</option>
                        <option value="green">Verde</option>
                        <option value="purple">Roxo</option>
                        <option value="red">Vermelho</option>
                    </select>
                </div>
                <div class="flex gap-4">
                    <button onclick="addStatCardToDashboard()" class="flex-1 bg-green-500 text-white py-2 rounded-md hover:bg-green-600">
                        Adicionar Card
                    </button>
                </div>
            </div>
        `
    };
    
    return templates[chartType] || '<p>Configuração não disponível.</p>';
}

function addStatCardToDashboard() {
    const title = document.getElementById('statTitle')?.value || 'Estatística';
    const value = document.getElementById('statValue')?.value || '0';
    const color = document.getElementById('statColor')?.value || 'blue';
    
    const colorClasses = {
        'blue': 'from-blue-500 to-blue-600',
        'green': 'from-green-500 to-green-600',
        'purple': 'from-purple-500 to-purple-600',
        'red': 'from-red-500 to-red-600'
    };
    
    const config = {
        type: 'estatistica',
        id: 'stat-' + chartCounter++,
        title: title,
        value: value,
        color: color
    };
    
    addChartToDashboard(config);
    closeUniversalModal();
}

function previewUniversalChart() {
    const config = gatherChartConfig();
    showNotification('Pré-visualização: ' + config.title);
}

function gatherChartConfig() {
    const config = {
        type: currentChartType,
        id: 'chart-' + chartCounter++
    };
    
    switch(currentChartType) {
        case 'barras':
            config.title = document.getElementById('chartTitle')?.value || 'Gráfico de Barras';
            config.labels = document.getElementById('xAxis')?.value?.split(',') || ['Jan', 'Fev', 'Mar'];
            config.values = document.getElementById('yValues')?.value?.split(',').map(v => parseInt(v)) || [100, 200, 150];
            break;
        default:
            config.title = 'Visualização';
    }
    
    return config;
}

function addUniversalChartToDashboard() {
    const config = gatherChartConfig();
    addChartToDashboard(config);
    closeUniversalModal();
    showNotification('Gráfico adicionado ao dashboard!');
}

// ========== FUNÇÃO PRINCIPAL PARA ADICIONAR GRÁFICOS ==========
function addChartToDashboard(config) {
    const container = document.getElementById('customChartsContainer');
    if (!container) return;

    // Remover placeholder se existir
    const placeholder = container.querySelector('.absolute');
    if (placeholder) {
        placeholder.remove();
    }

    const newChart = document.createElement('div');
    newChart.className = 'dashboard-item bg-white rounded-lg shadow p-4';
    newChart.setAttribute('data-chart-id', config.id);

    if (config.type === 'estatistica') {
        newChart.innerHTML = `
            <div class="stat-card ${config.color ? `bg-gradient-to-r ${getColorClasses(config.color)}` : 'bg-gradient-to-r from-blue-500 to-blue-600'} rounded-lg p-4 text-white">
                <div class="flex justify-between items-start">
                    <h3 class="text-sm font-medium opacity-90">${config.title}</h3>
                    <button onclick="this.closest('.dashboard-item').remove()" class="text-white opacity-70 hover:opacity-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="text-2xl font-bold mt-2">${config.value}</div>
                <div class="text-xs opacity-80 mt-1">Atualizado agora</div>
            </div>
        `;
    } else {
        newChart.innerHTML = `
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-semibold text-slate-800">${config.title}</h3>
                <button onclick="this.closest('.dashboard-item').remove()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="h-40 bg-slate-50 rounded flex items-center justify-center">
                <p class="text-slate-500 text-sm">Gráfico: ${config.type}</p>
            </div>
        `;
    }

    container.appendChild(newChart);
}

function getColorClasses(color) {
    const colors = {
        'blue': 'from-blue-500 to-blue-600',
        'green': 'from-green-500 to-green-600',
        'purple': 'from-purple-500 to-purple-600',
        'red': 'from-red-500 to-red-600'
    };
    return colors[color] || colors.blue;
}

// ========== NOTIFICAÇÕES ==========
function showNotification(message, type = 'success') {
    // Criar elemento de notificação
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    } text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Animação de entrada
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Remover após 3 segundos
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// ========== INICIALIZAÇÃO ==========
document.addEventListener('DOMContentLoaded', function() {
    console.log('📊 Sistema de gráficos inicializado');
    
    // Fechar modais com ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeRightSidebar();
            closeUniversalModal();
        }
    });
});