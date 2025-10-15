// chart-creator.js - Sistema de Criação de Gráficos
console.log('🎨 Sistema de criação de gráficos carregado');

let currentChartType = '';
let userCharts = JSON.parse(localStorage.getItem('userCharts') || '[]');

// ========== SIDEBAR DIREITA ==========
function toggleRightSidebar() {
    const rightSidebar = document.getElementById('sidebarRight');
    if (rightSidebar) {
        rightSidebar.classList.toggle('hidden');
    }
}

function closeRightSidebar() {
    const rightSidebar = document.getElementById('sidebarRight');
    if (rightSidebar) {
        rightSidebar.classList.add('hidden');
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

// ========== MODAL UNIVERSAL ==========
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
}

function generateModalContent(chartType) {
    const templates = {
        'barras': `
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Título do Gráfico</label>
                    <input type="text" id="chartTitle" placeholder="Ex: Vendas Mensais" 
                           class="w-full px-3 py-2 border border-slate-300 rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Rótulos (Eixo X)</label>
                    <input type="text" id="xLabels" placeholder="Ex: Jan, Fev, Mar, Abr" 
                           class="w-full px-3 py-2 border border-slate-300 rounded-md">
                    <p class="text-xs text-slate-500 mt-1">Separe por vírgulas</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Valores (Eixo Y)</label>
                    <input type="text" id="yValues" placeholder="Ex: 100, 200, 150, 300" 
                           class="w-full px-3 py-2 border border-slate-300 rounded-md">
                    <p class="text-xs text-slate-500 mt-1">Separe por vírgulas</p>
                </div>
                <button onclick="addBarChartToWorkspace()" class="w-full bg-green-500 text-white py-2 rounded-md hover:bg-green-600">
                    Adicionar Gráfico
                </button>
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
                <button onclick="addStatCardToWorkspace()" class="w-full bg-green-500 text-white py-2 rounded-md hover:bg-green-600">
                    Adicionar Card
                </button>
            </div>
        `,
        
        'linhas': `
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Título do Gráfico</label>
                    <input type="text" id="lineTitle" placeholder="Ex: Evolução de Vendas" 
                           class="w-full px-3 py-2 border border-slate-300 rounded-md">
                </div>
                <button onclick="addLineChartToWorkspace()" class="w-full bg-green-500 text-white py-2 rounded-md hover:bg-green-600">
                    Adicionar Gráfico
                </button>
            </div>
        `,
        
        'circular': `
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Título do Gráfico</label>
                    <input type="text" id="pieTitle" placeholder="Ex: Distribuição de Vendas" 
                           class="w-full px-3 py-2 border border-slate-300 rounded-md">
                </div>
                <button onclick="addPieChartToWorkspace()" class="w-full bg-green-500 text-white py-2 rounded-md hover:bg-green-600">
                    Adicionar Gráfico
                </button>
            </div>
        `
    };
    
    return templates[chartType] || '<p>Configuração não disponível.</p>';
}

// ========== FUNÇÕES PARA ADICIONAR GRÁFICOS ==========
function addBarChartToWorkspace() {
    const title = document.getElementById('chartTitle')?.value || 'Gráfico de Barras';
    const labels = document.getElementById('xLabels')?.value?.split(',').map(l => l.trim()) || ['Jan', 'Fev', 'Mar'];
    const values = document.getElementById('yValues')?.value?.split(',').map(v => parseInt(v.trim())) || [100, 200, 150];
    
    const config = {
        type: 'barras',
        id: 'chart-' + Date.now(),
        title: title,
        labels: labels,
        values: values,
        description: `Gráfico de barras: ${title}`
    };
    
    createChartElement(config);
    userCharts.push(config);
    closeUniversalModal();
    showNotification('Gráfico de barras adicionado!');
}

function addStatCardToWorkspace() {
    const title = document.getElementById('statTitle')?.value || 'Estatística';
    const value = document.getElementById('statValue')?.value || '0';
    const color = document.getElementById('statColor')?.value || 'blue';
    
    const config = {
        type: 'estatistica',
        id: 'stat-' + Date.now(),
        title: title,
        value: value,
        color: color,
        description: `Card: ${title}`
    };
    
    createChartElement(config);
    userCharts.push(config);
    closeUniversalModal();
    showNotification('Card de estatística adicionado!');
}

function addLineChartToWorkspace() {
    const title = document.getElementById('lineTitle')?.value || 'Gráfico de Linhas';
    const config = {
        type: 'linhas',
        id: 'line-' + Date.now(),
        title: title,
        description: `Gráfico de linhas: ${title}`
    };
    
    createChartElement(config);
    userCharts.push(config);
    closeUniversalModal();
    showNotification('Gráfico de linhas adicionado!');
}

function addPieChartToWorkspace() {
    const title = document.getElementById('pieTitle')?.value || 'Gráfico Circular';
    const config = {
        type: 'circular',
        id: 'pie-' + Date.now(),
        title: title,
        description: `Gráfico circular: ${title}`
    };
    
    createChartElement(config);
    userCharts.push(config);
    closeUniversalModal();
    showNotification('Gráfico circular adicionado!');
}

function createChartElement(config) {
    const container = document.getElementById('customChartsContainer');
    
    // Remover placeholder se existir
    const placeholder = container.querySelector('.absolute');
    if (placeholder) {
        placeholder.remove();
    }

    const div = document.createElement('div');
    div.className = 'dashboard-item bg-white rounded-lg shadow p-4';
    div.setAttribute('data-chart-id', config.id);
    
    if (config.type === 'estatistica') {
        div.innerHTML = `
            <div class="stat-card bg-gradient-to-r ${getColorClasses(config.color)} rounded-lg p-4 text-white">
                <div class="flex justify-between items-start">
                    <h3 class="text-sm font-medium opacity-90">${config.title}</h3>
                    <button onclick="removeChart('${config.id}')" class="text-white opacity-70 hover:opacity-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="text-2xl font-bold mt-2">${config.value}</div>
                <div class="text-xs opacity-80 mt-1">Card personalizado</div>
            </div>
        `;
    } else {
        div.innerHTML = `
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-semibold text-slate-800">${config.title}</h3>
                <button onclick="removeChart('${config.id}')" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="h-40 bg-slate-50 rounded flex items-center justify-center">
                <p class="text-slate-500 text-sm">${config.description}</p>
            </div>
        `;
    }

    container.appendChild(div);
}

function removeChart(chartId) {
    // Remover do DOM
    const element = document.querySelector(`[data-chart-id="${chartId}"]`);
    if (element) {
        element.remove();
    }
    
    // Remover do array
    userCharts = userCharts.filter(chart => chart.id !== chartId);
    
    // Mostrar placeholder se não houver gráficos
    const container = document.getElementById('customChartsContainer');
    if (container.children.length === 0) {
        container.innerHTML = `
            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                <svg class="w-24 h-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <p class="text-gray-400 text-xl text-center mb-2">Nenhum gráfico criado</p>
            </div>
        `;
    }
    
    showNotification('Gráfico removido!');
}

// ========== GESTÃO DE DADOS ==========
function saveAllCharts() {
    localStorage.setItem('userCharts', JSON.stringify(userCharts));
    showNotification('Todos os gráficos foram guardados!', 'success');
}

function clearAllCharts() {
    if (confirm('Tem a certeza que quer remover todos os gráficos?')) {
        userCharts = [];
        localStorage.removeItem('userCharts');
        const container = document.getElementById('customChartsContainer');
        container.innerHTML = `
            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                <svg class="w-24 h-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <p class="text-gray-400 text-xl text-center mb-2">Nenhum gráfico criado</p>
            </div>
        `;
        showNotification('Todos os gráficos foram removidos!', 'success');
    }
}

// ========== UTILITÁRIOS ==========
function getColorClasses(color) {
    const colors = {
        'blue': 'from-blue-500 to-blue-600',
        'green': 'from-green-500 to-green-600',
        'purple': 'from-purple-500 to-purple-600',
        'red': 'from-red-500 to-red-600'
    };
    return colors[color] || colors.blue;
}

function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 ${
        type === 'success' ? 'bg-green-500' : 'bg-blue-500'
    } text-white px-6 py-3 rounded-lg shadow-lg z-50`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        if (notification.parentNode) {
            notification.parentNode.removeChild(notification);
        }
    }, 3000);
}

// ========== INICIALIZAÇÃO ==========
document.addEventListener('DOMContentLoaded', function() {
    console.log('🎨 Editor de gráficos pronto!');
    
    // Carregar gráficos existentes
    const savedCharts = JSON.parse(localStorage.getItem('userCharts') || '[]');
    if (savedCharts.length > 0) {
        userCharts = savedCharts;
        const container = document.getElementById('customChartsContainer');
        const placeholder = container.querySelector('.absolute');
        if (placeholder) placeholder.remove();
        
        userCharts.forEach(chart => {
            createChartElement(chart);
        });
    }
});