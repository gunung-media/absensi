<?php
function rupiah($nilai, $pecahan = 0)
{
   return number_format($nilai, $pecahan, ',', '.');
}

function random($panjang)
{
   $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
   $string = '';
   for ($i = 0; $i < $panjang; $i++) {
      $pos = rand(0, strlen($karakter) - 1);
      $string .= $karakter[$pos];
   }
   return $string;
}
