<?php 
function readEnvFile() {
    $file = fopen(__DIR__ . '/.env', 'r');
    $content = '';
    while ($line = fgets($file)) {
        $content .= $line;
    }
    fclose($file);

    $variables = explode(PHP_EOL, $content);

    $env_vars = [];
    foreach ($variables as $variable) {
        $parts = explode('=', $variable, 2);
        $key = trim($parts[0]);
        $value = trim($parts[1]);
        $env_vars[$key] = $value;
    }

    return $env_vars;
}

$env_vars = readEnvFile();
$DB_HOST = $env_vars['DB_HOST'];
$DB_USER = $env_vars['DB_USER'];
$DB_PASSWORD = $env_vars['DB_PASSWORD'];
$DB_SCHEMA = $env_vars['DB_SCHEMA'];
$DB_PORT = $env_vars['DB_PORT'];
$DB_NAME = $env_vars['DB_NAME'];
?>
