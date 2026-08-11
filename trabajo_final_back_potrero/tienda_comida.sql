```sql
CREATE DATABASE IF NOT EXISTS tienda_comida;

USE tienda_comida;

DROP TABLE IF EXISTS comidas;

CREATE TABLE comidas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    area VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    imagen VARCHAR(500) NOT NULL,
    descripcion TEXT
);


INSERT INTO comidas
(nombre, categoria, area, precio, imagen, descripcion)
VALUES
(
    'Chicken Curry',
    'Chicken',
    'Indian',
    8500,
    'https://www.themealdb.com/images/media/meals/wyxwsp1486979827.jpg',
    'Pollo preparado con una salsa de curry y especias.'
);


INSERT INTO comidas
(nombre, categoria, area, precio, imagen, descripcion)
VALUES
(
    'Beef Stroganoff',
    'Beef',
    'Russian',
    9200,
    'https://www.themealdb.com/images/media/meals/svprys1511176755.jpg',
    'Carne preparada al estilo stroganoff.'
);


INSERT INTO comidas
(nombre, categoria, area, precio, imagen, descripcion)
VALUES
(
    'Spaghetti Carbonara',
    'Pasta',
    'Italian',
    7800,
    'https://www.themealdb.com/images/media/meals/llcbn01574260722.jpg',
    'Pasta italiana preparada al estilo carbonara.'
);


INSERT INTO comidas
(nombre, categoria, area, precio, imagen, descripcion)
VALUES
(
    'Fish and Chips',
    'Seafood',
    'British',
    7200,
    'https://www.themealdb.com/images/media/meals/sywswr1511383814.jpg',
    'Pescado acompañado de papas fritas.'
);


INSERT INTO comidas
(nombre, categoria, area, precio, imagen, descripcion)
VALUES
(
    'Lasagne',
    'Pasta',
    'Italian',
    8900,
    'https://www.themealdb.com/images/media/meals/wtsvxx1511296896.jpg',
    'Lasagna tradicional con carne y salsa.'
);


INSERT INTO comidas
(nombre, categoria, area, precio, imagen, descripcion)
VALUES
(
    'Tacos',
    'Miscellaneous',
    'Mexican',
    6500,
    'https://www.themealdb.com/images/media/meals/uvuyxu1503067369.jpg',
    'Tacos preparados al estilo mexicano.'
);
```
