<?php

//
function returnDestinationName($destination)
{
  $value = "";
  if($destination == "bridgetown")
  {
    // return Bridgetown
    $value = "Bridgetown";
  } else if($destination == "warrens")
  {
    // return Warrens
    $value = "Warrens";
  } else if($destination == "lazaretto")
  {
    // returns Lazaretto
    $value = "Lazaretto";
  } else if($destination == "heightsterraces")
  {
    // return Heights & Terraces
    $value = "Heights & Terraces";
  }
  
  return $value;
}
//echo returnDestinationName("bridgetown");
?>