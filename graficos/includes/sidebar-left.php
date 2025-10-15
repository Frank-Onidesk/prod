<!-- Sidebar Esquerda -->
<aside id="sidebar" class="w-64 bg-white border-r border-slate-200 p-4 flex flex-col sidebar-transition">
    <div class="flex items-center justify-between mb-6">
        <a href="#" class="border-none">
            <img src="../assets/images/logo.jpg" alt="Logo" class="sidebar-logo">
        </a>
        <button id="btnInside" onclick="toggleSidebar()" class="bg-slate-200 hover:bg-slate-300 p-2 rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <nav class="flex-1">
        <ul class="space-y-1">
            <li>
                <a href="index.php" class="nav-item group flex items-center gap-3 rounded-md px-3 py-2 hover:bg-slate-100">
                    <span class="sidebar-icon-bg flex items-center justify-center w-8 h-8 rounded-md bg-slate-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 sidebar-icon text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </span>
                    <span class="text-sm font-medium text-slate-900">Ver Meus Gráficos</span>
                </a>
            </li>
            <li>
                <a href="graficos.php" class="nav-item active group flex items-center gap-3 rounded-md px-3 py-2 hover:bg-slate-100">
                    <span class="sidebar-icon-bg flex items-center justify-center w-8 h-8 rounded-md bg-red-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 sidebar-icon text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3v18m4-14v10m4-6v6m-12-2v2m-4-6v6" />
                        </svg>
                    </span>
                    <span class="text-sm font-medium text-slate-900">Criar Gráficos</span>
                </a>
            </li>
        </ul>

        
    <div class="mt-6 text-xs text-slate-500">
        Sistema de Gráficos v1.0
    </div>
</aside>

<!-- Overlay for mobile sidebar -->
<div id="sidebarOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40" onclick="toggleSidebar()"></div>