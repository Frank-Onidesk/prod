CREATE DATABASE IF NOT EXISTS auto_garage;
use garage_auto;

CREATE TABLE IF NOT EXISTS workers (
 id_worker INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20),
    hourly_rate DECIMAL(10,2) DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS garages  (
    id_garage INT AUTO_INCREMENT PRIMARY KEY,
    garage_name VARCHAR(100) NOT NULL,
    address TEXT,
    phone VARCHAR(20),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS  auto_parts (
    id_part INT AUTO_INCREMENT PRIMARY KEY,
    part_name VARCHAR(100) NOT NULL,
    part_number VARCHAR(50),
    description TEXT,
    unit_cost DECIMAL(10,2) DEFAULT 0,
    selling_price DECIMAL(10,2) DEFAULT 0,
    quantity_in_stock INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS  invoices  (
  id_invoice INT AUTO_INCREMENT PRIMARY KEY,
    invoice_number VARCHAR(50) UNIQUE NOT NULL,
    customer_name VARCHAR(100) NOT NULL,
    customer_phone VARCHAR(20),
    customer_email VARCHAR(100),
    vehicle_info TEXT,
    license_plate VARCHAR(20),
    total_amount DECIMAL(12,2) DEFAULT 0,
    labor_cost DECIMAL(10,2) DEFAULT 0,
    parts_cost DECIMAL(10,2) DEFAULT 0,
    tax_amount DECIMAL(10,2) DEFAULT 0,
    invoice_date DATE,
    due_date DATE,
    status ENUM('draft', 'sent', 'paid', 'overdue') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



 CREATE TABLE IF NOT EXISTS  Ors (
    id_ors INT AUTO_INCREMENT PRIMARY KEY,
    work_status ENUM('assigned', 'in_progress', 'on_hold', 'completed', 'cancelled') DEFAULT 'assigned',
    id_worker INT NOT NULL,
    id_garage INT NOT NULL,
    id_invoice INT,
    start_datetime DATETIME NOT NULL,
    end_datetime DATETIME NULL,
    total_time INT DEFAULT 0, -- in minutes
    work_description TEXT,
    estimated_hours DECIMAL(5,2) DEFAULT 0,
    actual_hours DECIMAL(5,2) DEFAULT 0,
    labor_rate DECIMAL(10,2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (id_worker) REFERENCES workers(id_worker),
    FOREIGN KEY (id_garage) REFERENCES garages(id_garage),
    FOREIGN KEY (id_invoice) REFERENCES invoices(id_invoice),
    
    INDEX idx_worker (id_worker),
    INDEX idx_garage (id_garage),
    INDEX idx_invoice (id_invoice),
    INDEX idx_status (work_status),
    INDEX idx_dates (start_datetime, end_datetime)
);



INSERT INTO worker (id_worker, name, email, phone, hourly_rate, is_active) VALUES 
(1, 'João Mecânico', 'joao@oficina.com', '555-0101', 45.00, 1),
(2 , 'Miguel Técnico', 'miguel@oficina.com', '555-0102', 50.00, 1),
(3 'Sara Engenheira', 'sara@oficina.com', '555-0103', 55.00 , 1);

INSERT INTO garages (id_garage, garage_name, address, phone) VALUES 
(1, 'Oficina Principal', 'Rua do Automóvel 123, Cidade', '555-1000'),
(2, 'Filial Centro', 'Avenida Principal 456, Centro', '555-1001');


INSERT INTO pecas_auto (id_part, part_name, part_number, selling_price, quantity_in_stock) VALUES 
(1,'Filtro de Óleo', 'FO-12345', 12.50, 50),
(2,'Pastilhas de Travão', 'PT-67890', 45.00, 25),
(3,'Vela de Ignição', 'VI-11121', 8.75, 100),
(4, 'Filtro de Ar', 'FA-31415', 18.00, 40);