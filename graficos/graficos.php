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
    <title>Auto Reno Picagens - Criar Gráficos</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            <h1 class="text-2xl font-bold text-gray-800">Criar Gráficos Personalizados</h1>
        </div>
        
        <button onclick="toggleRightSidebar()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Criar Novo Gráfico
        </button>
    </div>

    <!-- Seção Informativa -->
    <div class="mb-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6 border border-blue-200">
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-blue-800 mb-2">Como criar seus gráficos</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-blue-700">
                    <div class="flex items-start gap-2">
                        <span class="bg-blue-100 text-blue-600 rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mt-0.5">1</span>
                        <div>
                            <strong>Clique em "Criar Novo Gráfico"</strong>
                            <p class="text-blue-600">Escolha o tipo de visualização que deseja criar</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="bg-blue-100 text-blue-600 rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mt-0.5">2</span>
                        <div>
                            <strong>Preencha as informações</strong>
                            <p class="text-blue-600">Adicione título, dados e personalizações</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="bg-blue-100 text-blue-600 rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mt-0.5">3</span>
                        <div>
                            <strong>Adicione ao workspace</strong>
                            <p class="text-blue-600">O gráfico aparecerá na área abaixo</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="bg-blue-100 text-blue-600 rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mt-0.5">4</span>
                        <div>
                            <strong>Guarde e visualize</strong>
                            <p class="text-blue-600">Clique em "Guardar Todos" e depois "Ver Meus Gráficos"</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos Criados pelo Utilizador -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800">Meus Gráficos</h2>
            <div class="flex gap-2">
                <button onclick="saveAllCharts()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Guardar Todos
                </button>
                <button onclick="clearAllCharts()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Limpar Tudo
                </button>
                <a href="index.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Ver Meus Gráficos
                </a>
            </div>
        </div>
        
        <div id="customChartsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 relative min-h-[400px] p-6 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                <svg class="w-20 h-20 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <p class="text-gray-400 text-lg text-center mb-2">Área de Trabalho Vazia</p>
                <p class="text-gray-500 text-center max-w-md">
                    Os gráficos que criar aparecerão aqui. Use o botão "Criar Novo Gráfico" para começar.
                </p>
            </div>
        </div>
    </div>
</main>

<!-- Incluir Sidebar Direita -->
<?php include 'includes/sidebar-right.php'; ?>

<!-- Modal Universal para Criar Gráficos -->
<div id="universalChartModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg w-full max-w-md">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 id="universalModalTitle" class="text-lg font-semibold">Criar Gráfico</h3>
            <button onclick="closeUniversalModal()" class="text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div id="universalModalContent" class="p-6">
            <!-- Conteúdo dinâmico -->
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="js/chart-creator.js"></script>

</body>
</html>