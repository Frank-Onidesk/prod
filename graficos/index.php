
<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: /picagens/prod/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Auto Reno Picagens- Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/a2e0e6ad5d.js" crossorigin="anonymous"></script>
  <style>
    /* Custom styles */
    .sidebar-logo {
      max-width: 120px;
      height: auto;
    }
    
    .icon-btn {
      transition: all 0.2s ease;
    }
    
    .icon-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    .nav-item.active {
      background-color: #fef2f2;
      color: #dc2626;
    }
    
    .nav-item.active .sidebar-icon-bg {
      background-color: #fee2e2;
    }
    
    .nav-item.active .sidebar-icon {
      color: #dc2626;
    }
    
    /* Animation for sidebar transitions */
    .sidebar-transition {
      transition: transform 0.3s ease;
    }
    
    /* Grid styling */
    .grid-card {
      transition: all 0.3s ease;
    }
    
    .grid-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    /* Responsive behavior */
    @media (max-width: 768px) {
      #sidebar {
        position: fixed;
        height: 100%;
        z-index: 50;
        transform: translateX(0);
      }
      
      #sidebar.hidden {
        transform: translateX(-100%);
      }
      
      #sidebarRight {
        position: fixed;
        height: 100%;
        z-index: 50;
        right: 0;
        transform: translateX(0);
      }
      
      #sidebarRight.hidden {
        transform: translateX(100%);
      }
    }
  </style>
</head>
<body class="h-screen flex bg-gray-50">

  <!-- ===== Sidebar esquerda (original) ===== -->
  <aside id="sidebar" 
         class="w-64 bg-white border-r border-slate-200 p-4 flex flex-col sidebar-transition"
         aria-label="Menu principal">
    <div class="flex items-center justify-between mb-6">
      <a href="../" class="border-none">
        <img src="../assets/images/logo.jpg" alt="Logo da aplicação" class="sidebar-logo">
      </a>
      <button id="btnInside" 
              onclick="toggleSidebar()" 
              class="bg-slate-200 hover:bg-slate-300 p-2 rounded-md shadow-md transition-colors"
              aria-label="Fechar barra lateral">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>

    <nav class="flex-1" aria-label="Navegação principal">
      <ul class="space-y-1">
        <!-- Página inicial -->
        <li>
          <a href="index.php" 
             class="nav-item group flex items-center gap-3 rounded-md px-3 py-2 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-red-500 active"
             aria-current="page">
            <span class="sidebar-icon-bg flex items-center justify-center w-8 h-8 rounded-md bg-slate-100">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 sidebar-icon text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 9.75L12 4l9 5.75M4.5 10.5V19a2.25 2.25 0 002.25 2.25h2.25V15a2.25 2.25 0 012.25-2.25h3A2.25 2.25 0 0116.5 15v6.25h2.25A2.25 2.25 0 0021 19v-8.5" />
              </svg>
            </span>
            <span class="text-sm font-medium text-slate-900">Página inicial</span>
          </a>
        </li>

        <!-- Gráficos: abre a sidebar direita (não navega) -->
        <li>
          <button onclick="openRightSidebar()"
             class="nav-item w-full text-left group flex items-center gap-3 rounded-md px-3 py-2 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-red-500 active"
             aria-haspopup="true"
             aria-expanded="false"
             aria-controls="sidebarRight">
            <span class="sidebar-icon-bg flex items-center justify-center w-8 h-8 rounded-md bg-slate-100">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 sidebar-icon text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 3v18m4-14v10m4-6v6m-12-2v2m-4-6v6" />
              </svg>
            </span>
            <span class="text-sm font-medium text-slate-900">Gráficos</span>
          </button>
        </li>
      </ul>
    </nav>

    <div class="mt-6 text-xs text-slate-500">
      Versão 0.1 · Apenas início
    </div>
  </aside>

  <!-- Overlay for mobile sidebar -->
  <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40" onclick="toggleSidebar()"></div>

  <!-- ===== Conteúdo principal ===== -->
  <main class="flex-1 p-6 overflow-auto">
    <div class="flex items-center gap-4 mb-6">
      <!-- botão para abrir a sidebar esquerda quando ela está fechada -->
      <button id="btnOutside" 
              onclick="toggleSidebar()" 
              class="hidden bg-slate-200 hover:bg-slate-300 p-2 rounded-md shadow-md transition-colors"
              aria-label="Abrir barra lateral">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <h1 class="text-2xl font-bold text-slate-800">Dashboard - Visão Geral</h1>
    </div>

  

    <!-- Row 2 - Gráficos -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
      <div class="grid-card bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-lg font-semibold text-slate-800">Vendas por Mês</h3>
          <button class="text-sm text-blue-600 hover:text-blue-800">Ver detalhes</button>
        </div>
        <div class="h-64 bg-gray-100 rounded flex items-center justify-center">
          <p class="text-gray-500">Gráfico de barras seria exibido aqui</p>
        </div>
      </div>
      
      <div class="grid-card bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-lg font-semibold text-slate-800">Distribuição de Utilizaores</h3>
          <button class="text-sm text-blue-600 hover:text-blue-800">Ver detalhes</button>
        </div>
        <div class="h-64 bg-gray-100 rounded flex items-center justify-center">
          <p class="text-gray-500">Gráfico de pizza seria exibido aqui</p>
        </div>
      </div>
    </div>

    <!-- Row 3 - Tabela de Dados -->
    <div class="grid grid-cols-1 gap-6 mb-6">
      <div class="grid-card bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-lg font-semibold text-slate-800">Atividades Recentes</h3>
          <button class="text-sm text-blue-600 hover:text-blue-800">Ver todas</button>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ação</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                      <span class="text-blue-800 font-medium">JS</span>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">João Silva</div>
                      <div class="text-sm text-gray-500">joao@exemplo.com</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Login no sistema</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10/05/2023 14:30</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    Concluído
                  </span>
                </td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10 bg-purple-100 rounded-full flex items-center justify-center">
                      <span class="text-purple-800 font-medium">MA</span>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">Maria Andrade</div>
                      <div class="text-sm text-gray-500">maria@exemplo.com</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Atualização de perfil</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10/05/2023 13:15</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    Concluído
                  </span>
                </td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10 bg-yellow-100 rounded-full flex items-center justify-center">
                      <span class="text-yellow-800 font-medium">PC</span>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">Pedro Costa</div>
                      <div class="text-sm text-gray-500">pedro@exemplo.com</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Upload de ficheiro</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10/05/2023 12:45</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                    Pendente
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Row 4 - Cards de Ação Rápida -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="grid-card bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow p-6 text-white">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-lg font-semibold">Relatório</h3>
          <i class="fas fa-file-alt text-xl"></i>
        </div>
        <p class="mb-4">Gerar relatório mensal de vendas</p>
        <button class="w-full bg-white text-blue-600 py-2 rounded-md font-medium hover:bg-blue-50 transition-colors">
          Gerar
        </button>
      </div>
      
      <div class="grid-card bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow p-6 text-white">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-lg font-semibold">Notificações</h3>
          <i class="fas fa-bell text-xl"></i>
        </div>
        <p class="mb-4">Enviar notificação para todos os usuários</p>
        <button class="w-full bg-white text-green-600 py-2 rounded-md font-medium hover:bg-green-50 transition-colors">
          Enviar
        </button>
      </div>
      
      <div class="grid-card bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow p-6 text-white">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-lg font-semibold">Backup</h3>
          <i class="fas fa-database text-xl"></i>
        </div>
        <p class="mb-4">Fazer backup dos dados do sistema</p>
        <button class="w-full bg-white text-purple-600 py-2 rounded-md font-medium hover:bg-purple-50 transition-colors">
          Executar
        </button>
      </div>
      
      <div class="grid-card bg-gradient-to-r from-red-500 to-red-600 rounded-lg shadow p-6 text-white">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-lg font-semibold">Suporte</h3>
          <i class="fas fa-headset text-xl"></i>
        </div>
        <p class="mb-4">Abrir um ticket de suporte</p>
        <button class="w-full bg-white text-red-600 py-2 rounded-md font-medium hover:bg-red-50 transition-colors">
          Abrir
        </button>
      </div>
    </div>
  </main>

  <!-- ===== Sidebar direita (com ícones de gráficos) ===== -->
  <aside id="sidebarRight" 
         class="w-72 bg-white border-l border-slate-200 p-4 flex flex-col hidden sidebar-transition"
         aria-label="Tipos de gráficos"
         role="dialog"
         aria-modal="true">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-lg font-semibold text-slate-800">Tipos de Gráfico</h2>
      <button onclick="closeRightSidebar()" 
              class="bg-slate-200 hover:bg-slate-300 p-2 rounded-md shadow-md transition-colors"
              aria-label="Fechar painel de gráficos">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Grelha de ícones -->
    <div class="grid grid-cols-4 gap-4">
      <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200" 
              onclick="selectChartType('Barras')"
              aria-label="Gráfico de Barras">
        <i class="fas fa-chart-bar text-slate-600"></i>
      </button>
      <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200" 
              onclick="selectChartType('Linhas')"
              aria-label="Gráfico de Linhas">
        <i class="fas fa-chart-line text-slate-600"></i>
      </button>
      <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200" 
              onclick="selectChartType('Pizza')"
              aria-label="Gráfico de Pizza">
        <i class="fas fa-chart-pie text-slate-600"></i>
      </button>
      <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200" 
              onclick="selectChartType('Área')"
              aria-label="Gráfico de Área">
        <i class="fas fa-chart-area text-slate-600"></i>
      </button>

      <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200" 
              onclick="selectChartType('Tabela')"
              aria-label="Tabela">
        <i class="fas fa-table text-slate-600"></i>
      </button>
      <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200" 
              onclick="selectChartType('Colunas')"
              aria-label="Gráfico de Colunas">
        <i class="fas fa-align-justify text-slate-600"></i>
      </button>
      <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200" 
              onclick="selectChartType('Funil')"
              aria-label="Gráfico de Funil">
        <i class="fas fa-filter text-slate-600"></i>
      </button>
      <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200" 
              onclick="selectChartType('Medidor')"
              aria-label="Gráfico de Medidor">
        <i class="fas fa-tachometer-alt text-slate-600"></i>
      </button>

      <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200" 
              onclick="selectChartType('Mapa')"
              aria-label="Mapa">
        <i class="fas fa-globe text-slate-600"></i>
      </button>
      <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200" 
              onclick="selectChartType('Tempo')"
              aria-label="Gráfico de Tempo">
        <i class="fas fa-clock text-slate-600"></i>
      </button>
      <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200" 
              onclick="selectChartType('Relatório')"
              aria-label="Relatório">
        <i class="fas fa-file-alt text-slate-600"></i>
      </button>
      <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200" 
              onclick="selectChartType('Comentários')"
              aria-label="Comentários">
        <i class="fas fa-comment text-slate-600"></i>
      </button>

      <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200" 
              onclick="selectChartType('Dispersão')"
              aria-label="Gráfico de Dispersão">
        <i class="fas fa-braille text-slate-600"></i>
      </button>
      <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200" 
              onclick="selectChartType('Heatmap')"
              aria-label="Heatmap">
        <i class="fas fa-th text-slate-600"></i>
      </button>
      <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200" 
              onclick="selectChartType('Python')"
              aria-label="Gráfico Python">
        <i class="fab fa-python text-slate-600"></i>
      </button>
      <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200" 
              onclick="selectChartType('R')"
              aria-label="Gráfico R">
        <span class="font-bold text-red-600">R</span>
      </button>
    </div>
    
    <div class="mt-6 p-3 bg-blue-50 rounded-md">
      <p class="text-sm text-blue-700" id="selectedChartInfo">Nenhum gráfico selecionado</p>
    </div>
  </aside>

  <script>
    // DOM elements
    const sidebar = document.getElementById('sidebar');
    const sidebarRight = document.getElementById('sidebarRight');
    const btnInside = document.getElementById('btnInside');
    const btnOutside = document.getElementById('btnOutside');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const selectedChartInfo = document.getElementById('selectedChartInfo');

    // Toggle left sidebar
    function toggleSidebar() {
      if (!sidebar) return;
      
      const isHidden = sidebar.classList.toggle('hidden');
      
      if (btnInside) btnInside.classList.toggle('hidden');
      if (btnOutside) btnOutside.classList.toggle('hidden');
      
      // Show/hide overlay on mobile
      if (window.innerWidth <= 768) {
        sidebarOverlay.classList.toggle('hidden');
      }
      
      // Update ARIA attributes
      const isExpanded = !isHidden;
      if (btnOutside) {
        btnOutside.setAttribute('aria-expanded', isExpanded);
      }
    }

    // Open right sidebar
    function openRightSidebar() {
      if (!sidebarRight) return;
      
      sidebarRight.classList.remove('hidden');
      
      // Update ARIA attributes
      const graphButton = document.querySelector('[aria-controls="sidebarRight"]');
      if (graphButton) {
        graphButton.setAttribute('aria-expanded', 'true');
      }
      
      sidebarRight.setAttribute('aria-hidden', 'false');
      
      // Focus management
      const closeButton = sidebarRight.querySelector('button[aria-label="Fechar painel de gráficos"]');
      if (closeButton) {
        closeButton.focus();
      }
    }

    // Close right sidebar
    function closeRightSidebar() {
      if (!sidebarRight) return;
      
      sidebarRight.classList.add('hidden');
      
      // Update ARIA attributes
      const graphButton = document.querySelector('[aria-controls="sidebarRight"]');
      if (graphButton) {
        graphButton.setAttribute('aria-expanded', 'false');
      }
      
      sidebarRight.setAttribute('aria-hidden', 'true');
      
      // Focus management
      const graphButtonElement = document.querySelector('[aria-controls="sidebarRight"]');
      if (graphButtonElement) {
        graphButtonElement.focus();
      }
    }

    // Handle chart type selection
    function selectChartType(type) {
      selectedChartInfo.textContent = `Gráfico selecionado: ${type}`;
      
      // Here you would typically load the selected chart type
      console.log(`Chart type selected: ${type}`);
      
      // Optionally close the right sidebar after selection
      // closeRightSidebar();
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
      if (window.innerWidth > 768) return;
      
      if (!sidebar.classList.contains('hidden') && 
          !sidebar.contains(event.target) && 
          event.target !== btnOutside) {
        toggleSidebar();
      }
    });

    // Close sidebar with Escape key
    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
        if (!sidebarRight.classList.contains('hidden')) {
          closeRightSidebar();
        } else if (window.innerWidth <= 768 && !sidebar.classList.contains('hidden')) {
          toggleSidebar();
        }
      }
    });

    // Handle responsive behavior on window resize
    window.addEventListener('resize', function() {
      if (window.innerWidth > 768) {
        // On larger screens, ensure sidebar is visible and overlay is hidden
        sidebar.classList.remove('hidden');
        sidebarOverlay.classList.add('hidden');
        if (btnInside) btnInside.classList.remove('hidden');
        if (btnOutside) btnOutside.classList.add('hidden');
      } else {
        // On smaller screens, ensure proper button states
        if (sidebar.classList.contains('hidden')) {
          if (btnInside) btnInside.classList.add('hidden');
          if (btnOutside) btnOutside.classList.remove('hidden');
        } else {
          if (btnInside) btnInside.classList.remove('hidden');
          if (btnOutside) btnOutside.classList.add('hidden');
        }
      }
    });

    // Initialize responsive behavior on page load
    window.dispatchEvent(new Event('resize'));
  </script>
</body>
</html>