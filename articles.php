[


  {"name": "LED 1", "value": "1", "active": "<?php
$val = trim(@shell_exec("/usr/local/bin/gpio -g read 14"));
if($val == 1){
echo "true";
} else {
echo "false";
}
?>"},


  {"name": "LED 2", "value": "2", "active": "<?php
$val = trim(@shell_exec("/usr/local/bin/gpio -g read 18"));
if($val == 1){
echo "true";
} else {
echo "false";
}
?>"},


  {"name": "LED 3", "value": "3", "active": "<?php
$val = trim(@shell_exec("/usr/local/bin/gpio -g read 23"));
if($val == 1){
echo "true";
} else {
echo "false";
}
?>"},


  {"name": "LED 4", "value": "4", "active": "<?php
$val = trim(@shell_exec("/usr/local/bin/gpio -g read 25"));
if($val == 1){
echo "true";
} else {
echo "false";
}
?>"},


  {"name": "LED 5", "value": "5", "active": "<?php
$val = trim(@shell_exec("/usr/local/bin/gpio -g read 8"));
if($val == 1){
echo "true";
} else {
echo "false";
}
?>"}


]
