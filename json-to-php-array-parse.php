<?php

$options = getopt("j:l::i::"); //var_dump($options);

if(isset($options["j"])) $json = $options["j"];
else throw new \Exception("option required: j", 1);

if(isset($options["l"])) $level = $options["l"];
else $level=0;

if(isset($options["i"])) $indent = $options["i"];
else $indent="    ";

$json = json_decode($json, true);

if(empty($json)) throw new \Exception("invalid json", 2);

/*
function array_is_assoc($array)
{
    if(!is_array($array)) throw new Exception("non-array", 3);
    if(json_encode($array) == json_encode(array_values($array))) return false;
    else return true;
}*/

function array_is_assoc(array $arr)
{
    if(!is_array($arr)) return false;
    if (array() === $arr) return false;
    return array_keys($arr) !== range(0, count($arr) - 1);
}

function print_recursive($obj, $assoc=false, $level=0, $indent="    ")
{
    //echo "aa"; var_dump($assoc); echo "\r\n\r\n";
    foreach ($obj as $key => $value) 
    {
        if(is_array($value))
        {
            echo str_repeat($indent, $level); 
            if($assoc) echo "\"" . $key . "\"" . " => ";
            echo "["."\r\n";
            print_recursive($value, array_is_assoc($value), $level+1, $indent);
            echo str_repeat($indent, $level) . "]";
        }
        else
        {
            echo str_repeat($indent, $level);
            if($assoc) echo "\"" . $key . "\"" . " => ";
            echo "\"" . $value . "\"";
        }
        echo ","."\r\n";
    }
}

print_recursive([$json], false, $level, $indent);
