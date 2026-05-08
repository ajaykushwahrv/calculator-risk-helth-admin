<?php
header("Content-Type: text/css");
require __DIR__ . '/rvm-include/config.php';
echo rv_fetchDynamic('calculator-style', $config_data);
?>