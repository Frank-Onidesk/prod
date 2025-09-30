<?php
// index.php
session_start();

// Simples tratamento do POST
$error = '';
$old = ['email' => '', 'remember' => false];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $password = $_POST['password'] ?? '';
  $remember = isset($_POST['remember']);

  $old['email'] = $email;
  $old['remember'] = $remember;

  // TODO: substituir por consulta à base de dados
  $demoEmail = 'matilde@autoreno.pt';
  $demoPassword = '123';

  if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Por favor, introduza um e-mail válido.';
  } elseif (empty($password)) {
    $error = 'Por favor, introduza a palavra-passe.';
  } elseif ($email === $demoEmail && $password === $demoPassword) {
    $_SESSION['user_email'] = $email;
    if ($remember) {
      setcookie('remember_me', $email, time() + (86400 * 30), '/'); // 30 dias
    }
    header('Location: /picagens/prod/ui/');
    exit;
  } else {
    $error = 'Credenciais inválidas. (ex: user@example.com / secret123)';
  }
}

// Função auxiliar para escapar saída
function e($s)
{
  return htmlspecialchars($s ?? '', ENT_QUOTES);
}
?>