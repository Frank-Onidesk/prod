// Funções específicas da sidebar
let isResizing = false;
let lastDownX = 0;
let sidebarWidth = 256; // 64 * 4 (w-64)

function initSidebarResize() {
    const resizeHandle = document.getElementById('resizeHandle');
    const sidebar = document.getElementById('sidebar');
    
    resizeHandle.addEventListener('mousedown', function(e) {
        isResizing = true;
        lastDownX = e.clientX;
        document.body.style.cursor = 'col-resize';
        
        e.preventDefault();
    });
    
    document.addEventListener('mousemove', function(e) {
        if (!isResizing) return;
        
        const deltaX = e.clientX - lastDownX;
        sidebarWidth = Math.max(200, Math.min(400, sidebarWidth + deltaX));
        
        sidebar.style.width = sidebarWidth + 'px';
        lastDownX = e.clientX;
    });
    
    document.addEventListener('mouseup', function() {
        isResizing = false;
        document.body.style.cursor = '';
    });
}

// Inicializar resize da sidebar
document.addEventListener('DOMContentLoaded', function() {
    initSidebarResize();
});