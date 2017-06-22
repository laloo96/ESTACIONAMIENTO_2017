<?php

require_once('./php/AccesoDatos.php');
require_once('./clases/Usuario.php');

print_r(Usuario::ExisteUsuario("user1","111"));

/*
print_r(Usuario::TraerTodosLosUsuarios());*/