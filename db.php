<?php
// db.php - Database Connection using SQLite
$dbFile = __DIR__ . '/portfolios.sqlite';
try {
    $pdo = new PDO("sqlite:$dbFile");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->exec("CREATE TABLE IF NOT EXISTS portfolios (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        full_name TEXT NOT NULL,
        email TEXT NOT NULL,
        contact_number TEXT NOT NULL,
        address TEXT NOT NULL,
        about_me TEXT NOT NULL,
        profile_picture TEXT,
        template TEXT DEFAULT 'simple',
        skills TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
} catch (PDOException $e) {
    die("Database Connection Error: " . $e->getMessage());
}