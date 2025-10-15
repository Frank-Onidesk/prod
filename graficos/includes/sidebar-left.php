<!-- ===== Sidebar esquerda ===== -->
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

      <!-- Gráficos -->
      <li>
        <button onclick="toggleRightSidebar()"
           class="nav-item w-full text-left group flex items-center gap-3 rounded-md px-3 py-2 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-red-500"
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