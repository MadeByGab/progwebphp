<?php
$conn = pg_connect("host=localhost dbname=produtos user=postgres password=123456");
if (!$conn) {
    die("Erro na conexão com o banco de dados.");
}
?>
