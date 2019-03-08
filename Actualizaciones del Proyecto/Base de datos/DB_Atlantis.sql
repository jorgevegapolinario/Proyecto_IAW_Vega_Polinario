DROP TABLE IF EXISTS 'Usuario';
CREATE TABLE Usuario(
  'Genero' varchar(20) NOT NULL,
  'Nombre' varchar(50) NOT NULL,
  'Apellidos' varchar(100) NOT NULL,
  'Correo' varchar(100) NOT NULL,
  'Pass' varchar(30) NOT NULL,
  'Tipo' varchar(30) NOT NULL,
  'Telefono' number(9) NOT NULL,
  'Edad' number(5) NOT NULL,
  'Id_Usuario' int(10) unsigned NOT NULL AUTO_INCREMENT, PRIMARY KEY ("Id_Usuario");
  
  DROP TABLE IF EXISTS 'Tareas';
  CREATE TABLE Tareas(
  'Titulo' varchar(30) NOT NULL,
  'Descripcion' varchar(1000) NOT NULL,
  'Cod_Leyenda' CONSTRAINT 'Cod_Leyenda' FOREIGN KEY ('Cod_Leyenda') REFERENCES 'Leyendas' ("Cod_Leyenda"),
  'Caducidad' date,
  'Id_Usuario' CONSTRAINT 'Id_Usuario' FOREIGN KEY ('Id_Usuario') REFERENCES 'Usuario' ("Id_Usuario"),
  'Cod_Tarea' int(10) unsigned NOT NULL AUTO_INCREMENT, PRIMARY KEY ("Cod_Tarea");
  
  DROP TABLE IF EXISTS 'Leyendas';
  CREATE TABLE Leyendas(
  'Color' varchar(20) NOT NULL,
  'Marcador' longblob NOT NULL, /* Preguntar tipo para imágenes bien*/
  'Descripcion' varchar(1000) NOT NULL,
  'Fecha_Caducidad' date,
  'Id_Usuario' CONSTRAINT 'Id_Usuario' FOREIGN KEY ('Id_Usuario') REFERENCES 'Usuario' ("Id_Usuario"),
  'Cod_Leyenda' int(10) unsigned NOT NULL AUTO_INCREMENT, PRIMARY KEY ("Cod_Leyenda");
  
  DROP TABLE IF EXISTS 'Accesos_rapidos';
  CREATE TABLE Accesos_rapidos(
  'Nombre' varchar(30) NOT NULL,
  'Link' varchar(200) NOT NULL,
  'Icono' longblob NOT NULL,
  'Id_Usuario' CONSTRAINT 'Id_Usuario' FOREIGN KEY ('Id_Usuario') REFERENCES 'Usuario' ("Id_Usuario"),
  'Id_Acceso' int(10) unsigned NOT NULL AUTO_INCREMENT, PRIMARY KEY ("Id_Acceso");
  
  DROP TABLE IF EXISTS 'Passwords';
  CREATE TABLE Passwords(
  'Nombre' varchar(30) NOT NULL,
  'Pass' varchar(64) NOT NULL,
  'Id_Usuario' CONSTRAINT 'Id_Usuario' FOREIGN KEY ('Id_Usuario') REFERENCES 'Usuario' ("Id_Usuario"), /* Preguntar bien foreign keys */
  'Id_Pass' int(10) unsigned NOT NULL AUTO_INCREMENT, PRIMARY KEY ("Id_Acceso");