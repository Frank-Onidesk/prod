<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: /picagens/prod/login.php");
    exit;
}

// Incluir os arquivos necessários
include 'includes/header.php';
include 'includes/sidebar-left.php';
include 'includes/sidebar-right.php'; 
include 'includes/modals.php';
?>

<!-- Conteúdo principal -->
<main class="flex-1 p-6 overflow-auto transition-all duration-300">
  <div class="flex items-center gap-4 mb-6">
    <!-- Botão para abrir sidebar quando fechada -->
    <button id="btnOutside" 
            onclick="toggleSidebar()" 
            class="bg-slate-200 hover:bg-slate-300 p-2 rounded-md shadow-md transition-colors hidden"
            aria-label="Abrir barra lateral">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <h1 class="text-2xl font-bold text-gray-800">Dashboard - Visão Geral</h1>
  </div>

  <!-- Row 1 - Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="grid-card bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow p-6 text-white">
      <h3 class="text-lg font-semibold mb-4">Vendas Mensais</h3>
      <p class="mb-4">Relatório mensal de vendas</p>
      <button class="w-full bg-white text-blue-600 py-2 rounded-md font-medium hover:bg-blue-50">Gerar</button>
    </div>
    <div class="grid-card bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow p-6 text-white">
      <h3 class="text-lg font-semibold mb-4">Notificações</h3>
      <p class="mb-4">Enviar para todos os usuários</p>
      <button class="w-full bg-white text-green-600 py-2 rounded-md font-medium hover:bg-green-50">Enviar</button>
    </div>
    <div class="grid-card bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow p-6 text-white">
      <h3 class="text-lg font-semibold mb-4">Backup</h3>
      <p class="mb-4">Backup do sistema</p>
      <button class="w-full bg-white text-purple-600 py-2 rounded-md font-medium hover:bg-purple-50">Executar</button>
    </div>
    <div class="grid-card bg-gradient-to-r from-red-500 to-red-600 rounded-lg shadow p-6 text-white">
      <h3 class="text-lg font-semibold mb-4">Suporte</h3>
      <p class="mb-4">Abrir ticket</p>
      <button class="w-full bg-white text-red-600 py-2 rounded-md font-medium hover:bg-red-50">Abrir</button>
    </div>
  </div>

  <!-- Row 2 - Gráficos existentes -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="grid-card bg-white rounded-lg shadow p-6">
      <h3 class="text-lg font-semibold mb-4">Vendas por Mês</h3>
      <canvas id="barChart" class="h-64"></canvas>
    </div>
    <div class="grid-card bg-white rounded-lg shadow p-6">
      <h3 class="text-lg font-semibold mb-4">Distribuição de Utilizadores</h3>
      <canvas id="pieChart" class="h-64"></canvas>
    </div>
  </div>

  <!-- Área onde os novos gráficos serão adicionados -->
  <div id="customChartsContainer"></div>
</main>

<!-- HANDLE DE RESIZE FORA DA SIDEBAR -->
<div class="resize-handle" id="resizeHandle" title="Arraste para redimensionar"></div>

<!-- Botões flutuantes mobile -->
<button id="btnLeftToggle" onclick="toggleLeftSidebar()" class="floating-btn left-4 md:hidden">
  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
  </svg>
</button>
<button id="btnRightToggle" onclick="toggleRightSidebar()" class="floating-btn right-4 md:hidden">
  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
    <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
  </svg>
</button>

<!-- Scripts -->
<script src="js/dashboard.js"></script>
<script src="js/sidebar.js"></script>
<script src="js/modals.js"></script>
<script src="js/chatrs.js"></script>

<script>
// Chart.js - Mantenha este código no HTML pois é específico da página
const barCtx = document.getElementById('barChart').getContext('2d');
new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: ['Jan','Fev','Mar','Abr','Mai'],
        datasets: [{
            label: 'Vendas',
            data: [12,19,3,5,8],
            backgroundColor: '#3b82f6',
            borderColor: '#1d4ed8',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            }
        }
    }
});

const pieCtx = document.getElementById('pieChart').getContext('2d');
new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: ['Admin','Usuários','Visitantes'],
        datasets: [{
            data: [10,30,60],
            backgroundColor: ['#10b981','#3b82f6','#f59e0b'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
            }
        }
    }
});
</script>
</body>
</html>