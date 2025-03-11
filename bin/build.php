<?php


define (constant_name: "ROOT", value: dirname(path: __DIR__));
include ROOT . "/vendor/autoload.php";

$config = json_decode(file_get_contents(ROOT."/toolkit.json"), true);

$vars = [];
$varsDirectoryPathe = $config["vars"];
$pattern = ROOT . $varsDirectoryPathe . "*.php";
foreach (glob($pattern) as $varFile)
{
    $key = str_replace(".php","",basename($varFile));
    $vars[$key] = include $varFile;
}
$markdown = $config["markdown"];
foreach ($markdown as $src => $dist)
{
    $src = ROOT . $src;
    $data = include ROOT . $varsDirectoryPathe . "pages/" . basename($src);
    $dist = ROOT . $dist;
    ob_start();
    include $src;
    $contents = ob_get_contents();
    ob_end_clean();
    file_put_contents($dist, $contents);
}

echo "[All built!]\n";