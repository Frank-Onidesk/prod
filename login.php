<?php
// login.php
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Auto Reno Picagens</title>
  <style>
    body {
        background-color: #660f0fff;
      margin: 0;
      font-family: 'Segoe UI', Tahoma, sans-serif;
      height: 100vh;
    }

    .container {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 50px;
      min-height: 100vh;
      padding: 20px;
    }

    /* Caixa de login com cantos arredondados */
    .login-box {
      background: white;
      padding: 2rem;
      border-radius: 1rem; /* Cantos arredondados */
      box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
      max-width: 360px;
      width: 100%;
      text-align: center;
      border: 1px solid #ddd;
    }

    .login-title {
      font-size: 1.8rem;
      font-weight: bold;
      color: #333;
      margin-bottom: 1rem;
      border-bottom: 3px solid #92432b;
      padding-bottom: 0.5rem;
    }

    .login-form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    label {
      text-align: left;
      font-weight: 500;
      color: #555;
      display: block;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 0.5rem;
      font-size: 1rem;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      border-color: #1d4ed8;
      box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.2);
      outline: none;
    }

    .login-remember {
      display: flex;
      align-items: center;
      font-size: 0.9rem;
      color: #555;
    }

    .login-remember input {
      margin-right: 0.5rem;
    }

    .login-button {
      width: 100%;
      background-color: #1d4ed8;
      color: white;
      padding: 0.75rem;
      border: none;
      border-radius: 0.5rem;
      font-weight: bold;
      cursor: pointer;
      font-size: 1rem;
      transition: background 0.2s ease-in-out;
    }

    .login-button:hover {
      background-color: #2563eb;
    }

    .login-help {
      font-size: 0.85rem;
      color: #555;
      margin-top: 1rem;
    }

    .login-link {
      color: #1d4ed8;
      text-decoration: none;
      font-weight: bold;
    }

    .login-link:hover {
      text-decoration: underline;
    }

    /* Vídeo redondo */
    .video-circle {
      width: 200px;
      height: 200px;
      border-radius: 50%;
      overflow: hidden;
      border: 5px solid #92432b;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.3);
      flex-shrink: 0;
    }

    .video-circle video {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    @media (max-width: 900px) {
      .container {
        flex-direction: column;
        align-items: center;
      }
      .video-circle {
        margin-bottom: 20px;
      }
    }
  </style>
</head>
<body class="login-background"> <!-- mantém o fundo definido no style.css -->

  <div class="container">
    <div class="login-box">
      <h2 class="login-title">Faça o seu login</h2>
      <form method="POST" action="/picagens/prod/app/php/validation/form_validation.php" class="login-form">
        <div>
          <label for="email">Seu e-mail*</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div>
          <label for="password">Sua senha*</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div class="login-remember">
          <input type="checkbox" id="remember" name="remember">
          <label for="remember">Lembrar-me</label>
        </div>
        <button type="submit" class="login-button">ENTRAR</button>
      </form>
      <p class="login-help">Esqueceu sua senha? <a href="#" class="login-link">Clique aqui!</a></p>
    </div>

    <div class="video-circle">
      <video autoplay muted loop playsinline>
        <source src="/picagens/prod/assets/videos/video.mp4" type="video/mp4">
        O seu navegador não suporta vídeo.
      </video>
    </div>
  </div>
</body>
<div class="login-box">
    <h2>Faça o seu login</h2>
    <form method="POST" action="form_validation.php">
      <input type="email" name="email" placeholder="Seu e-mail" required>
      <input type="password" name="password" placeholder="Sua senha" required>
      <button type="submit">ENTRAR</button>
    </form>
  </div>
</body>
