# 🏢 Sistema de Registro de Visitas Empresariales

Este proyecto es una aplicación web desarrollada en PHP y MySQL que permite gestionar y registrar visitas a una empresa. Ideal para recepciones, oficinas administrativas o empresas que desean mantener un control básico y efectivo de las personas que ingresan a sus instalaciones.

## 🚀 Características

- Registro de visitas con nombre, empresa y motivo.
- Validación básica de campos vacíos.
- Almacenamiento de los registros en una base de datos MySQL.
- Visualización de las visitas registradas en tiempo real.
- Diseño sencillo y adaptable a múltiples dispositivos.


## 🛠️ Tecnologías Utilizadas

- PHP (7.x o 8.x)
- MySQL
- HTML5
- CSS3

## 📂 Estructura del Proyecto

visitas_empresa/
├── conexion.php
├── guardar_visita.php
├── index.php
├── editar_visita
├── eliminar_visita
├── visitas

## 🧰 Requisitos

- Servidor local como XAMPP, WAMP o similar.
- Navegador web moderno.
- Base de datos MySQL.

## 🗃️ Instalación y Uso

1. Clona o descarga este repositorio.
2. Copia la carpeta `visitas_empresa` en el directorio `htdocs` (XAMPP) o `www` (WAMP).
3. Crea una base de datos llamada `visitas_db` y ejecuta la siguiente consulta SQL:

```sql
CREATE TABLE visitas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    empresa VARCHAR(100),
    motivo TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
