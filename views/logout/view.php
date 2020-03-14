<?php 

use SlownLS\Auth\User; 

User::Logout();

header("Location: ./");
exit();

?>