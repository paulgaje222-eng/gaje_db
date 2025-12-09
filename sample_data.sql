-- Insert sample data
INSERT INTO categories (name) VALUES ('Electronics'), ('Books'), ('Clothing');
INSERT INTO products (name, price, category_id) VALUES 
('Laptop', 899.99, 1),
('Headphones', 49.99, 1),
('Novel', 14.99, 2),
('T-Shirt', 29.99, 3);
INSERT INTO customers (name, email, phone) VALUES 
('John Doe', 'john@example.com', '1234567890'),
('Jane Smith', 'jane@example.com', '0987654321');
