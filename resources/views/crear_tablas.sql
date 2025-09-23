-- Tabla de Roles
CREATE TABLE Roles (
    IdRol INT PRIMARY KEY,
    NombreRol VARCHAR(50) NOT NULL UNIQUE
);

-- Tabla de Usuarios
CREATE TABLE Usuarios (
    IdUsuario INT PRIMARY KEY,
    NombreUsuario VARCHAR(50) NOT NULL UNIQUE,
    Contraseña VARCHAR(255) NOT NULL,
    IdRol INT,
    FechaCreacion DATETIME,
    FOREIGN KEY (IdRol) REFERENCES Roles(IdRol)
);

-- Tabla de Clientes
CREATE TABLE Clientes (
    IdCliente INT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Apellido VARCHAR(100) NOT NULL,
    Telefono VARCHAR(15),
    Correo VARCHAR(100) UNIQUE,
    Direccion VARCHAR(100)
);

-- Tabla de Direcciones de Clientes
CREATE TABLE Direcciones (
    IdDireccion INT PRIMARY KEY,
    IdCliente INT,
    Direccion VARCHAR(100) NOT NULL,
    Ciudad VARCHAR(50),
    CodigoPostal VARCHAR(10),
    FOREIGN KEY (IdCliente) REFERENCES Clientes(IdCliente)
);

-- Tabla de Categorías de Productos
CREATE TABLE Categorias (
    IdCategoria INT PRIMARY KEY,
    NombreCategoria VARCHAR(50) NOT NULL UNIQUE
);

-- Tabla de Productos
CREATE TABLE Productos (
    IdProducto INT PRIMARY KEY ,
    Nombre VARCHAR(100) NOT NULL,
    Descripcion VARCHAR(50),
    Precio INT NOT NULL,
    Stock INT NOT NULL,
    IdCategoria INT,
    FOREIGN KEY (IdCategoria) REFERENCES Categorias(IdCategoria)
);

-- Tabla de Pedidos
CREATE TABLE Pedidos (
    IdPedido INT PRIMARY KEY,
    IdCliente INT,
    FechaPedido DATETIME,
    Estado VARCHAR(50) DEFAULT 'Pendiente',
    Total INT NOT NULL,
    FOREIGN KEY (IdCliente) REFERENCES Clientes(IdCliente)
);

-- Tabla de Detalles de Pedido (productos comprados en un pedido)
CREATE TABLE DetallesPedido (
    IdDetallePedido INT PRIMARY KEY,
    IdPedido INT,
    IdProducto INT,
    Cantidad INT NOT NULL,
    PrecioUnitario INT NOT NULL,
    Subtotal INT NOT NULL,
    FOREIGN KEY (IdPedido) REFERENCES Pedidos(IdPedido),
    FOREIGN KEY (IdProducto) REFERENCES Productos(IdProducto)
);

-- Tabla de Carrito de Compras
CREATE TABLE Carrito (
    IdCarrito INT PRIMARY KEY,
    IdUsuario INT,
    FechaCreacion DATETIME,
    FOREIGN KEY (IdUsuario) REFERENCES Usuarios(IdUsuario)
);

-- Tabla de Detalles del Carrito
CREATE TABLE DetallesCarrito (
    IdDetalleCarrito INT PRIMARY KEY,
    IdCarrito INT,
    IdProducto INT,
    Cantidad INT NOT NULL,
    PrecioUnitario INT NOT NULL,
    Subtotal INT NOT NULL,
    FOREIGN KEY (IdCarrito) REFERENCES Carrito(IdCarrito),
    FOREIGN KEY (IdProducto) REFERENCES Productos(IdProducto)
);

-- Tabla de Pagos
CREATE TABLE Pagos (
    IdPago INT PRIMARY KEY,
    IdPedido INT,
    Monto INT NOT NULL,
    MetodoPago VARCHAR(50) NOT NULL,
    FechaPago DATETIME,
    FOREIGN KEY (IdPedido) REFERENCES Pedidos(IdPedido)
);

-- Tabla de Inventario
CREATE TABLE Inventario (
    IdInventario INT PRIMARY KEY ,
    NombreProducto VARCHAR(100) NOT NULL,
    Cantidad INT NOT NULL,
    FechaIngreso DATETIME,
    Categoria VARCHAR(50),
    PrecioUnitario INT
);

-- Tabla de Compras (para registrar compras de insumos o productos)
CREATE TABLE Compras (
    IdCompra INT PRIMARY KEY ,
    IdInventario INT,
    Cantidad INT NOT NULL,
    Total INT NOT NULL,
    FechaCompra DATETIME,
    FOREIGN KEY (IdInventario) REFERENCES Inventario(IdInventario)
);

-- Tabla de Ventas (para registrar ventas realizadas)
CREATE TABLE Ventas (
    IdVenta INT PRIMARY KEY,
    IdPedido INT,
    FechaVenta DATETIME,
    Total INT NOT NULL,
    FOREIGN KEY (IdPedido) REFERENCES Pedidos(IdPedido)
);

-- Agregar relación entre Inventario y Productos
ALTER TABLE Inventario ADD IdProducto INT;
ALTER TABLE Inventario ADD CONSTRAINT FK_Inventario_Producto FOREIGN KEY (IdProducto) REFERENCES Productos(IdProducto);

-- Agregar relación entre Clientes y Usuarios
ALTER TABLE Clientes ADD IdUsuario INT;
ALTER TABLE Clientes ADD CONSTRAINT FK_Clientes_Usuarios FOREIGN KEY (IdUsuario) REFERENCES Usuarios(IdUsuario);


