// Funções principais do dashboard
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const btnOutside = document.getElementById('btnOutside');
    const btnInside = document.getElementById('btnInside');
    const mainContent = document.querySelector('main');
    const overlay = document.getElementById('sidebarOverlay');
    
    sidebar.classList.toggle('hidden');
    btnOutside.classList.toggle('hidden');
    btnInside.classList.toggle('hidden');
    
    if (sidebar.classList.contains('hidden')) {
        mainContent.classList.remove('md:ml-64');
        overlay.classList.add('hidden');
    } else {
        mainContent.classList.add('md:ml-64');
        if (window.innerWidth < 768) {
            overlay.classList.remove('hidden');
        }
    }
}

// ========== SIDEBAR DIREITA ==========
function toggleRightSidebar() {
    const rightSidebar = document.getElementById('sidebarRight');
    rightSidebar.classList.toggle('hidden');
    
    // Se estiver em mobile, adicionar overlay
    if (window.innerWidth < 768 && !rightSidebar.classList.contains('hidden')) {
        createRightSidebarOverlay();
    }
}

function openRightSidebar() {
    const rightSidebar = document.getElementById('sidebarRight');
    rightSidebar.classList.remove('hidden');
    
    // Se estiver em mobile, adicionar overlay
    if (window.innerWidth < 768) {
        createRightSidebarOverlay();
    }
}

function closeRightSidebar() {
    const rightSidebar = document.getElementById('sidebarRight');
    rightSidebar.classList.add('hidden');
    removeRightSidebarOverlay();
}

function createRightSidebarOverlay() {
    // Remover overlay existente
    removeRightSidebarOverlay();
    
    // Criar novo overlay
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

function selectChartType(type) {
    const info = document.getElementById('selectedChartInfo');
    info.textContent = `Gráfico selecionado: ${type}`;
    info.classList.add('font-semibold');
    
    // Fechar sidebar após seleção (opcional)
    setTimeout(() => {
        closeRightSidebar();
    }, 1000);
}

// Mobile sidebar functions
function toggleLeftSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    sidebar.classList.toggle('hidden');
    overlay.classList.toggle('hidden');
}

// Inicialização
document.addEventListener('DOMContentLoaded', function() {
    // Fechar sidebar direita ao clicar fora (apenas desktop)
    document.addEventListener('click', function(event) {
        if (window.innerWidth >= 768) {
            const rightSidebar = document.getElementById('sidebarRight');
            const graficosBtn = document.querySelector('button[onclick*="RightSidebar"]');
            
            if (rightSidebar && !rightSidebar.classList.contains('hidden') &&
                !rightSidebar.contains(event.target) && 
                !graficosBtn.contains(event.target)) {
                closeRightSidebar();
            }
        }
    });

    // Fechar com ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeRightSidebar();
        }
    });

    // Responsividade
    window.addEventListener('resize', function() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        if (window.innerWidth >= 768) {
            sidebar.classList.remove('hidden');
            overlay.classList.add('hidden');
            removeRightSidebarOverlay();
        }
    });

    // Debug
    console.log('Dashboard.js carregado!');
    console.log('toggleRightSidebar:', typeof toggleRightSidebar);
});