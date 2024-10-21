-- schema.sql

CREATE DATABASE IF NOT EXISTS water_quality_db;
USE water_quality_db;

CREATE TABLE IF NOT EXISTS water_quality (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sensor_id VARCHAR(50) NOT NULL,
    pH DECIMAL(4, 2) NOT NULL,
    turbidity DECIMAL(5, 2) NOT NULL,
    residual_chlorine DECIMAL(5, 2) NOT NULL,
    conductivity DECIMAL(8, 2) NOT NULL,
    temperature DECIMAL(5, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
