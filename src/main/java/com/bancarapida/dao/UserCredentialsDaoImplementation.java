package com.bancarapida.dao;

import com.bancarapida.databaseConnection.DatabaseConnection;
import com.bancarapida.model.UserCredentials;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
public class UserCredentialsDaoImplementation implements UserCredentialsDao{
    static Connection con
            = DatabaseConnection.getConnection();

    @Override
    public int add(UserCredentials obj)
            throws SQLException
    {
        String query = "insert into usercredentials( user, password, idRole) VALUES (?,?,?)";
        PreparedStatement ps = con.prepareStatement(query);
        ps.setString(1, obj.getUser());
        ps.setString(2, obj.getPassword());
        ps.setInt(3, obj.getIdRole());
        int n = ps.executeUpdate();
        return n;
    }

    @Override
    public void delete(int id)
            throws SQLException
    {
        String query
                = "delete from usercredendials where id =?";
        PreparedStatement ps
                = con.prepareStatement(query);
        ps.setInt(1, id);
        ps.executeUpdate();
    }

    @Override
    public UserCredentials getUserCredential(int id)
            throws SQLException
    {

        String query
                = "select * from usercredentials where id= ?";
        PreparedStatement ps
                = con.prepareStatement(query);

        ps.setInt(1, id);
        UserCredentials obj = new UserCredentials();
        ResultSet rs = ps.executeQuery();
        boolean check = false;

        while (rs.next()) {
            check = true;
            obj.setId(rs.getInt("id"));
            obj.setUser(rs.getString("user"));
            obj.setPassword(rs.getString("password"));
            obj.setIdRole(rs.getInt("idRole"));
        }

        if (check == true) {
            return obj;
        }
        else
            return null;
    }

    @Override
    public List<UserCredentials> getUserCredentials()
            throws SQLException
    {
        String query = "select * from usercredentials";
        PreparedStatement ps
                = con.prepareStatement(query);
        ResultSet rs = ps.executeQuery();
        List<UserCredentials> ls = new ArrayList();

        while (rs.next()) {
            UserCredentials obj = new UserCredentials();
            obj.setId(rs.getInt("id"));
            obj.setUser(rs.getString("user"));
            obj.setPassword(rs.getString("password"));
            obj.setIdRole(rs.getInt("idRole"));
            ls.add(obj);
        }
        return ls;
    }

    @Override
    public void update(UserCredentials obj)
            throws SQLException
    {
        String query
                = "update usercredentials set user = ?, "
                + " password = ?"
                + " idRole = ? where id = ?";
        PreparedStatement ps
                = con.prepareStatement(query);
        ps.setString(1, obj.getUser());
        ps.setString(2, obj.getPassword());
        ps.setInt(3, obj.getIdRole());
        ps.setInt(4, obj.getId());
        ps.executeUpdate();
    }
}
