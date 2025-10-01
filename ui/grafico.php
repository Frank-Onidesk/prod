<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
  <style>
    body { margin: 0; display: flex; font-family: Arial, sans-serif; }
    .sidebar {
      width: 80px; background: #2c3e50; color: white;
      display: flex; flex-direction: column; align-items: center;
      padding-top: 20px; height: 100vh;
    }
    .sidebar button {
      background: none; border: none; cursor: pointer;
      margin: 10px 0; color: white; font-size: 24px;
    }
    .content {
      flex: 1; display: flex; flex-wrap: wrap; padding: 10px;
      gap: 10px; background: #f4f4f4;
    }
    .chart-box {
      width: 300px; height: 250px; background: white;
      border: 1px solid #ccc; border-radius: 8px; padding: 5px;
      display: flex; justify-content: center; align-items: center;
      cursor: move;
    }
    #popup {
      display: none; position: fixed; top: 50%; left: 50%;
      transform: translate(-50%, -50%); background: white;
      padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,.3);
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <button onclick="abrirPopup('bar')">📊</button>
    <button onclick="abrirPopup('pie')">🥧</button>
    <button onclick="abrirPopup('line')">📈</button>
    <button onclick="abrirPopup('doughnut')">🍩</button>
    <button onclick="abrirPopup('radar')">🕸</button>
    <button onclick="abrirPopup('polarArea')">⭕</button>
  </div>

  <!-- Content area -->
  <div class="content" id="content"></div>

<!-- Popup -->
<div id="popup">
  <h3>Escolher variáveis</h3>
  <label>Variável X (categoria):</label><br>
  <select id="varX">
    <option value="function">Função</option>
    <option value="id_oficina">Oficina</option>
    <option value="status">Status</option>
  </select>
  <br><br>

  <label>Variável Y (métrica):</label><br>
  <select id="varY">
    <option value="COUNT(*)">Contagem</option>
    <option value="SUM(horas)">Soma de Horas</option>
    <option value="AVG(horas)">Média de Horas</option>
  </select>
  <br><br>

  <button onclick="criarGrafico()">Criar</button>
  <button onclick="fecharPopup()">Cancelar</button>
</div>

<script>
let tipoSelecionado = null;

function abrirPopup(tipo) {
  tipoSelecionado = tipo;
  document.getElementById('popup').style.display = 'block';
}
function fecharPopup() {
  document.getElementById('popup').style.display = 'none';
}

function criarGrafico() {
  fecharPopup();

  let varX = document.getElementById("varX").value;
  let varY = document.getElementById("varY").value;

  // AJAX para dados.php
  fetch("dados.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `varX=${varX}&varY=${varY}`
  })
  .then(res => res.json())
  .then(data => {
    const content = document.getElementById('content');
    const box = document.createElement('div');
    box.classList.add('chart-box');
    const canvas = document.createElement('canvas');
    box.appendChild(canvas);
    content.appendChild(box);

    new Chart(canvas, {
      type: tipoSelecionado,
      data: {
        labels: data.labels,
        datasets: [{
          label: `${varY} por ${varX}`,
          data: data.values,
          borderWidth: 1
        }]
      },
      options: { responsive: true, maintainAspectRatio: false }
    });
  });
}

// Drag & drop
new Sortable(document.getElementById('content'), { animation: 150 });
</script>

</body>
</html>
