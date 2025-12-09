# GAJE DB - Complete CRUD System with Database JOINs

A modern PHP inventory management system featuring full CRUD operations for categories, products, customers, and orders with advanced database joins and beautiful UI design.

## 🎯 Features

- ✅ **Categories Management** - Create, read, update, and delete product categories
- ✅ **Products Management** - Full CRUD operations with category relationships  
- ✅ **Customers Management** - Store and manage customer information
- ✅ **Orders Management** - Create orders with multiple products and track inventory
- ✅ **Database JOINs** - Complex SQL queries with LEFT JOINs for related data
- ✅ **Modern UI** - Animated headers, responsive design, light gradient background
- ✅ **MySQLi Procedural** - Direct database connectivity without ORM

## 📁 Project Structure

```
gaje_db/
├── index.php                      # Main product listing page with animations
├── database.php                   # MySQLi database connection and utilities
├── style.css                      # Modern CSS styling with animations
├── letters.js                     # Letter-by-letter animation effects
│
├── categories/                    # Category CRUD operations
│   ├── create.php                # Add new category form
│   ├── list.php                  # View all categories
│   ├── delete.php                # Delete single category
│   └── delete-all.php            # Cascade delete all data
│
├── products/                      # Product CRUD operations
│   ├── create.php                # Add new product with category selection
│   ├── edit.php                  # Edit product details
│   └── delete.php                # Delete product
│
├── customers/                     # Customer management
│   └── create.php                # Add new customer
│
├── orders/                        # Order management
│   ├── create.php                # Create order with multiple products
│   ├── list.php                  # View all orders with customer names (JOIN)
│   └── view.php                  # View order details with item breakdown
│
└── SQL Files
    ├── gaje_db_schema.sql        # Database structure (CREATE TABLE statements)
    └── gaje_db_completed.sql     # Schema with sample data
```

## 🗄️ Database Schema

### Tables Structure

| Table | Columns |
|-------|---------|
| **categories** | categories_id (PK), name |
| **products** | id (PK), name, price, category_id (FK) |
| **customers** | id (PK), name, email, phone |
| **orders** | id (PK), customer_id (FK), created_at |
| **order_items** | id (PK), order_id (FK), product_id (FK), quantity, price |

## 🚀 Installation & Setup

### Prerequisites
- PHP 7.0 or higher
- MySQL 5.7 or higher
- XAMPP or similar local server

### Steps

1. **Clone Repository**
   ```bash
   git clone https://github.com/paulgaje222-eng/gaje_db.git
   cd gaje_db
   ```

2. **Create Database**
   ```bash
   mysql -u root -p < gaje_db_schema.sql
   ```
   Or import via phpMyAdmin using `gaje_db_schema.sql`

3. **Configure Connection** (if needed)
   Edit `database.php`:
   ```php
   $host = "localhost";
   $user = "root";
   $password = "";
   $database = "gaje_db";
   ```

4. **Start PHP Server**
   ```bash
   php -S localhost:8000
   ```

5. **Access Application**
   Open browser and go to: `http://localhost:8000`

## 🔄 Key SQL JOIN Queries

### Products with Category Names
```sql
SELECT p.id, p.name, p.price, c.name as category_name
FROM products p
LEFT JOIN categories c ON p.category_id = c.categories_id
```

### Orders with Customer Details
```sql
SELECT o.id, c.name as customer_name, COUNT(oi.id) as total_items
FROM orders o
LEFT JOIN customers c ON o.customer_id = c.id
LEFT JOIN order_items oi ON o.id = oi.order_id
GROUP BY o.id
```

### Order Items with Product Details
```sql
SELECT oi.id, p.name, oi.quantity, oi.price
FROM order_items oi
JOIN products p ON oi.product_id = p.id
WHERE oi.order_id = ?
```

## 🎨 Design Features

- **Light Gradient Background**: Smooth gradient from sky-blue (#0ea5e9) to light green (#f0fdf4)
- **Animated Typography**: Letter-by-letter bounce animation on page load
- **Card-based Layout**: Modern card design with shadows and hover effects
- **Color Scheme**: Sky blue primary color with violet accents
- **Responsive Design**: Fully responsive for desktop and mobile devices

## 📄 File Descriptions

### Core Application Files

| File | Purpose |
|------|---------|
| `database.php` | MySQLi connection setup with `e()` escape function |
| `index.php` | Home page with product listing and navigation menu |
| `style.css` | All styling, animations, and responsive design (140+ lines) |
| `letters.js` | JavaScript for animated text effects |

### Category Operations

| File | Purpose |
|------|---------|
| `categories/create.php` | Form to insert new categories into database |
| `categories/list.php` | Display all categories with delete options |
| `categories/delete.php` | Remove single category by ID |
| `categories/delete-all.php` | Confirmation page for cascading delete |

### Product Operations

| File | Purpose |
|------|---------|
| `products/create.php` | Form with category dropdown for new products |
| `products/edit.php` | Update product name, price, and category |
| `products/delete.php` | Remove product from system |

### Customer Operations

| File | Purpose |
|------|---------|
| `customers/create.php` | Simple form to add customer information |

### Order Operations

| File | Purpose |
|------|---------|
| `orders/create.php` | Multi-product order creation with quantities |
| `orders/list.php` | Table view of all orders with aggregated data via JOINs |
| `orders/view.php` | Detailed breakdown of single order with item prices |

## 🎯 Usage Examples

### Adding a New Category
1. Navigate to home page (`index.php`)
2. Click "Manage Categories" → "Add Category"
3. Enter category name and submit form
4. Category appears in products dropdown

### Adding a New Product
1. Go to "Manage Products" → "Add Product"
2. Fill in product name, price
3. Select category from dropdown (connects via foreign key)
4. Submit form - product is added with category relationship

### Creating an Order
1. Navigate to "Manage Orders" → "Create Order"
2. Select customer from dropdown
3. Select products and enter quantities
4. Submit form - creates order and order_items records
5. Order total calculated from quantity × price

### Viewing Order Details
1. Go to "View Orders"
2. Click on any order ID
3. See complete item breakdown with:
   - Product names (via JOIN)
   - Quantities ordered
   - Unit prices
   - Calculated subtotals

## 🛠️ Technology Stack

- **Backend**: PHP 7.0+ (Procedural Style)
- **Database**: MySQL 5.7+ with MySQLi
- **Frontend**: HTML5, CSS3, Vanilla JavaScript
- **Server**: PHP Built-in Server / Apache (XAMPP)
- **Version Control**: Git & GitHub

## 📊 SQL Features Demonstrated

- **LEFT JOIN**: Optional category relationships
- **INNER JOIN**: Order-product relationships  
- **GROUP BY**: Aggregating order items and calculations
- **SUM() & COUNT()**: Calculating totals and item counts
- **Foreign Keys**: Enforcing referential data relationships
- **AUTO_INCREMENT**: Primary key auto-generation
- **DISTINCT**: Removing duplicate results

## 🔒 Security & Code Quality

- ✅ HTML escaping with `e()` function
- ✅ Clean separation of concerns
- ✅ Modular folder structure by feature
- ✅ Consistent naming conventions
- ✅ Procedural MySQLi implementation

## 🚀 Future Enhancements

- [ ] Add prepared statements for SQL injection prevention
- [ ] Implement user authentication system
- [ ] Add search and filter functionality
- [ ] Create invoice PDF generation
- [ ] Add inventory stock management
- [ ] Implement order status tracking
- [ ] Add product images/gallery
- [ ] Create admin dashboard
- [ ] Add email notifications
- [ ] Implement pagination

## 📝 License

Open source - Feel free to use and modify for your projects

## 👤 Author

**Paul Gaje** (paulgaje222-eng)  
GitHub: https://github.com/paulgaje222-eng/gaje_db

---

**Status**: ✅ Production Ready  
**Last Updated**: December 2025  
**Version**: 1.0
