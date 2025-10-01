<?php
$host = "localhost";
$db   = "picagens";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) { die("Erro na conexão: " . $conn->connect_error); }
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; display: flex; }
        .sidebar {
            width: 80px; background: #2c3e50; color: white; height: 100vh; padding: 15px 5px;
            display: flex; flex-direction: column; align-items: center; gap: 20px;
        }
        .sidebar button {
            background: none; border: none; color: white; font-size: 28px; cursor: pointer;
        }
        .content { flex: 1; padding: 20px; }
        /* Modal */
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                 background: rgba(0,0,0,0.5); justify-content: center; align-items: center; }
        .modal-content {
            background: white; padding: 20px; border-radius: 10px; width: 300px;
        }
        .modal-content h3 { margin-top: 0; }
        .modal-content button { margin-top: 10px; padding: 8px 12px; cursor: pointer; }
    </style>
</head>
<body>
    <!-- Sidebar com ícones -->
    <div class="sidebar">
        <button onclick="abrirModal('bar')">📊</button>
        <button onclick="abrirModal('pie')">🥧</button>
        <button onclick="abrirModal('line')">📈</button>
    </div>

    <!-- Conteúdo -->
    <div class="content">
        <h2 id="tituloGrafico">Escolha um gráfico</h2>
        <canvas id="meuGrafico"></canvas>
    </div>

    <!-- Modal -->
    <div class="modal" id="meuModal">
        <div class="modal-content">
            <h3>Escolher Dados</h3>
            <p>Mostrar gráfico por:</p>
            <button onclick="carregarGrafico('status')">Status</button>
            <button onclick="carregarGrafico('funcionario')">Funcionário</button>
            <button onclick="carregarGrafico('oficina')">Oficina</button>
            <br><br>
            <button onclick="fecharModal()">Fechar</button>
        </div>
    </div>

    <script>
        let tipoGrafico = 'bar'; // padrão
        let chart;

        function abrirModal(tipo) {
            tipoGrafico = tipo;
            document.getElementById('meuModal').style.display = 'flex';
        }

        function fecharModal() {
            document.getElementById('meuModal').style.display = 'none';
        }

        async function carregarGrafico(categoria) {
            fecharModal();
            document.getElementById("tituloGrafico").innerText = 
                "Gráfico de " + categoria.charAt(0).toUpperCase() + categoria.slice(1);

            // Buscar dados no servidor (API PHP)
            const resposta = await fetch("dados.php?tipo=" + categoria);
            const dados = await resposta.json();

            // Destruir gráfico antigo se existir
            if (chart) { chart.destroy(); }

            // Criar novo gráfico
            const ctx = document.getElementById('meuGrafico').getContext('2d');
            chart = new Chart(ctx, {
                type: tipoGrafico,
                data: {
                    labels: dados.labels,
                    datasets: [{
                        label: 'Total',
                        data: dados.valores,
                        backgroundColor: ['#36A2EB','#FF6384','#4BC0C0','#FFCE56','#9966FF']
                    }]
                },
                options: { responsive: true }
            });
        }
    </script>
</body>
</html>
