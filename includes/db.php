<?php
function connect()
{
    $con = new mysqli("localhost", "root", "", "quantumsci");
    return $con;
}
