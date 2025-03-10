# Backend App Viajes

![Laravel](https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg)

## Descripción
Este proyecto está diseñado para facilitar la planificación de viajes, permitiendo a el usuario obtener información actualizada sobre el clima en su destino y calcular el presupuesto en la moneda local. La aplicación es accesible desde computadoras personales, tablets y teléfonos inteligentes, ofreciendo una experiencia fluida y adaptable. Además, soporta múltiples idiomas, incluyendo español e inglés, para mejorar la accesibilidad y usabilidad global.

Este proyecto es una API RESTful desarrollada en **Laravel 12** proporcionando funcionalidades como:
- Obtención de datos climáticos.
- Conversión de moneda.

## Pantallas de la Aplicación

### Pantalla 1

-   **Funcionalidad**: Permite seleccionar la ciudad destino e ingresar el presupuesto de viaje en la moneda local (COP).
-   **Campos Obligatorios**:
    -   Selección de la ciudad: Londres, New York, Paris, Tokyo, Madrid
    -   Presupuesto: Debe ingresar el presupuesto de viaje.

### Pantalla 2

-   **Funcionalidad**: Muestra el clima del día en la ciudad destino, la moneda local y el símbolo, el presupuesto convertido a la moneda local y la tasa de cambio aplicada.

-   **Datos Mostrados**:
    -   Ciudad y país destino.
    -   El clima que se presenta en el momento.
    -   Temperatura en grados centígrados.
    -   Temperatura maxima y minima en grados centígrados.
    -   Sensación térmica en grados centigrados.
    -   Porcentaje de humedad.
    -   Velocidad del viento.
    -   Nombre y símbolo de la moneda local.
    -   Presupuesto en peso colombiano.
    -   Presupuesto convertido con el símbolo de la moneda correspondiente.
    -   Tasa de cambio aplicada.

## Instalación

### Requisitos previos
- PHP 8.2+
- Composer
- MySQL/MariaDB
- Redis (opcional, para mejorar el rendimiento)

### Pasos de instalación

1. Clonar el repositorio:
   ```sh
   git clone https://github.com/JuanGon04/backend_app_viajes.git
   cd backend_app_viajes
   ```

2. Instalar dependencias:
   ```sh
   composer install
   ```

3. Copiar el archivo de entorno y configurarlo:
   ```sh
   cp .env.example .env
   ```

4. Configurar la base de datos en `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nombre_base_datos
   DB_USERNAME=usuario
   DB_PASSWORD=contraseña
   ```

5. Ejecutar migraciones y seeders:
   ```sh
   php artisan migrate --seed
   ```

6. Iniciar el servidor:
   ```sh
   php artisan serve
   ```


## Configuración del Entorno de Desarrollo
### 1. Instalación de Herramientas
- **Laravel 12**: Seguir las instrucciones de instalación según la documentación oficial.
- **PHP 8.2**: Instalar según la documentación oficial de PHP.
- **MySQL**: Configurar como gestor de base de datos relacional.

### 2. Configuración de Laravel
- **Base de Datos**: Definir los detalles de conexión en el archivo `.env`.
- **Modelos**: Implementar modelos Eloquent para gestionar la base de datos.
- **Controladores**: Encargados de la lógica de negocio y respuesta a solicitudes HTTP.
  - **WeatherController**: Obtiene datos climáticos desde OpenWeatherMap según la ciudad seleccionada. Antes de hacer la solicitud a la API, consulta la base de datos para obtener la latitud y longitud de la ciudad.
  - **CurrencyExchangeController**: Convierte montos de una moneda a otra según la ciudad seleccionada. Antes de hacer la solicitud a la API de conversión de moneda, consulta la base de datos para obtener el código de la moneda correspondiente.
  - **HistorialController**: Almacena y recupera el historial de consultas de clima y conversión de moneda.
  - **CiudadesController**: Gestiona la lista de ciudades almacenadas en la base de datos.

### 3. Rutas en Laravel
- Se definen rutas en `routes/api.php` para manejar peticiones relacionadas con clima, conversión de moneda e historial de consultas.
- Se incluyen endpoints para obtener y almacenar datos de manera eficiente.


## Rutas Principales

| Método | Ruta | Descripción |
|--------|------|-------------|
| GET | /api/clima | Obtiene datos del clima para una ciudad específica mediante la API |
| GET | /api/conversion-moneda | Realiza conversión de moneda mediante la API |
| POST | /api/historial | Guarda un el registro en el historial |
| GET | /api/historial | Obtiene el historial de viajes |

# Servicios

## ApiWeather

### Descripción
El servicio `ApiWeather` se encarga de obtener datos meteorológicos de una ciudad determinada. Para ello, el controlador consulta la base de datos para obtener la latitud y longitud de la ciudad antes de realizar la solicitud a la API de OpenWeatherMap.

### Uso
El servicio se invoca proporcionando la latitud y longitud de una ciudad en especifico y devuelve la información climática correspondiente.

### Entrada
- `lat (int), log(int)`: Identificador de la ciudad en la base de datos.

### Ejemplo de Respuesta
```json
                          
{
   "coord": {
      "lon": 7.367,
      "lat": 45.133
   },
   "weather": [
      {
         "id": 501,
         "main": "Rain",
         "description": "moderate rain",
         "icon": "10d"
      }
   ],
   "base": "stations",
   "main": {
      "temp": 284.2,
      "feels_like": 282.93,
      "temp_min": 283.06,
      "temp_max": 286.82,
      "pressure": 1021,
      "humidity": 60,
      "sea_level": 1021,
      "grnd_level": 910
   },
   "visibility": 10000,
   "wind": {
      "speed": 4.09,
      "deg": 121,
      "gust": 3.47
   },
   "rain": {
      "1h": 2.73
   },
   "clouds": {
      "all": 83
   },
   "dt": 1726660758,
   "sys": {
      "type": 1,
      "id": 6736,
      "country": "IT",
      "sunrise": 1726636384,
      "sunset": 1726680975
   },
   "timezone": 7200,
   "id": 3165523,
   "name": "Province of Turin",
   "cod": 200
}                    
                        
```

## ApiCurrencyExchange

### Descripción
El servicio `ApiCurrencyExchange` permite convertir montos de una moneda a otra según la ciudad seleccionada. Antes de hacer la solicitud a la API de conversión de moneda, el controlador consulta la base de datos para obtener el código de la moneda correspondiente a la ciudad.

### Uso
El servicio recibe el codigo de la divisa y el monto en la moneda de origen y devuelve el monto convertido a la moneda de destino.

### Entrada
- `codigo_divisa (string)`: Identificador de la moneda destino.
- `amount (float)`: Monto en la moneda de origen.


### Ejemplo de Respuesta
```json
{
  "date": "2021-03-15",
  "info": {
    "rate": 0.837805,
    "timestamp": 1615786266
  },
  "query": {
    "amount": 750,
    "from": "USD",
    "to": "EUR"
  },
  "result": 628.35375,
  "success": true
}

```

## Estructura de la Tabla de la base de datos MySql

### Tabla Ciudades
```sql
CREATE TABLE `ciudades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `codigo_divisa` varchar(3) NOT NULL,
  `simbolo_moneda` varchar(255) DEFAULT NULL,
  `latitud` decimal(10,7) DEFAULT NULL,
  `longitud` decimal(10,7) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) 

```

### Tabla Historial

```sql
CREATE TABLE `historial` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ciudad_id` bigint(20) UNSIGNED NOT NULL,
  `temperatura` decimal(10,2) NOT NULL,
  `condicion_meteorologica` varchar(255) NOT NULL,
  `temperatura_minima` decimal(10,2) NOT NULL,
  `temperatura_maxima` decimal(10,2) NOT NULL,
  `sensacion_termica` decimal(10,2) NOT NULL,
  `presupuesto_moneda_local` decimal(20,2) NOT NULL,
  `presupuesto_moneda_extranjera` decimal(20,2) NOT NULL,
  `tasa_cambio` decimal(20,3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `simbolo_moneda` varchar(255) DEFAULT NULL,
  `tipo_clima` varchar(255) DEFAULT NULL
) 

```

## Middleware

- **throttle:60,1** → Limita las solicitudes para evitar abuso.
- **cors** → Habilita CORS para permitir peticiones desde otros dominios.

## Variables de Entorno Adicionales

```env
OPENWEATHER_API_KEY=tu_api_key
EXCHANGE_API_KEY=tu_api_key
```



