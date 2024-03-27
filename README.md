# Tienda de Juegos con React

Este proyecto es una tienda de juegos online desarrollada con React.

## Funcionalidades

### Página de Login/Registro
- Formulario de registro e inicio de sesión controlado con sus respectivas validaciones.

### Header
- Menú header con una opción de editar que muestra un formulario para editar el nombre del usuario.

### Página de Catálogo
- Muestra una lista de juegos con información como título, precio.
- Permite al usuario filtrar y ordenar los juegos.
- Opción para poder agregar un nuevo juego al catálogo.
- Sistema de filtro por compañía, precios, etc.

### Página de Detalles del Juego
- Muestra información detallada de un juego específico (título, descripción, compañía y el precio). Opcional: Agregar imágenes (no importa si es estático).
- Permite al usuario añadir el juego al carrito de compras.

### Página de Carrito de Compras
- Muestra una lista de los juegos seleccionados por el usuario.
- Permite al usuario modificar la cantidad de juegos o eliminarlos del carrito.

### Compañías
- Opción para poder agregar una nueva compañía a la BD.

## Indicaciones
- Los datos actualizados o nuevos deben de mostrarse en tiempo real sin necesidad de recargar la página.

## Dependencias
- Formik: Para manejar los formularios y sus validaciones.



# API de Laravel

## Autenticación
Todas las rutas están protegidas con el middleware 'auth:sanctum'. para acceder a ellas se tiene que usar el token
de autenticacion que se genera en el login y en todas las peticiones tiene que ir ese token en el encabezado la autenticacion es de tipo bearer Token


## Rutas de Compañías

- `GET /companies/all`: Obtiene todas las compañías.
- `GET /companies/{id}`: Obtiene la compañía con el ID especificado.
- `POST /companies/create`: Crea una nueva compañía. Debes enviar los datos de la compañía en el cuerpo de la solicitud.
- `POST /companies/update/{id}`: Actualiza la compañía con el ID especificado. Debes enviar los nuevos datos en el cuerpo de la solicitud.
- `POST /companies/delete/{id}`: Elimina la compañía con el ID especificado.

## Rutas de Juegos

- `GET /games/all`: Obtiene todos los juegos.
- `POST /games/search`: Busca un juego por nombre. Debes enviar el nombre en el cuerpo de la solicitud.
- `GET /games/{id}`: Obtiene el juego con el ID especificado.
- `POST /games/create`: Crea un nuevo juego. Debes enviar los datos del juego en el cuerpo de la solicitud.
- `POST /games/update/{id}`: Actualiza el juego con el ID especificado. Debes enviar los nuevos datos en el cuerpo de la solicitud.
- `POST /games/delete/{id}`: Elimina el juego con el ID especificado.

## Rutas de Juegos de Compañías

- `GET /company-games`: Obtiene todos los juegos de todas las compañías.
- `GET /company-games/{companyId}`: Obtiene todos los juegos de la compañía con el ID especificado.

## Rutas de Usuarios

- `PUT /users/edit/{id}`: Actualiza el usuario con el ID especificado. Debes enviar los nuevos datos en el cuerpo de la solicitud.

## Rutas de Autenticación

- `GET /logout`: Cierra la sesión del usuario actual.


### Ruta de Login

- `POST /auth/login`: Inicia la sesion .
    header: application/json
    parameters:
        email :string
        password :string
    success:
        HTTP: 200 OK
        user: data
        access_token: token
    Fail:
        HTTP: 401 Unauthorized
        message: Unauthorized
- `POST /auth/register`: Registro de usuarios .
    header: application/json
    parameters:
        name :string,required,max:255
        email :string,required,email,unique
        password :required,string,min:8
    success:
        HTTP: 200 OK
        user: data
    Fail:
        HTTP: 422 Unauthorized
        message: Unprocessable Entity
        uno de los parametros no se cumplio

