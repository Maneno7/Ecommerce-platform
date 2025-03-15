<?php
    include "..\config\database_connect.php";

    function insert_data_to_tables($connect, $table_name, $table_sql_statements)
    {
        if ($connect->query($table_sql_statements) === TRUE) {
            echo "Table $table_name created successfully";
        } else {
            echo "Error creating table $table_name: " . $connect->error;
        }
    }

    $insert_sql_statements = [
        "categories" => "INSERT INTO categories (name) VALUES
        ('Test'),
    ('T-Shirts'),
    ('Jeans'),
    ('Jackets'),
    ('Shoes'),
    ('Dresses'),
    ('Sweaters'),
    ('Hats'),
    ('Accessories'),
    ('Sportswear'),
    ('Formal Wear')",

        "products" => "INSERT INTO products (name, description, price, in_stock, image_url, category_id, rating) VALUES
    ('Test Product', 'Test Description.', 30.00, 20, 'images/tshirt1.svg', 1, 7)"
    ];

    // Loop through the tables queries in the array
    foreach ($insert_sql_statements as $table_name => $table_sql_statements) {
        insert_data_to_tables($connect, $table_name, $table_sql_statements);
    }

    $connect->close();
?>