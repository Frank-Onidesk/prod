// Funções específicas de gráficos
// Este arquivo pode conter funções mais avançadas de manipulação de gráficos

// Exemplo: Criar gráfico dinâmico
function createDynamicChart(canvasId, type, data, options) {
    const ctx = document.getElementById(canvasId).getContext('2d');
    return new Chart(ctx, {
        type: type,
        data: data,
        options: options
    });
}

// Exemplo: Atualizar dados do gráfico
function updateChartData(chart, newData) {
    chart.data = newData;
    chart.update();
}

// Exemplo: Exportar gráfico
function exportChartAsImage(chartId, filename = 'grafico') {
    const canvas = document.getElementById(chartId);
    const link = document.createElement('a');
    link.download = `${filename}.png`;
    link.href = canvas.toDataURL();
    link.click();
}

// Funções utilitárias para gráficos
function generateRandomColor() {
    return `#${Math.floor(Math.random()*16777215).toString(16)}`;
}

function getChartColors(numColors) {
    const colors = [];
    for (let i = 0; i < numColors; i++) {
        colors.push(generateRandomColor());
    }
    return colors;
}