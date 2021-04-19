<?php

$options = getopt("j:l::i::"); //var_dump($options);

if(isset($options["j"])) $json = $options["j"];
else throw new \Exception("option required: j", 1);

if(isset($options["l"])) $level = $options["l"];
else $level=0;

if(isset($options["i"])) $indent = $options["i"];
else $indent="  ";

$json = json_decode($json, true);

if(empty($json)) throw new \Exception("invalid json", 2);

function array_is_assoc($array)
{
    if(!is_array($array)) throw new Exception("non-array", 3);
    if(json_encode($array) == json_encode(array_values($array))) return false;
    else return true;
    
}

function print_recursive($obj, $level=0, $indent="    ")
{
    foreach ($obj as $key => $value) 
    {
        if(is_array($value))
        {
            echo str_repeat($indent, $level); 
            if(array_is_assoc($value)) echo "\"" . $key . "\"" . " => ";
            echo "["."\r\n";
            print_recursive($value, $level+1, $indent);
            echo str_repeat($indent, $level) . "]";
        }
        else
        {
            echo str_repeat($indent, $level) . "\"" . $key . "\"" . " => " . "\"" . $value . "\"";
        }
        echo ","."\r\n";
    }
}

print_recursive([$json], $level, $indent);
