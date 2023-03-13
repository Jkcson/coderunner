<?php

$filename = 'passwords.txt';
$username = $_POST['username'];
$password = $_POST['password'];

if (empty($username) || empty($password)) {
  http_response_code(400);
  die('Bad request.');
}

$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $index => $line) {
  if ($index % 3 === 0 && trim($line) === $username) {
    $hashedPassword = hash('sha256', trim($lines[$index + 1]));
    if ($hashedPassword === hash('sha256', $password)) {
      header('Content-Type: application/json');
      echo json_encode(['success' => true]);
      exit;
    } else {
      http_response_code(401);
      die('Unauthorized.');
    }
  }
}

http_response_code(401);
die('Unauthorized.');
