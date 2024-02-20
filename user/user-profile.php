<?php
session_start();
 echo "  <li class='nav-item'>
 <a class='nav-link' href='../index.php'>Welcome," .$_SESSION['username']."</a>

</li>";
?>