<?php
$currentDir = realpath(dirname(__FILE__));
$cmd = "find $currentDir/cache/ -name \"*.json\" -type f -mtime +10 -delete";
exec($cmd);
