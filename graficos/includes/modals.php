<!-- Modal para criar gráfico de barras -->
<div id="barChartModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
  <div class="bg-white rounded-lg shadow-xl w-full max-w-md max-h-[90vh] overflow-hidden">
    <!-- Header -->
    <div class="flex items-center justify-between p-6 border-b border-slate-200">
      <h3 class="text-lg font-semibold text-slate-800">Criar Gráfico de Barras</h3>
      <button onclick="closeBarChartModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Form -->
    <div class="p-6 space-y-6 overflow-y-auto max-h-[60vh]">
      <!-- Título do Gráfico -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Título do Gráfico</label>
        <input type="text" id="chartTitle" placeholder="Ex: Vendas Mensais 2024" 
               class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
      </div>

      <!-- Eixo X -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Eixo X (Categorias)</label>
        <select id="xAxis" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <option value="">Selecionar variável...</option>
          <option value="meses">Meses</option>
          <option value="produtos">Produtos</option>
          <option value="categorias">Categorias</option>
          <option value="regioes">Regiões</option>
          <option value="vendedores">Vendedores</option>
        </select>
      </div>

      <!-- Eixo Y -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Eixo Y (Valores)</label>
        <select id="yAxis" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <option value="">Selecionar variável...</option>
          <option value="vendas">Vendas</option>
          <option value="lucro">Lucro</option>
          <option value="clientes">Clientes</option>
          <option value="produtos_vendidos">Produtos Vendidos</option>
          <option value="visitas">Visitas</option>
        </select>
      </div>

      <!-- Filtro (Opcional) -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Filtro (Opcional)</label>
        <select id="chartFilter" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <option value="">Sem filtro</option>
          <option value="ano_2024">Ano 2024</option>
          <option value="trimestre_1">1º Trimestre</option>
          <option value="regiao_norte">Região Norte</option>
          <option value="produto_a">Produto A</option>
        </select>
      </div>

      <!-- Opções de Visualização -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Opções de Visualização</label>
        <div class="space-y-2">
          <label class="flex items-center">
            <input type="checkbox" id="showValues" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500" checked>
            <span class="ml-2 text-sm text-slate-600">Mostrar valores nas barras</span>
          </label>
          <label class="flex items-center">
            <input type="checkbox" id="showGrid" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500" checked>
            <span class="ml-2 text-sm text-slate-600">Mostrar linhas de grade</span>
          </label>
          <label class="flex items-center">
            <input type="checkbox" id="showLegend" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500" checked>
            <span class="ml-2 text-sm text-slate-600">Mostrar legenda</span>
          </label>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="flex justify-end space-x-3 p-6 border-t border-slate-200 bg-slate-50">
      <button onclick="closeBarChartModal()" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-md hover:bg-slate-50 transition-colors">
        Cancelar
      </button>
      <button onclick="previewChart()" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-colors">
        Pré-visualizar
      </button>
      <button onclick="addToDashboard()" class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 transition-colors">
        Adicionar ao Dashboard
      </button>
    </div>
  </div>
</div>

<!-- Área de Pré-visualização -->
<div id="chartPreview" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
  <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-hidden">
    <div class="flex items-center justify-between p-6 border-b border-slate-200">
      <h3 class="text-lg font-semibold text-slate-800">Pré-visualização do Gráfico</h3>
      <button onclick="closePreview()" class="text-slate-400 hover:text-slate-600 transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
    
    <div class="p-6">
      <div id="previewContainer" class="bg-gray-50 rounded-lg p-4 min-h-[400px] flex items-center justify-center">
        <p class="text-gray-500">O gráfico será gerado aqui...</p>
      </div>
    </div>
    
    <div class="flex justify-end space-x-3 p-6 border-t border-slate-200 bg-slate-50">
      <button onclick="closePreview()" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-md hover:bg-slate-50 transition-colors">
        Voltar
      </button>
      <button onclick="addToDashboardFromPreview()" class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 transition-colors">
        Adicionar ao Dashboard
      </button>
    </div>
  </div>
</div>

<!-- Modal para criar gráfico de linhas -->
<div id="lineChartModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
  <div class="bg-white rounded-lg shadow-xl w-full max-w-md max-h-[90vh] overflow-hidden">
    <!-- Header -->
    <div class="flex items-center justify-between p-6 border-b border-slate-200">
      <h3 class="text-lg font-semibold text-slate-800">Criar Gráfico de Linhas</h3>
      <button onclick="closeLineChartModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Form -->
    <div class="p-6 space-y-6 overflow-y-auto max-h-[60vh]">
      <!-- Título do Gráfico -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Título do Gráfico</label>
        <input type="text" id="lineChartTitle" placeholder="Ex: Evolução de Vendas 2024" 
               class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
      </div>

      <!-- Eixo X -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Eixo X (Período)</label>
        <select id="lineXAxis" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <option value="">Selecionar período...</option>
          <option value="meses">Meses</option>
          <option value="semanas">Semanas</option>
          <option value="trimestres">Trimestres</option>
          <option value="dias">Dias</option>
          <option value="anos">Anos</option>
        </select>
      </div>

      <!-- Variável 1 -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Variável 1 (Linha 1)</label>
        <select id="lineVar1" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <option value="">Selecionar variável...</option>
          <option value="vendas">Vendas</option>
          <option value="lucro">Lucro</option>
          <option value="clientes">Clientes</option>
          <option value="produtos_vendidos">Produtos Vendidos</option>
          <option value="visitas">Visitas</option>
        </select>
      </div>

      <!-- Variável 2 -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Variável 2 (Linha 2)</label>
        <select id="lineVar2" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <option value="">Selecionar variável...</option>
          <option value="vendas">Vendas</option>
          <option value="lucro">Lucro</option>
          <option value="clientes">Clientes</option>
          <option value="produtos_vendidos">Produtos Vendidos</option>
          <option value="visitas">Visitas</option>
          <option value="despesas">Despesas</option>
        </select>
      </div>

      <!-- Variável 3 -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Variável 3 (Linha 3)</label>
        <select id="lineVar3" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <option value="">Selecionar variável...</option>
          <option value="vendas">Vendas</option>
          <option value="lucro">Lucro</option>
          <option value="clientes">Clientes</option>
          <option value="produtos_vendidos">Produtos Vendidos</option>
          <option value="visitas">Visitas</option>
          <option value="meta">Meta</option>
          <option value="crescimento">Crescimento %</option>
        </select>
      </div>

      <!-- Opções de Visualização -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Opções de Visualização</label>
        <div class="space-y-2">
          <label class="flex items-center">
            <input type="checkbox" id="lineShowPoints" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500" checked>
            <span class="ml-2 text-sm text-slate-600">Mostrar pontos nas linhas</span>
          </label>
          <label class="flex items-center">
            <input type="checkbox" id="lineShowGrid" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500" checked>
            <span class="ml-2 text-sm text-slate-600">Mostrar linhas de grade</span>
          </label>
          <label class="flex items-center">
            <input type="checkbox" id="lineSmooth" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
            <span class="ml-2 text-sm text-slate-600">Linhas suaves</span>
          </label>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="flex justify-end space-x-3 p-6 border-t border-slate-200 bg-slate-50">
      <button onclick="closeLineChartModal()" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-md hover:bg-slate-50 transition-colors">
        Cancelar
      </button>
      <button onclick="previewLineChart()" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-colors">
        Pré-visualizar
      </button>
      <button onclick="addLineChartToDashboard()" class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 transition-colors">
        Adicionar ao Dashboard
      </button>
    </div>
  </div>
</div>

<!-- Modal para criar gráfico de colunas múltiplas -->
<div id="columnChartModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
  <div class="bg-white rounded-lg shadow-xl w-full max-w-md max-h-[90vh] overflow-hidden">
    <!-- Header -->
    <div class="flex items-center justify-between p-6 border-b border-slate-200">
      <h3 class="text-lg font-semibold text-slate-800">Criar Gráfico de Colunas Múltiplas</h3>
      <button onclick="closeColumnChartModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Form -->
    <div class="p-6 space-y-6 overflow-y-auto max-h-[60vh]">
      <!-- Título do Gráfico -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Título do Gráfico</label>
        <input type="text" id="columnChartTitle" placeholder="Ex: Comparativo de Vendas por Região" 
               class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
      </div>

      <!-- Eixo X -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Eixo X (Categorias)</label>
        <select id="columnXAxis" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <option value="">Selecionar categoria...</option>
          <option value="regioes">Regiões</option>
          <option value="produtos">Produtos</option>
          <option value="categorias">Categorias</option>
          <option value="meses">Meses</option>
          <option value="vendedores">Vendedores</option>
        </select>
      </div>

      <!-- Variável 1 -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Variável 1 (Série 1)</label>
        <select id="columnVar1" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <option value="">Selecionar variável...</option>
          <option value="vendas_2023">Vendas 2023</option>
          <option value="vendas_2024">Vendas 2024</option>
          <option value="lucro">Lucro</option>
          <option value="meta">Meta</option>
          <option value="crescimento">Crescimento</option>
        </select>
      </div>

      <!-- Variável 2 -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Variável 2 (Série 2)</label>
        <select id="columnVar2" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <option value="">Selecionar variável...</option>
          <option value="vendas_2023">Vendas 2023</option>
          <option value="vendas_2024">Vendas 2024</option>
          <option value="lucro">Lucro</option>
          <option value="meta">Meta</option>
          <option value="crescimento">Crescimento</option>
          <option value="clientes">Clientes</option>
        </select>
      </div>

      <!-- Variável 3 -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Variável 3 (Série 3)</label>
        <select id="columnVar3" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <option value="">Selecionar variável...</option>
          <option value="vendas_2023">Vendas 2023</option>
          <option value="vendas_2024">Vendas 2024</option>
          <option value="lucro">Lucro</option>
          <option value="meta">Meta</option>
          <option value="crescimento">Crescimento</option>
          <option value="produtos_vendidos">Produtos Vendidos</option>
          <option value="visitas">Visitas</option>
        </select>
      </div>

      <!-- Tipo de Colunas -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Tipo de Colunas</label>
        <select id="columnType" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <option value="grouped">Colunas Agrupadas</option>
          <option value="stacked">Colunas Empilhadas</option>
        </select>
      </div>

      <!-- Opções de Visualização -->
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Opções de Visualização</label>
        <div class="space-y-2">
          <label class="flex items-center">
            <input type="checkbox" id="columnShowValues" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500" checked>
            <span class="ml-2 text-sm text-slate-600">Mostrar valores nas colunas</span>
          </label>
          <label class="flex items-center">
            <input type="checkbox" id="columnShowGrid" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500" checked>
            <span class="ml-2 text-sm text-slate-600">Mostrar linhas de grade</span>
          </label>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="flex justify-end space-x-3 p-6 border-t border-slate-200 bg-slate-50">
      <button onclick="closeColumnChartModal()" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-md hover:bg-slate-50 transition-colors">
        Cancelar
      </button>
      <button onclick="previewColumnChart()" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-colors">
        Pré-visualizar
      </button>
      <button onclick="addColumnChartToDashboard()" class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 transition-colors">
        Adicionar ao Dashboard
      </button>
    </div>
  </div>
</div>