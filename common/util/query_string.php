<?php

namespace common\util\query_string;

// Returns a dictionary of key-value pairs found in the specified query string.
function pairs_of ($query_string)
{
    // Get the key-value pairs of the query string.
    $query_pairs = explode ("&", $query_string);
    // Split each pair and add it into the result dictionary.
    foreach ($query_pairs as $pair) {
        $pair_parts = explode("=", $pair);
        $key = $pair_parts[0];
        $value = $pair_parts[1];
        $result[$key] = $value;
    }
    // Return the dictionary.
    return $result;
}
