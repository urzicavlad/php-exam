<?php
session_start();

printf('<h1>'.$_SESSION['error_message'].'</h1>');
