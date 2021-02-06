<?php

/**
 * Find Close Parent Thesis on string
 * 
 * @param string $str
 * @param int $findIndex
 * 
 * @return int|string
*/
function findCloseParenThesis(string $str, int $findIndex) 
{
    $characters = array_slice(str_split($str), $findIndex, null, true);
    $countThesis = 0;

    if ($characters[$findIndex] !== '(') {
        return 'Characters not found';
    }

    foreach ($characters as $index => $char) {
        if ($char === '(') {
            $countThesis++;
        } elseif ($char === ')') {
            $countThesis--;
        }

        if ($countThesis === 0) {
            return $index;
            
            break;
        }
    }

    return 'Index not found';
}

echo findCloseParenthesis("a (b c (d e (f) g) h) i (j k)", 2);