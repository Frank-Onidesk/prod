// Sistema de Arrastar e Redimensionar
class DashboardManager {
    constructor() {
        this.draggableContainer = null;
        this.isDragging = false;
        this.isResizing = false;
        this.currentElement = null;
        this.offset = { x: 0, y: 0 };
        this.resizeDirection = null;
        
        this.init();
    }
    
    init() {
        this.draggableContainer = document.getElementById('customChartsContainer');
        if (!this.draggableContainer) {
            console.error('Container para gráficos personalizados não encontrado!');
            return;
        }
        
        this.makeContainerDraggable();
        this.loadDashboardLayout();
    }
    
    makeContainerDraggable() {
        // Permitir drop
        this.draggableContainer.addEventListener('dragover', (e) => {
            e.preventDefault();
            this.draggableContainer.classList.add('bg-blue-50');
        });
        
        this.draggableContainer.addEventListener('dragleave', () => {
            this.draggableContainer.classList.remove('bg-blue-50');
        });
        
        this.draggableContainer.addEventListener('drop', (e) => {
            e.preventDefault();
            this.draggableContainer.classList.remove('bg-blue-50');
        });
    }
    
    addChartElement(config) {
        const chartElement = this.createChartElement(config);
        this.draggableContainer.appendChild(chartElement);
        this.makeElementDraggable(chartElement);
        this.makeElementResizable(chartElement);
        this.saveDashboardLayout();
        
        return chartElement;
    }
    
    createChartElement(config) {
        const sizeClasses = this.getSizeClasses(config.size);
        const element = document.createElement('div');
        
        element.id = config.id;
        element.className = `dashboard-item ${sizeClasses} bg-white rounded-lg shadow-lg border border-slate-200 cursor-move relative group`;
        element.draggable = true;
        element.innerHTML = this.generateChartHTML(config);
        
        return element;
    }
    
    getSizeClasses(size) {
        const sizes = {
            'pequeno': 'col-span-1 row-span-1',
            'medio': 'col-span-2 row-span-1',
            'grande': 'col-span-2 row-span-2'
        };
        return sizes[size] || 'col-span-1 row-span-1';
    }
    
    generateChartHTML(config) {
        const baseHTML = `
            <div class="chart-header flex justify-between items-center p-4 border-b border-slate-200">
                <h3 class="font-semibold text-slate-800">${config.title}</h3>
                <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                    <button onclick="this.closest('.dashboard-item').remove(); dashboardManager.saveDashboardLayout();" 
                            class="p-1 text-slate-400 hover:text-red-500" title="Remover">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="chart-content p-4">
                ${this.generateChartContent(config)}
            </div>
            <div class="resize-handle absolute bottom-1 right-1 w-3 h-3 bg-blue-500 rounded cursor-se-resize opacity-0 group-hover:opacity-100 transition-opacity"></div>
        `;
        
        return baseHTML;
    }
    
    generateChartContent(config) {
        switch(config.type) {
            case 'barras':
                return `
                    <div class="h-40 bg-gradient-to-r from-blue-50 to-blue-100 rounded flex items-center justify-center">
                        <p class="text-blue-600 text-sm">Gráfico de Barras: ${config.variables?.join(', ') || 'Nenhuma variável'}</p>
                    </div>
                `;
                
            case 'estatistica':
                return `
                    <div class="text-center">
                        <div class="text-3xl font-bold text-slate-800 mb-2">${config.value}</div>
                        <div class="text-sm text-green-600">+5.2% vs último mês</div>
                    </div>
                `;
                
            case 'circular':
                return `
                    <div class="h-40 bg-gradient-to-r from-purple-50 to-purple-100 rounded flex items-center justify-center">
                        <p class="text-purple-600 text-sm">Gráfico Circular: ${config.categories}</p>
                    </div>
                `;
                
            default:
                return '<p>Visualização não suportada</p>';
        }
    }
    
    makeElementDraggable(element) {
        element.addEventListener('dragstart', (e) => {
            e.dataTransfer.setData('text/plain', element.id);
            element.classList.add('opacity-50');
        });
        
        element.addEventListener('dragend', () => {
            element.classList.remove('opacity-50');
            this.saveDashboardLayout();
        });
        
        // Drag interna dentro do container
        let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        
        element.addEventListener('mousedown', dragMouseDown);
        
        function dragMouseDown(e) {
            if (e.target.closest('button')) return; // Não arrastar se clicar em botões
            
            e.preventDefault();
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.addEventListener('mouseup', closeDragElement);
            document.addEventListener('mousemove', elementDrag);
        }
        
        const elementDrag = (e) => {
            e.preventDefault();
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            
            // Calcular nova posição
            const newTop = element.offsetTop - pos2;
            const newLeft = element.offsetLeft - pos1;
            
            // Aplicar limites
            const containerRect = this.draggableContainer.getBoundingClientRect();
            const elementRect = element.getBoundingClientRect();
            
            if (newTop >= 0 && newTop + elementRect.height <= containerRect.height) {
                element.style.top = newTop + 'px';
            }
            
            if (newLeft >= 0 && newLeft + elementRect.width <= containerRect.width) {
                element.style.left = newLeft + 'px';
            }
        };
        
        const closeDragElement = () => {
            document.removeEventListener('mouseup', closeDragElement);
            document.removeEventListener('mousemove', elementDrag);
            this.saveDashboardLayout();
        };
    }
    
    makeElementResizable(element) {
        const handle = element.querySelector('.resize-handle');
        
        handle.addEventListener('mousedown', (e) => {
            e.preventDefault();
            e.stopPropagation();
            this.startResizing(element, 'se');
        });
    }
    
    startResizing(element, direction) {
        this.isResizing = true;
        this.currentElement = element;
        this.resizeDirection = direction;
        
        const startX = event.clientX;
        const startY = event.clientY;
        const startWidth = parseInt(document.defaultView.getComputedStyle(element).width, 10);
        const startHeight = parseInt(document.defaultView.getComputedStyle(element).height, 10);
        
        const doResize = (e) => {
            if (!this.isResizing) return;
            
            const newWidth = startWidth + (e.clientX - startX);
            const newHeight = startHeight + (e.clientY - startY);
            
            // Limites mínimos e máximos
            if (newWidth > 200 && newWidth < 800) {
                element.style.width = newWidth + 'px';
            }
            
            if (newHeight > 150 && newHeight < 600) {
                element.style.height = newHeight + 'px';
            }
        };
        
        const stopResize = () => {
            this.isResizing = false;
            document.removeEventListener('mousemove', doResize);
            document.removeEventListener('mouseup', stopResize);
            this.saveDashboardLayout();
        };
        
        document.addEventListener('mousemove', doResize);
        document.addEventListener('mouseup', stopResize);
    }
    
    saveDashboardLayout() {
        const items = Array.from(this.draggableContainer.querySelectorAll('.dashboard-item'));
        const layout = items.map(item => ({
            id: item.id,
            type: item.dataset.type,
            size: item.dataset.size,
            position: {
                top: item.style.top,
                left: item.style.left,
                width: item.style.width,
                height: item.style.height
            }
        }));
        
        localStorage.setItem('dashboardLayout', JSON.stringify(layout));
    }
    
    loadDashboardLayout() {
        const savedLayout = localStorage.getItem('dashboardLayout');
        if (savedLayout) {
            const layout = JSON.parse(savedLayout);
            layout.forEach(itemConfig => {
                const element = this.createChartElement(itemConfig);
                if (itemConfig.position) {
                    Object.assign(element.style, itemConfig.position);
                }
                this.draggableContainer.appendChild(element);
                this.makeElementDraggable(element);
                this.makeElementResizable(element);
            });
        }
    }
}

// Inicializar manager
let dashboardManager;

document.addEventListener('DOMContentLoaded', function() {
    dashboardManager = new DashboardManager();
    
    // Remover gráficos padrão iniciais
    const defaultCharts = document.querySelectorAll('#barChart, #pieChart');
    defaultCharts.forEach(chart => {
        const parent = chart.closest('.grid-card');
        if (parent) {
            parent.remove();
        }
    });
});

// Função global para adicionar gráficos
function addChartToDashboard(config) {
    if (dashboardManager) {
        dashboardManager.addChartElement(config);
        showNotification(`${config.title} adicionado ao dashboard!`);
    }
}