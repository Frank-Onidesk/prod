<?php
require_once "app/php/validation/form_validation.php";
?>

<!doctype html>
<html lang="pt">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Entrar — Minha App</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="assets/css/style.css" rel="stylesheet" id='main-stylesheet'>
  <link href="assets/css/style_v2.css" rel="stylesheet" id='main2-stylesheet'>
  <link href="assets/css/form.css" rel="stylesheet" id='form-stylesheet'>
  <style>

  </style>

</head>

<body>
  <div class="container">
    <div class="left">
      <div class="card">
        <div class="brand">
          <div>
            <h1><i class="fas fa-sign-in-alt"></i> Login</h1>
            <p class="lead">Aceda à nova incrível plataforma de dados</p>
          </div>
        </div>

        <?php if ($error): ?>
          <div class="error"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="post" novalidate>
          <div>
            <label for="email">E-mail</label>
          <input id="email" name="email" type="email" placeholder="nome@exemplo.com" required autocomplete="username" value>
          </div>

          <div style="position:relative;">
            <label for="password">Palavra-passe</label>
            <input id="password" name="password" type="password" placeholder="A sua palavra-passe" required autocomplete="current-password" style="padding-right:40px;">
            <button type="button" class="show-password" id="togglePwd" style="position:absolute; right:10px; top:50%; transform:translateY(-50%); background:none; border:none; font-size:16px; cursor:pointer; padding:5px;">👁️</button>
          </div>

          <div class="row">
            <label class="small"><input type="checkbox" name="remember" <?= $old['remember'] ? 'checked' : '' ?>> Lembrar-me</label>
            <a class="link small" href="#">Esqueceu a palavra-passe?</a>
          </div>

          <div>
            <!--<button class="btn" type="submit">Entrar</button>-->
            <button class="btn" type="submit" id="loginBtn">Entrar</button>
          </div>

          <div class="muted small">Ainda não tem conta? <a class="link" href="#">Criar conta</a></div>
        </form>

        <div style="margin-top:1rem;font-size:0.8rem;color:#9ca3af;text-align:center">
          Dica demo: user@example.com / secret123
        </div>
      </div>
    </div>

    <div class="right">
      <div class="promo">
        <video autoplay muted loop playsinline>
          <source src="assets/videos/1.mp4" type="video/mp4">
          O seu browser não suporta vídeo HTML5.
        </video>
      </div>
    </div>
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

</html>