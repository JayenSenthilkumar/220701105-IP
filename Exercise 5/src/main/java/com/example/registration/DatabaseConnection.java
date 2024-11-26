package com.example.registration; // Ensure this is correct

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

// This class can be used to initialize the database connection
public class DatabaseConnection {

    // Method to initialize and return a database connection
    protected static Connection initializeDatabase() 
            throws SQLException, ClassNotFoundException 
    {
        // Initialize all the information regarding the Database Connection 
        String dbDriver = "mysql-connector-j-9.1.0.jar";
        String dbURL = "jdbc:mysql://localhost:3306/"; // Ensure this is correct
        String dbName = "librarydb"; // Ensure this matches your created database name
        String dbUsername = "root"; // Your database username
        String dbPassword = ""; // Your database password

        // Load the driver
        Class.forName(dbDriver); 
        // Create a connection to the database
        Connection con = DriverManager.getConnection(dbURL + dbName, dbUsername, dbPassword); 
        return con; 
    }
}
