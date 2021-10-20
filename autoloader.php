<?php

function myAutoloader($class) {
    $fileName=sprintf("%s/classes/%s.php",__DIR__,$class);
    if (file_exists($fileName)){
        include $fileName;
    }
}
spl_autoload_register("myAutoloader");