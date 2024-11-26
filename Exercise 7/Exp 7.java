
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/StudentDetailsServlet")
public class StudentDetailsServlet extends HttpServlet {
    private static final long serialVersionUID = 1L;

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String regNo = request.getParameter("regNo");
        response.setContentType("application/json");
        PrintWriter out = response.getWriter();
        
        String jdbcURL = "jdbc:mysql://localhost:3306/school"; // Change database URL if necessary
        String dbUser = "root"; // Replace with your MySQL username
        String dbPassword = "root"; // Replace with your MySQL password

        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            Connection connection = DriverManager.getConnection(jdbcURL, dbUser, dbPassword);
            String sql = "SELECT * FROM students WHERE reg_no = ?";
            PreparedStatement statement = connection.prepareStatement(sql);
            statement.setString(1, regNo);
            ResultSet resultSet = statement.executeQuery();

            if (resultSet.next()) {
                String name = resultSet.getString("name");
                int age = resultSet.getInt("age");
                String course = resultSet.getString("course");

                out.print("{");
                out.print("\"reg_no\":\"" + regNo + "\",");
                out.print("\"name\":\"" + name + "\",");
                out.print("\"age\":" + age + ",");
                out.print("\"course\":\"" + course + "\"");
                out.print("}");
            } else {
                out.print("{}"); // No student found
            }

            resultSet.close();
            statement.close();
            connection.close();
        } catch (Exception e) {
            e.printStackTrace();
            out.print("{\"error\":\"" + e.getMessage() + "\"}");
        }
    }
}
