CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    level ENUM('D�butant', 'Interm�diaire', 'Avanc�') NOT NULL
);