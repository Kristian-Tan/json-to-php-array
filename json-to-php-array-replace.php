<?php

$options = getopt("j:"); //var_dump($options);

if(isset($options["j"])) $json = $options["j"];
else throw new \Exception("option required: j", 1);


$json = str_replace(":", "=>", $json);
$json = str_replace("{", "[", $json);
$json = str_replace("}", "]", $json);

echo $json;
