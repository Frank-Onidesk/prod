<!-- Sidebar Direita para Criar Gráficos -->
<aside id="sidebarRight" class="hidden w-80 bg-white border-l border-slate-200 p-6 flex flex-col sidebar-transition fixed right-0 top-0 bottom-0 z-40">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-slate-800">Criar Novo Gráfico</h2>
        <button onclick="closeRightSidebar()" class="text-slate-400 hover:text-slate-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <div class="space-y-4 flex-1 overflow-y-auto">
        <div class="grid grid-cols-2 gap-4">
            <!-- Gráfico de Barras -->
            <button onclick="openUniversalModal('barras')" class="chart-type-btn bg-blue-50 hover:bg-blue-100 p-4 rounded-lg border border-blue-200">
                <div class="text-blue-600 text-center">
                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span class="text-sm font-medium">Barras</span>
                </div>
            </button>

            <!-- Card de Estatística -->
            <button onclick="openUniversalModal('estatistica')" class="chart-type-btn bg-green-50 hover:bg-green-100 p-4 rounded-lg border border-green-200">
                <div class="text-green-600 text-center">
                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span class="text-sm font-medium">Estatística</span>
                </div>
            </button>

            <!-- Gráfico de Linhas -->
            <button onclick="openUniversalModal('linhas')" class="chart-type-btn bg-purple-50 hover:bg-purple-100 p-4 rounded-lg border border-purple-200">
                <div class="text-purple-600 text-center">
                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 14l5-5m0 0l5 5m-5-5v12m-5 0h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-sm font-medium">Linhas</span>
                </div>
            </button>

            <!-- Gráfico Circular -->
            <button onclick="openUniversalModal('circular')" class="chart-type-btn bg-pink-50 hover:bg-pink-100 p-4 rounded-lg border border-pink-200">
                <div class="text-pink-600 text-center">
                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                    </svg>
                    <span class="text-sm font-medium">Circular</span>
                </div>
            </button>
        </div>
    </div>
</aside>