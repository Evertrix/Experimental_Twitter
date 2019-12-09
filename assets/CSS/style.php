<?php

/*** set the content type header ***/
/*** Without this header, it wont work ***/
header("Content-type: text/css");


$font_family = 'Arial, Helvetica, sans-serif';
$font_size = '0.7em';
$border = '1px solid';
?>

table {
margin: 8px;
}

.text-center {
font-family: <?= $font_family ?>;
font-size: <?= $font_size ?>;
background: #666;
color: red;
padding: 2px 6px;
border-collapse: separate;
border: <?= $border ?> #000;
}

td {
font-family: <?= $font_family ?>;
font-size: <?= $font_size ?>;
border: <?= $border ?> #DDD;
}