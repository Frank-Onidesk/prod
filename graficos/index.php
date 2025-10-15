<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Reno Picagens - Visualizar Gráficos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="assets/dashboard.css">
</head>
<body class="flex h-screen bg-gray-50">

<!-- Incluir Sidebar Esquerda -->
<?php include 'includes/sidebar-left.php'; ?>

<!-- Conteúdo Principal -->
<main class="flex-1 p-6 overflow-auto">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-4">
            <button id="btnOutside" onclick="toggleSidebar()" class="bg-slate-200 hover:bg-slate-300 p-2 rounded-md hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <h1 class="text-2xl font-bold text-gray-800">Meus Gráficos Criados</h1>
        </div>
    </div>
    <!-- Seção Informativa -->
    <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-6 border border-green-200">
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-green-800 mb-2">Seus gráficos guardados</h2>
                <p class="text-green-700 mb-3">
                    Aqui pode visualizar todos os gráficos que criou. Para editar ou criar novos, 
                    <a href="graficos.php" class="font-semibold underline hover:text-green-800">volte à área de criação</a>.
                </p>
                <div class="flex gap-4 text-sm">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <span class="text-green-700">Gráficos de Barras</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <span class="text-green-700">Cards de Estatística</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                        <span class="text-green-700">Gráficos de Linhas</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos Criados pelo Utilizador -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800">Visualizações Guardadas</h2>
            <div class="flex gap-2">
                <button onclick="refreshCharts()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Atualizar
                </button>
            </div>
        </div>
        
        <!-- Aqui aparecem os gráficos criados no graficos.php -->
        <div id="userChartsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 relative min-h-[300px] p-6 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                <svg class="w-16 h-16 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <p class="text-gray-400 text-lg text-center mb-2">Ainda não tem gráficos</p>
                <p class="text-gray-500 text-center max-w-md mb-4">
                    Crie o seu primeiro gráfico para ver as visualizações aqui.
                </p>
                <a href="graficos.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-colors flex items-center gap-2 pointer-events-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Criar Primeiro Gráfico
                </a>
            </div>
        </div>
    </div>

    <!-- Estatísticas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="grid-card bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Resumo</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Total de Gráficos</span>
                    <span class="font-semibold text-blue-600" id="totalCharts">0</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Cards de Estatística</span>
                    <span class="font-semibold text-green-600" id="totalStats">0</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Gráficos Visuais</span>
                    <span class="font-semibold text-purple-600" id="totalVisuals">0</span>
                </div>
            </div>
        </div>
        
        <div class="grid-card bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Ações Rápidas</h3>
            <div class="space-y-3">
                <a href="graficos.php" class="block w-full text-left p-3 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                    <span class="font-medium">Criar Novo Gráfico</span>
                    <p class="text-sm text-gray-600 mt-1">Adicionar nova visualização</p>
                </a>
                <button onclick="refreshCharts()" class="w-full text-left p-3 rounded-lg border border-gray-200 hover:border-green-300 hover:bg-green-50 transition-colors">
                    <span class="font-medium">Atualizar Visualizações</span>
                    <p class="text-sm text-gray-600 mt-1">Recarregar gráficos guardados</p>
                </button>
            </div>
        </div>
        
        <div class="grid-card bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Dicas</h3>
            <div class="space-y-2 text-sm text-gray-600">
                <p>• Use cores diferentes para cada categoria</p>
                <p>• Mantenha os títulos claros e objetivos</p>
                <p>• Guarde sempre os gráficos antes de sair</p>
                <p>• Pode criar múltiplos tipos de visualização</p>
            </div>
        </div>
    </div>
</main>

<!-- Scripts -->
<script>
// Carregar gráficos do usuário do localStorage
document.addEventListener('DOMContentLoaded', function() {
    loadUserCharts();
    updateStats();
});

function loadUserCharts() {
    const container = document.getElementById('userChartsContainer');
    const savedCharts = JSON.parse(localStorage.getItem('userCharts') || '[]');
    
    if (savedCharts.length > 0) {
        const placeholder = container.querySelector('.absolute');
        if (placeholder) placeholder.remove();
        
        savedCharts.forEach(chart => {
            const chartElement = createChartElement(chart);
            container.appendChild(chartElement);
        });
    }
}

function createChartElement(chartConfig) {
    const div = document.createElement('div');
    div.className = 'dashboard-item bg-white rounded-lg shadow p-4';
    
    if (chartConfig.type === 'estatistica') {
        div.innerHTML = `
            <div class="stat-card bg-gradient-to-r ${getColorClasses(chartConfig.color)} rounded-lg p-4 text-white">
                <div class="flex justify-between items-start">
                    <h3 class="text-sm font-medium opacity-90">${chartConfig.title}</h3>
                </div>
                <div class="text-2xl font-bold mt-2">${chartConfig.value}</div>
                <div class="text-xs opacity-80 mt-1">Card personalizado</div>
            </div>
        `;
    } else {
        div.innerHTML = `
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-semibold text-slate-800">${chartConfig.title}</h3>
            </div>
            <div class="h-40 bg-slate-50 rounded flex items-center justify-center">
                <p class="text-slate-500 text-sm">${chartConfig.description || 'Gráfico personalizado'}</p>
            </div>
        `;
    }
    
    return div;
}

function updateStats() {
    const savedCharts = JSON.parse(localStorage.getItem('userCharts') || '[]');
    const totalCharts = savedCharts.length;
    const totalStats = savedCharts.filter(chart => chart.type === 'estatistica').length;
    const totalVisuals = totalCharts - totalStats;
    
    document.getElementById('totalCharts').textContent = totalCharts;
    document.getElementById('totalStats').textContent = totalStats;
    document.getElementById('totalVisuals').textContent = totalVisuals;
}

function refreshCharts() {
    const container = document.getElementById('userChartsContainer');
    container.innerHTML = `
        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
            <svg class="w-16 h-16 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            <p class="text-gray-400 text-lg text-center mb-2">A carregar gráficos...</p>
        </div>
    `;
    
    setTimeout(() => {
        loadUserCharts();
        updateStats();
        
        // Mostrar notificação
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
        notification.textContent = 'Gráficos atualizados!';
        document.body.appendChild(notification);
        setTimeout(() => notification.remove(), 3000);
    }, 500);
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
</script>
</body>
</html>