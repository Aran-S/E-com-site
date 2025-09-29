# My E-Commerce Website

This is a simple online shopping website made with PHP and MySQL. It has two types of users - sellers who can add products and customers who can buy them.

## What does it do?

- Sellers can add products with pictures and manage orders
- Customers can view products and place orders
- Both can see order history and status

## What you need

- XAMPP (free download from apachefriends.org)
- A computer with Windows/Mac/Linux
- A web browser like Chrome or Firefox

## How to set it up

1. **Download XAMPP and install it**

   - Just keep clicking next during installation

2. **Put the files in the right place**

   - Copy this whole E-com folder
   - Paste it in: `C:\xampp\htdocs\`
   - So it should be: `C:\xampp\htdocs\E-com\`

3. **Start XAMPP**

   - Open XAMPP Control Panel
   - Click "Start" next to Apache
   - Click "Start" next to MySQL
   - They should turn green

4. **Create the database**

   - Open your browser
   - Go to: http://localhost/phpmyadmin
   - Click "New" on the left side
   - Name it: `e_com`
   - Click "Create"

5. **Make the tables**
   You need to create these tables in your database:

   **users table:**

   ```
   - id (number, auto increment, primary key)
   - username (text)
   - email (text)
   - password (text)
   - level (number: 1 for seller, 2 for customer)
   ```

   **category table:**

   ```
   - id (number, auto increment, primary key)
   - category (text)
   - user_id (number)
   ```

   **products table:**

   ```
   - id (number, auto increment, primary key)
   - user_id (number)
   - category_id (number)
   - product_name (text)
   - price (decimal)
   - description (text)
   - image (text)
   - stock (number)
   - count (number)
   ```

   **orders table:**

   ```
   - id (number, auto increment, primary key)
   - user_id (number)
   - seller_id (number)
   - category_id (number)
   - product_id (number)
   - order_number (text)
   - amount (decimal)
   - ordered_on (datetime)
   - order_address (number)
   - warranty_years (number)
   - delivery_status (number)
   - order_placed (number)
   ```

   **cart table:**

   ```
   - id (number, auto increment, primary key)
   - user_id (number)
   - product_id (number)
   - count (number)
   - selected_on (datetime)
   - created_on (datetime)
   ```

6. **Create uploads folder**
   - Make a new folder called `uploads` inside E-com
   - Inside uploads, make another folder called `products`

## How to use it

1. **Open the website**

   - Go to: http://localhost/E-com

2. **For Sellers (level = 1):**

   - Add products using add-product.php
   - Check product names are unique
   - Upload product pictures
   - See all orders from customers
   - Update order status (pending → shipped → delivered)

3. **For Customers (level = 2):**
   - Browse products
   - Add to cart using add_to_cart.php
   - See order history
   - Track order status

## Files explained

- `add-product.php` - Where sellers add new products
- `add_to_cart.php` - Adds products to customer cart
- `orders.php` - Shows orders (different for sellers vs customers)
- `header.php` - Top part of every page (navigation, etc)
- `footer.php` - Bottom part of every page
- `check-availability.php` - Checks if product names already exist
- `uploads/products/` - Where product pictures are saved

## Common problems

**"Can't connect to database"**

- Make sure MySQL is started in XAMPP
- Check if database name is correct (should be 'e_com')

**"Page not found"**

- Make sure Apache is started in XAMPP
- Check the URL: http://localhost/E-com/

**"Can't upload images"**

- Make sure uploads/products folder exists
- Check folder permissions

**"Product name already exists"**

- The system checks for duplicate names automatically
- Try a different product name

## Things to remember

- Always start XAMPP before using the website
- Don't upload files bigger than 5MB
- Only use JPG, PNG, GIF, WEBP images
- Level 1 = Seller, Level 2 = Customer
- Keep XAMPP running while testing

## Need help?

- Check if XAMPP is running
- Look at the error messages
- Make sure all files are in the right folders
- Try refreshing the page

This is a basic version for learning. For a real website, you'd need more security and features!
