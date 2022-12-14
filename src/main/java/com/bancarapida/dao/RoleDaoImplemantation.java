package com.bancarapida.dao;

import com.bancarapida.databaseConnection.DatabaseConnection;
import com.bancarapida.model.Role;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
public class RoleDaoImplemantation implements RoleDao{
    static Connection con
            = DatabaseConnection.getConnection();

    @Override
    public int add(Role rol)
            throws SQLException
    {
        String query = "insert into role(name) VALUES (?)";
        PreparedStatement ps = con.prepareStatement(query);
        ps.setString(1, rol.getName());
        int n = ps.executeUpdate();
        return n;
    }

    @Override
    public void delete(int id)
            throws SQLException
    {
        String query
                = "delete from role where id =?";
        PreparedStatement ps
                = con.prepareStatement(query);
        ps.setInt(1, id);
        ps.executeUpdate();
    }

    @Override
    public Role getRole(int id)
            throws SQLException
    {

        String query
                = "select * from role where id= ?";
        PreparedStatement ps
                = con.prepareStatement(query);

        ps.setInt(1, id);
        Role rol = new Role();
        ResultSet rs = ps.executeQuery();
        boolean check = false;

        while (rs.next()) {
            check = true;
            rol.setId(rs.getInt("id"));
            rol.setName(rs.getString("name"));
        }

        if (check == true) {
            return rol;
        }
        else
            return null;
    }

    @Override
    public List<Role> getRoles()
            throws SQLException
    {
        String query = "select * from role";
        PreparedStatement ps
                = con.prepareStatement(query);
        ResultSet rs = ps.executeQuery();
        List<Role> ls = new ArrayList();

        while (rs.next()) {
            Role rol = new Role();
            rol.setId(rs.getInt("id"));
            rol.setName(rs.getString("name"));
            ls.add(rol);
        }
        return ls;
    }

    @Override
    public void update(Role rol)
            throws SQLException
    {

        String query
                = "update role set name = ?, "
                + " where id = ?";
        PreparedStatement ps
                = con.prepareStatement(query);
        ps.setString(1, rol.getName());
        ps.setInt(2, rol.getId());
        ps.executeUpdate();
    }
}
