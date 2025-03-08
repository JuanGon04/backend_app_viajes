<?php


return [
    'paths' => ['api/*'],  // Rutas permitidas para CORS
    'allowed_methods' => ['*'], // Métodos HTTP permitidos
    'allowed_origins' => ['http://localhost:4200'], // Orígenes permitidos (frontend)
    'allowed_origins_patterns' => [], // Patrones de origen permitidos
    'allowed_headers' => ['*'], // Headers permitidos
    'exposed_headers' => [], // Headers expuestos
    'max_age' => 0, // Tiempo de caché de la respuesta (en segundos)
    'supports_credentials' => false, // Si se permiten credenciales
];
