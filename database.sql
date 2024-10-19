CREATE TABLE projects (
    project_id INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    technologies VARCHAR(255),
    budget DECIMAL(10, 2),
    deadline DATE,
    client_id INT,
);

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    username VARCHAR(100) NOT NULL UNIQUE,
    phone_no VARCHAR(15),
    role ENUM('freelancer', 'client') NOT NULL
);

