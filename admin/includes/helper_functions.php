<?php

function returnTabs($numTabs)
{
    $tab = "";
    for($i = 0; $i < $numTabs; $i++)
    {
        $tab = $tab . "\t";
    }
    return $tab;
}
function generateSelectElement($for, $label, $access_var_name, $access_var, $function, $selector, $selector2, $condition_var, $numTabs)
{
    $lines = array(
        "<label for=\"$for\">$label</label>",
        "<select id=\"$for\" name=\"$access_var_name\">",
        "\t<option value=\"\">&mdash;</option>"
    );

    foreach($function as $item)
    {
        $temp = "\t";
        $temp = $temp . "<option value=\"" . $item[$selector] . "\"";
        if($condition_var)
        {
            if($access_var == $item[$selector])
            {
                $temp = $temp . " selected";
            }
        }
        $temp = $temp . ">" . $item[$selector] . ": " . $item[$selector2];
        $temp = $temp . "</option>";
        array_push($lines, $temp);  
    }

    array_push($lines, "</select>");

    $tabs = returnTabs($numTabs);
    for($i = 0; $i < count($lines); ++$i)
    {
        $lines[$i] = $tabs . $lines[$i];
    }

    echo generateLines($lines);
}

?>