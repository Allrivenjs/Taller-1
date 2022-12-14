package com.bancarapida.dao;

import com.bancarapida.databaseConnection.DatabaseConnection;
import com.bancarapida.model.CreditStatus;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
public class CreditStatusDaoImplementation implements CreditStatusDao{
    static Connection con
            = DatabaseConnection.getConnection();

    @Override
    public int add(CreditStatus obj)
            throws SQLException
    {
        String query = "insert into creditstatus( status, idCredit, idUser) VALUES (?,?,?)";
        PreparedStatement ps = con.prepareStatement(query);
        ps.setString(1, obj.getStatus());
        ps.setInt(2, obj.getIdCredit());
        ps.setInt(3, obj.getIdUser_responsible());
        int n = ps.executeUpdate();
        return n;
    }

    @Override
    public void delete(int id)
            throws SQLException
    {
        String query
                = "delete from creditstatus where id =?";
        PreparedStatement ps
                = con.prepareStatement(query);
        ps.setInt(1, id);
        ps.executeUpdate();
    }

    @Override
    public CreditStatus getCredit(int id)
            throws SQLException
    {

        String query
                = "select * from creditstatus where id= ?";
        PreparedStatement ps
                = con.prepareStatement(query);

        ps.setInt(1, id);
        CreditStatus obj = new CreditStatus();
        ResultSet rs = ps.executeQuery();
        boolean check = false;

        while (rs.next()) {
            check = true;
            obj.setId(rs.getInt("id"));
            obj.setStatus(rs.getString("status"));
            obj.setDate(rs.getDate("date"));
            obj.setIdCredit(rs.getInt("idCredit"));
            obj.setIdUser_responsible(rs.getInt("idUser"));
        }

        if (check == true) {
            return obj;
        }
        else
            return null;
    }

    @Override
    public List<CreditStatus> getCredits()
            throws SQLException
    {
        String query = "select * from creditstatus";
        PreparedStatement ps
                = con.prepareStatement(query);
        ResultSet rs = ps.executeQuery();
        List<CreditStatus> ls = new ArrayList();

        while (rs.next()) {
            CreditStatus obj = new CreditStatus();
            obj.setId(rs.getInt("id"));
            obj.setStatus(rs.getString("status"));
            obj.setDate(rs.getDate("date"));
            obj.setIdCredit(rs.getInt("idCredit"));
            obj.setIdUser_responsible(rs.getInt("idUser"));
            ls.add(obj);
        }
        return ls;
    }

    @Override
    public void update(CreditStatus obj)
            throws SQLException
    {
        String query
                = "update creditstatus set status = ?, "
                + " date = ?"
                + " idCredit= ?"
                + " idUser = ? where id = ?";
        PreparedStatement ps
                = con.prepareStatement(query);
        ps.setString(1, obj.getStatus());
        ps.setInt(2, obj.getIdCredit());
        ps.setInt(3, obj.getIdUser_responsible());
        ps.setInt(4, obj.getId());
        ps.executeUpdate();
    }
}
