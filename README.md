# 📚 Librería Ecommerce – Laravel

Proyecto web desarrollado en Laravel para la venta de libros en línea. Incluye autenticación, roles, carrito de compras, gestión de pedidos y panel administrativo.

---

## 🚀 Características principales

- Catálogo de libros con imágenes, precios y detalles
- Carrito de compras funcional
- Flujo completo de pedidos con validación de stock
- Autenticación de usuarios (login, registro)
- Roles: `admin` y `client`
- Panel de administración para gestionar libros y categorías
- Historial de pedidos para clientes
- Envío de correos automáticos (pedido confirmado, notificación al admin)
- Diseño responsive con Blade + Bootstrap

---

## 🧱 Estructura de la base de datos

### Tablas principales

| Tabla        | Descripción                          |
|--------------|--------------------------------------|
| `books`      | Libros disponibles en el catálogo    |
| `categories` | Categorías de libros                 |
| `users`      | Usuarios registrados con roles       |
| `orders`     | Pedidos realizados                   |
| `order_items`| Detalles de cada pedido              |
| `contacts`   | Mensajes enviados desde el formulario|

---

## 🔐 Roles y acceso

- **Admin**: puede gestionar libros, categorías y ver todos los pedidos.
- **Client**: puede navegar el catálogo, comprar libros y ver su historial.
- admin@library.com
- admin1234

---

## 🛒 Flujo de compra

1. Cliente agrega libros al carrito
2. Revisa su selección y finaliza el pedido
3. Se valida el stock y se genera el pedido
4. Se envía correo de confirmación
5. El admin recibe notificación del nuevo pedido

---

## ⚙️ Instalación

```bash
git clone https://github.com/tu_usuario/libreria_ecommerce.git
cd libreria_ecommerce
composer install
npm install
php artisan migrate:refresh --seed

