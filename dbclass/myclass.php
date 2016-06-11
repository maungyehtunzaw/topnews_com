<?php
class PreNxt{
	function getNextVal(&$array, $curr_val)
{
    $next = 0;
    reset($array);

    do
    {
        $tmp_val = current($array);
        $res = next($array);
    } while ( ($tmp_val != $curr_val) && $res );

    if( $res )
    {
        $next = current($array);
    }

    return $next;
}

function getPrevVal(&$array, $curr_val)
{
    end($array);
    $prev = current($array);

    do
    {
        $tmp_val = current($array);
        $res = prev($array);
    } while ( ($tmp_val != $curr_val) && $res );

    if( $res )
    {
        $prev = current($array);
    }

    return $prev;
}
}
?>