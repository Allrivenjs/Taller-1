package com.bancarapida.dao;

import com.bancarapida.databaseConnection.DatabaseConnection;
import com.bancarapida.model.User;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

public class UserDaoImplementation implements UserDao{
    static Connection con
            = DatabaseConnection.getConnection();

    @Override
    public int add(User obj)
            throws SQLException
    {
        String query = "insert into user( identityNumber, identityType, name, lastname, address, phone, email, gender, dob, idUserCredentials) VALUES (?,?,?,?,?,?,?,?,?,?)";
        PreparedStatement ps = con.prepareStatement(query);
        ps.setString(1, obj.getIdentityNumber());
        ps.setString(2, obj.getIdentityType());
        ps.setString(3, obj.getName());
        ps.setString(4, obj.getLastname());
        ps.setString(5, obj.getAddress());
        ps.setString(6, obj.getPhone());
        ps.setString(7, obj.getEmail());
        ps.setString(8, obj.getGender());
        ps.setString(9, obj.getDob());
        ps.setInt(10, obj.getIdUserCredentials());
        int n = ps.executeUpdate();
        return n;
    }

    @Override
    public void delete(int id)
            throws SQLException
    {
        String query
                = "delete from user where id =?";
        PreparedStatement ps
                = con.prepareStatement(query);
        ps.setInt(1, id);
        ps.executeUpdate();
    }

    @Override
    public User getUser(int id)
            throws SQLException
    {

        String query
                = "select * from user where id= ?";
        PreparedStatement ps
                = con.prepareStatement(query);

        ps.setInt(1, id);
        User obj = new User();
        ResultSet rs = ps.executeQuery();
        boolean check = false;

        while (rs.next()) {
            check = true;
            obj.setId(rs.getInt("id"));
            obj.setIdentityNumber(rs.getString("identityNumber"));
            obj.setIdentityType(rs.getString("identityType"));
            obj.setName(rs.getString("name"));
            obj.setLastname(rs.getString("lastname"));
            obj.setAddress(rs.getString("address"));
            obj.setPhone(rs.getString("phone"));
            obj.setEmail(rs.getString("email"));
            obj.setGender(rs.getString("gender"));
            obj.setDob(rs.getString("dob"));
            obj.setIdUserCredentials(rs.getInt("idUserCredentials"));
            obj.setCreationDate(rs.getDate("creationDate"));
        }

        if (check == true) {
            return obj;
        }
        else
            return null;
    }

    @Override
    public List<User> getUsers()
            throws SQLException
    {
        String query = "select * from user";
        PreparedStatement ps
                = con.prepareStatement(query);
        ResultSet rs = ps.executeQuery();
        List<User> ls = new ArrayList();

        while (rs.next()) {
            User obj = new User();
            obj.setId(rs.getInt("id"));
            obj.setIdentityNumber(rs.getString("identityNumber"));
            obj.setIdentityType(rs.getString("identityType"));
            obj.setName(rs.getString("name"));
            obj.setLastname(rs.getString("lastname"));
            obj.setAddress(rs.getString("address"));
            obj.setPhone(rs.getString("phone"));
            obj.setEmail(rs.getString("email"));
            obj.setGender(rs.getString("gender"));
            obj.setDob(rs.getString("dob"));
            obj.setIdUserCredentials(rs.getInt("idUserCredentials"));
            obj.setCreationDate(rs.getDate("creationDate"));
            ls.add(obj);
        }
        return ls;
    }

    @Override
    public void update(User obj)
            throws SQLException
    {
        String query
                = "update user set identityNumber = ?, "
                + " identityType = ?"
                + " name = ?"
                + " lastname = ?"
                + " address = ?"
                + " phone = ?"
                + " email = ?"
                + " gender = ?"
                + " dob = ?"
                + " idUserCredentials = ?"
                + " crationDate = ? where id = ?";
        PreparedStatement ps
                = con.prepareStatement(query);
        ps.setString(1, obj.getIdentityNumber());
        ps.setString(2, obj.getIdentityType());
        ps.setString(3, obj.getName());
        ps.setString(4, obj.getLastname());
        ps.setString(5, obj.getAddress());
        ps.setString(6, obj.getPhone());
        ps.setString(7, obj.getEmail());
        ps.setString(8, obj.getGender());
        ps.setString(9, obj.getDob());
        ps.setInt(10, obj.getIdUserCredentials());
        ps.setInt(11, obj.getId());
        ps.executeUpdate();
    }
}