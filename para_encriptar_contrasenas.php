<?php
   $pass="mypassword";
$passmd5 = md5($pass);
echo "passmd5= ", $passmd5,"<br>";
$hashed_password = crypt($passmd5,$cryptoword);
echo "hashed_password= ",$hashed_password,"<br>";

$str = "mypasword";
$user_input = md5($str);
echo "user_input= ",$user_input,"<br>";
echo "user_input= ",crypt($user_input,$cryptoword),"<br>";

/* Se deben pasar todos los resultados de crypt() como el salt para la comparación de una
   contraseña, para evitar problemas cuando diferentes algoritmos hash son utilizados. (Como
   se dice arriba, el hash estándar basado en DES utiliza un salt de 2
   caracteres, pero el hash basado en MD5 utiliza 12.) */

   if (hash_equals($hashed_password, crypt($user_input, $hashed_password))) {
   echo "¡Contraseña verificada!";
}
else{
	echo "Contraseña erronea"; 
}

?>
