<?php

/* Name: util.php
 * Description: Contains utility functions.
 * Author: Erasmo Aguilera
 * Date: October 8, 2014
 */

namespace common\util;

// Returns the value passed as parameter, just as it is.
// This function is specially useful to get the value returned by any other
// function within a heredoc statement.
function value_of($value)
{
    return $value;
}
