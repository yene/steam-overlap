<?php
$cmd = 'find cache/ -name "*.json" -type f -mtime +10 -delete';
exec($cmd);
