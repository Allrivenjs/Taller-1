package com.bancarapida.dao;

import com.bancarapida.databaseConnection.DatabaseConnection;
import com.bancarapida.model.Account;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
public class AccountDaoImplementation implements AccountDao{
    static Connection con
            = DatabaseConnection.getConnection();

    @Override
    public int add(Account obj)
            throws SQLException
    {
        String query = "insert into account( accountNumber, type, amount, idUser) VALUES (?,?,?,?)";
        PreparedStatement ps = con.prepareStatement(query);
        ps.setString(1, obj.getAccountNumber());
        ps.setString(2, obj.getType());
        ps.setFloat(3, obj.getAmount());
        ps.setInt(4, obj.getIdUser());
        int n = ps.executeUpdate();
        return n;
    }

    @Override
    public void delete(int id)
            throws SQLException
    {
        String query
                = "delete from account where id =?";
        PreparedStatement ps
                = con.prepareStatement(query);
        ps.setInt(1, id);
        ps.executeUpdate();
    }

    @Override
    public Account getAccount(int id)
            throws SQLException
    {

        String query
                = "select * from account where id= ?";
        PreparedStatement ps
                = con.prepareStatement(query);

        ps.setInt(1, id);
        Account obj = new Account();
        ResultSet rs = ps.executeQuery();
        boolean check = false;

        while (rs.next()) {
            check = true;
            obj.setId(rs.getInt("id"));
            obj.setAccountNumber(rs.getString("accountNumber"));
            obj.setType(rs.getString("type"));
            obj.setAmount(rs.getFloat("amount"));
            obj.setIdUser(rs.getInt("idUser"));
        }

        if (check == true) {
            return obj;
        }
        else
            return null;
    }

    @Override
    public List<Account> getAccounts()
            throws SQLException
    {
        String query = "select * from account";
        PreparedStatement ps
                = con.prepareStatement(query);
        ResultSet rs = ps.executeQuery();
        List<Account> ls = new ArrayList();

        while (rs.next()) {
            Account obj = new Account();
            obj.setId(rs.getInt("id"));
            obj.setAccountNumber(rs.getString("accountNumber"));
            obj.setType(rs.getString("type"));
            obj.setAmount(rs.getFloat("amount"));
            obj.setIdUser(rs.getInt("idUser"));
            ls.add(obj);
        }
        return ls;
    }

    @Override
    public void update(Account obj)
            throws SQLException
    {
        String query
                = "update account set accountNumber = ?, "
                + " type = ?"
                + " amount = ?"
                + " idUser = ? where id = ?";
        PreparedStatement ps
                = con.prepareStatement(query);
        ps.setString(1, obj.getAccountNumber());
        ps.setString(2, obj.getType());
        ps.setFloat(3, obj.getAmount());
        ps.setInt(4, obj.getIdUser());
        ps.executeUpdate();
    }
}