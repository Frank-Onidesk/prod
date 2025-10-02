<?php
// form_validation.php
session_start();

// Evitar enviar HTML antes do header()
ob_start();

$error = '';
$old = ['email' => '', 'remember' => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    $old['email'] = $email;
    $old['remember'] = $remember;

    // Credenciais fixas para teste
    $demoEmail = 'admin@exemplo.com';
    $demoPassword = '1234';

    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Por favor, introduza um e-mail válido.';
    } elseif (empty($password)) {
        $error = 'Por favor, introduza a palavra-passe.';
    } elseif ($email === $demoEmail && $password === $demoPassword) {
        $_SESSION['user_email'] = $email;

        if ($remember) {
            setcookie('remember_me', $email, time() + (86400 * 30), '/'); // 30 dias
        }

        // Redirecionar para graficos/index.php
        header('Location: /picagens/prod/graficos/index.php');
        exit;
    } else {
        $error = 'Credenciais inválidas.';
    }
}

// Se houver erro, voltar ao login.php com mensagem de erro
$_SESSION['login_error'] = $error;
$_SESSION['old_email'] = $old['email'];
$_SESSION['old_remember'] = $old['remember'];
header('Location: /picagens/prod/login.php');
exit;
