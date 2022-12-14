package com.bancarapida.databaseConnection;

import com.bancarapida.dao.RoleDaoImplemantation;
import com.bancarapida.dao.UserCredentialsDaoImplementation;
import com.bancarapida.model.Role;
import com.bancarapida.model.UserCredentials;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

@RestController
@RequestMapping("/test")
public class DatabaseConnection {
    private static Connection con = null;

    static
    {
        String url = "jdbc:mysql:// localhost:3306/bancarapida";
        String user = "root";
        String pass = "";
        try {
            Class.forName("com.mysql.jdbc.Driver");
            con = DriverManager.getConnection(url, user, pass);
        }
        catch (ClassNotFoundException | SQLException e) {
            e.printStackTrace();
        }
    }
    public static Connection getConnection()
    {
        return con;
    }
    @GetMapping("/test")
    public List<Role> test() throws SQLException {
        RoleDaoImplemantation roleDao = new RoleDaoImplemantation();
        // read All
        List<Role> ls = roleDao.getRoles();
        // System.out.println(ls);
        List<Role> jsonRoles = new ArrayList();
        for (Role allEmp : ls) {
            jsonRoles.add(allEmp);
            System.out.println(allEmp);
        }
        return jsonRoles;
    }

    @GetMapping("/testusercredentials")
    public List<UserCredentials> testusercredentials() throws SQLException {
        UserCredentialsDaoImplementation objDao = new UserCredentialsDaoImplementation();
        UserCredentials obj = new UserCredentials("juan@test.com","incorrecta", 3);
        // Add
        // objDao.add(obj);
        // read All
        List<UserCredentials> ls = objDao.getUserCredentials();
        // System.out.println(ls);
        List<UserCredentials> jsonRoles = new ArrayList();
        for (UserCredentials allEmp : ls) {
            jsonRoles.add(allEmp);
            System.out.println(allEmp);
        }
        return jsonRoles;
    }
    @GetMapping("/hello")
    public String greeting(){
        return "this is a test 🚀";
    }
}