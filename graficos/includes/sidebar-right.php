<!-- Sidebar direita com SVGs -->
<aside id="sidebarRight" 
       class="w-72 bg-white border-l border-slate-200 p-4 flex flex-col hidden fixed right-0 top-0 h-full z-40"
       aria-label="Tipos de gráficos"
       role="dialog"
       aria-modal="true">
       
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-semibold text-slate-800">Tipos de Gráfico</h2>
    <div class="flex gap-2">
      <button onclick="closeRightSidebar()" class="icon-btn flex items-center justify-center w-8 h-8 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-all duration-200" 
              aria-label="Fechar"
              title="Fechar">
        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
      <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-all duration-200" 
              onclick="openLineChartModal()"
              aria-label="Gráfico de Linhas"
              title="Gráfico de Linhas">
        <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 14l4-4m0 0l4 4m-4-4v8m0-18a2 2 0 012 2v2a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2h10z"/>
        </svg>
      </button>
    </div>
  </div>

  <!-- Grelha de ícones com SVGs -->
  <div class="grid grid-cols-4 gap-4 flex-1">
    <!-- Gráfico de Barras -->
    <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-all duration-200" 
            onclick="openBarChartModal()"
            aria-label="Gráfico de Barras"
            title="Gráfico de Barras">
      <svg class="w-6 h-6 text-slate-600" fill="currentColor" viewBox="0 0 24 24">
        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
      </svg>
    </button>

    <!-- Gráfico de Linhas -->
    <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-all duration-200" 
            onclick="openLineChartModal()"
            aria-label="Gráfico de Linhas"
            title="Gráfico de Linhas">
      <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 14l4-4m0 0l4 4m-4-4v8m0-18a2 2 0 012 2v2a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2h10z"/>
      </svg>
    </button>

    <!-- Gráfico de Pizza -->
    <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-all duration-200" 
            onclick="selectChartType('Pizza')"
            aria-label="Gráfico de Pizza"
            title="Gráfico de Pizza">
      <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
      </svg>
    </button>

    <!-- Gráfico de Área -->
    <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-all duration-200" 
            onclick="selectChartType('Área')"
            aria-label="Gráfico de Área"
            title="Gráfico de Área">
      <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
      </svg>
    </button>

    <!-- Tabela -->
    <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-all duration-200" 
            onclick="selectChartType('Tabela')"
            aria-label="Tabela"
            title="Tabela">
      <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
      </svg>
    </button>

    <!-- Mapa -->
    <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-all duration-200" 
            onclick="selectChartType('Mapa')"
            aria-label="Mapa"
            title="Mapa">
      <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
      </svg>
    </button>

    <!-- Relatório -->
    <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-all duration-200" 
            onclick="selectChartType('Relatório')"
            aria-label="Relatório"
            title="Relatório">
      <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
      </svg>
    </button>

    <!-- Exportar -->
    <button class="icon-btn flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 hover:bg-slate-200 border border-slate-200 transition-all duration-200" 
            onclick="selectChartType('Exportar')"
            aria-label="Exportar"
            title="Exportar">
      <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
      </svg>
    </button>
  </div>
  
  <div class="mt-6 p-3 bg-blue-50 rounded-md">
    <p class="text-sm text-blue-700" id="selectedChartInfo">Clique num ícone para selecionar</p>
  </div>
</aside>