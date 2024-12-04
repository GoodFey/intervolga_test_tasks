<?php
function getCountSisters($sisters, $brothers)
{
    $alice = 1;
    return $sisters + $alice;
}

echo getCountSisters(5, 1);