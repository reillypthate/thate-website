<?php

/******************************************************************************/
/** Common Functions **********************************************************/
/******************************************************************************/
/**
 * This function will format the html code passed into it as an array
 * by adding line breaks (\r\n) after each line.
 */
function generateLines($lines)
{
    $product = "";
    
    for($x=0; $x < count($lines); ++$x)
    {
        /*
        if(strlen($lines[$x]) > 80)
        {
            $temp = str_split($lines[$x], 80);
            foreach($temp as $y)
            {
                echo $y . "\r\n";
            }
        }else
        {
            
        }*/
        echo $lines[$x] . "\r\n";
    }

    return $product;
}

?>