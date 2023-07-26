<?php

$pass="admin";//guardada en BD
$hash = encriptar($pass);

echo "la contraseña en BD es: ",$pass,"\n";
echo "la contraseña BD  encriptada es: ",$hash,"\n";
echo "length: ",strlen($hash),"\n";
$str = "admin";
$user_input = md5($str);// entrada en login
echo "la contraseña en login es: ",$str,"\n";
echo "la contraseña login md5 es: ",$user_input,"\n";
echo "length: ",strlen($user_input),"\n";
comprobar_pass($str,$hash);

function encriptar($password){
   $cryptoword ="Hospital_Las_Mercedes";
   $passmd5 = md5($password);
   //echo "passmd5= ", $passmd5,"<br>";
   $hashed_password = crypt($passmd5,$cryptoword);
   //echo "hashed_password= ",$hashed_password,"<br>";
   return $hashed_password;
}

function comprobar_pass($user_input, $hashed_password){
   echo "user_input :".$user_input." \n";
   echo "hashed_password :".$hashed_password." \n";
   if (hash_equals($hashed_password, crypt(md5($user_input), $hashed_password))==true) {
      echo "¡Contraseña verificada!\n";
      return true;
   }
   else{
      echo "Contraseña erronea\n"; 
      return false;
   }
   echo "fin comprobar_pass";
}

if (hash_equals("HoVF6jXqXxc9.", crypt(md5("admin"),"HoVF6jXqXxc9."))) {
   echo "¡Contraseña verificada!\n";
   return true;
}
else{
   echo "Contraseña erronea\n"; 
   return false;
}


//echo "user_input= ",$user_input,"<br>";
//echo "user_input= ",crypt($user_input,$cryptoword),"<br>";

/* Se deben pasar todos los resultados de crypt() como el salt para la comparación de una
   contraseña, para evitar problemas cuando diferentes algoritmos hash son utilizados. (Como
   se dice arriba, el hash estándar basado en DES utiliza un salt de 2
   caracteres, pero el hash basado en MD5 utiliza 12.) */



?>
