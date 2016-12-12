<?php

$myBirthDate = mktime(0, 0, 0, 12, 07, 1991);
echo date("M-d-Y", $myBirthDate) . '<br>';
echo date("D M j G:i:s Y", $myBirthDate) . '<br>';
echo date("U", $myBirthDate) . '<br>';
