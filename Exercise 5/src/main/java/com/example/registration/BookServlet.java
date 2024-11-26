package com.example.registration;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/BookServlet")
public class BookServlet extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response) 
            throws ServletException, IOException {
        // Display the book registration form
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();
        out.println("<html><body>");
        out.println("<h2>Book Registration Form</h2>");
        out.println("<form action='BookServlet' method='post'>");
        out.println("Title: <input type='text' name='title' required><br>");
        out.println("Author: <input type='text' name='author' required><br>");
        out.println("Publisher: <input type='text' name='publisher' required><br>");
        out.println("Edition: <input type='text' name='edition' required><br>");
        out.println("Price: <input type='number' name='price' step='0.01' required><br>");
        out.println("Category: <input type='text' name='category' required><br>");
        out.println("<input type='submit' value='Add Book'>");
        out.println("</form>");
        out.println("</body></html>");
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response) 
            throws ServletException, IOException {
        
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();

        String title = request.getParameter("title");
        String author = request.getParameter("author");
        String publisher = request.getParameter("publisher");
        String edition = request.getParameter("edition");
        String price = request.getParameter("price");
        String category = request.getParameter("category");

        // Output the received book details
        out.println("<html><body>");
        out.println("<h2>Book Registration Details</h2>");
        out.println("<p><strong>Title:</strong> " + title + "</p>");
        out.println("<p><strong>Author:</strong> " + author + "</p>");
        out.println("<p><strong>Publisher:</strong> " + publisher + "</p>");
        out.println("<p><strong>Edition:</strong> " + edition + "</p>");
        out.println("<p><strong>Price:</strong> " + price + "</p>");
        out.println("<p><strong>Category:</strong> " + category + "</p>");

        // Database insertion
        try (Connection con = DatabaseConnection.initializeDatabase()) {
            PreparedStatement stmt = con.prepareStatement(
                "INSERT INTO BOOK (TITLE, AUTHOR, PUBLISHER, EDITION, PRICE, CATEGORY) VALUES (?, ?, ?, ?, ?, ?)"
            );
            stmt.setString(1, title);
            stmt.setString(2, author);
            stmt.setString(3, publisher);
            stmt.setString(4, edition);
            stmt.setString(5, price);
            stmt.setString(6, category);

            int rowsInserted = stmt.executeUpdate();
            if (rowsInserted > 0) {
                out.println("<p>Book successfully added to the database!</p>");
            } else {
                out.println("<p>Failed to add the book.</p>");
            }
        } catch (SQLException | ClassNotFoundException e) {
            out.println("<p>Error: " + e.getMessage() + "</p>");
            e.printStackTrace(out); // Print stack trace for debugging
        }
        
        out.println("</body></html>");
    }
}
