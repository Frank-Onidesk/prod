<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Auto Reno Picagens</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .hero-image {
      width: 100%;
      max-height: 500px;
      object-fit: cover;
    }
  </style>
</head>
<body class="bg-gray-50">

  <!-- ===== Título ===== -->
  <div class="container mx-auto px-4 py-8 text-center">
    <h1 class="text-4xl font-bold text-gray-800">Auto Reno Picagens</h1>
    <p class="text-xl text-gray-600 mt-2">Sistema de Gestão de Ordens de Reparação</p>
  </div>

  <script>
    // Mostrar/ocultar a password
    const pwd = document.getElementById('password');
    const btn = document.getElementById('togglePwd');
    btn.addEventListener('click', () => {
      if (pwd.type === 'password') {
        pwd.type = 'text';
        btn.textContent = '🙈';
        // btn.innerHTML  = '<i class="fa fa-eye" aria-hidden="true"></i>';  


      } else {
        pwd.type = 'password';
        btn.innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i>';
      }
    });

    // Validação simples do email no cliente
    document.querySelector('form').addEventListener('submit', (e) => {
      const email = document.getElementById('email').value.trim();
      if (!email || !email.includes('@')) {
        e.preventDefault();
        // alert('Por favor, introduza um e-mail válido.');
        //   showError('email','Por favor, introduza um e-mail válido!');

      }
    });
  </script>
  <script type="module" src="assets/js/login.js"></script>
</body>

  <!-- ===== How It Works Section ===== -->
  <section class="py-12 bg-white">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Como Funciona</h2>
      
      <div class="flex flex-col md:flex-row justify-between items-center">
        <!-- Step 1 -->
        <div class="flex flex-col items-center text-center mb-8 md:mb-0 md:w-1/3">
          <div class="flex items-center justify-center w-20 h-20 bg-red-100 rounded-full mb-4">
            <span class="text-red-600 font-bold text-xl">1</span>
          </div>
          <h3 class="text-xl font-semibold text-gray-800 mb-2">Criar Ordem</h3>
          <p class="text-gray-600 max-w-xs">
            Registe uma nova ordem de reparação com os dados do cliente e veículo.
          </p>
        </div>
        
        <!-- Step 2 -->
        <div class="flex flex-col items-center text-center mb-8 md:mb-0 md:w-1/3">
          <div class="flex items-center justify-center w-20 h-20 bg-blue-100 rounded-full mb-4">
            <span class="text-blue-600 font-bold text-xl">2</span>
          </div>
          <h3 class="text-xl font-semibold text-gray-800 mb-2">Acompanhar Reparação</h3>
          <p class="text-gray-600 max-w-xs">
            Atualize o estado da reparação e adicione observações à medida que o trabalho avança.
          </p>
        </div>
        
        <!-- Step 3 -->
        <div class="flex flex-col items-center text-center md:w-1/3">
          <div class="flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
            <span class="text-green-600 font-bold text-xl">3</span>
          </div>
          <h3 class="text-xl font-semibold text-gray-800 mb-2">Concluir e Faturar</h3>
          <p class="text-gray-600 max-w-xs">
            Finalize a reparação e gere automaticamente a fatura para o cliente.
          </p>
        </div>
      </div>
    </div>
  </section>

</body>
</html>