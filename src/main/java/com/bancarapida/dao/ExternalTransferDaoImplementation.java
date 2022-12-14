package com.bancarapida.dao;

import com.bancarapida.databaseConnection.DatabaseConnection;
import com.bancarapida.model.ExternalTransfer;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
public class ExternalTransferDaoImplementation implements ExternalTransferDao{
    static Connection con
            = DatabaseConnection.getConnection();

    @Override
    public int add(ExternalTransfer obj)
            throws SQLException
    {
        String query = "insert into externaltransfer( idAccount, EANumber, transactionType, EAType, amount, status, EAOwnerName, EAOwnerId, EAOwnerType, description, bankName   ) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        PreparedStatement ps = con.prepareStatement(query);
        ps.setInt(1, obj.getIdAccount());
        ps.setString(2, obj.getEANumber());
        ps.setString(3, obj.getTransactionType());
        ps.setString(4, obj.getEAType());
        ps.setString(5, obj.getAmount());
        ps.setString(6, obj.getStatus());
        ps.setString(7, obj.getEAOwnerName());
        ps.setString(8, obj.getEAOwnerId());
        ps.setString(9, obj.getEAOwnerIdType());
        ps.setString(10, obj.getDescription());
        ps.setString(11, obj.getBankName());

        int n = ps.executeUpdate();
        return n;
    }

    @Override
    public void delete(int id)
            throws SQLException
    {
        String query
                = "delete from externaltransfer where id =?";
        PreparedStatement ps
                = con.prepareStatement(query);
        ps.setInt(1, id);
        ps.executeUpdate();
    }

    @Override
    public ExternalTransfer getExternalTransfer(int id)
            throws SQLException
    {

        String query
                = "select * from externaltransfer where id= ?";
        PreparedStatement ps
                = con.prepareStatement(query);

        ps.setInt(1, id);
        ExternalTransfer obj = new ExternalTransfer();
        ResultSet rs = ps.executeQuery();
        boolean check = false;

        while (rs.next()) {
            check = true;
            obj.setId(rs.getInt("id"));
            obj.setIdAccount(rs.getInt("idAccount"));
            obj.setEANumber(rs.getString("EANumber"));
            obj.setTransactionType(rs.getString("transactionType"));
            obj.setEAType(rs.getString("EAType"));
            obj.setAmount(rs.getString("amount"));
            obj.setDate(rs.getDate("date"));
            obj.setStatus(rs.getString("status"));
            obj.setEAOwnerId(rs.getString("EAOwnerName"));
            obj.setEAOwnerId(rs.getString("EAOwnerId"));
            obj.setEAOwnerIdType(rs.getString("EAOwnerType"));
            obj.setDescription(rs.getString("description"));
            obj.setBankName(rs.getString("bankName"));
        }

        if (check == true) {
            return obj;
        }
        else
            return null;
    }

    @Override
    public List<ExternalTransfer> getExternalTransfers()
            throws SQLException
    {
        String query = "select * from externaltransfer";
        PreparedStatement ps
                = con.prepareStatement(query);
        ResultSet rs = ps.executeQuery();
        List<ExternalTransfer> ls = new ArrayList();

        while (rs.next()) {
            ExternalTransfer obj = new ExternalTransfer();
            obj.setId(rs.getInt("id"));
            obj.setIdAccount(rs.getInt("idAccount"));
            obj.setEANumber(rs.getString("EANumber"));
            obj.setTransactionType(rs.getString("transactionType"));
            obj.setEAType(rs.getString("EAType"));
            obj.setAmount(rs.getString("amount"));
            obj.setDate(rs.getDate("date"));
            obj.setStatus(rs.getString("status"));
            obj.setEAOwnerId(rs.getString("EAOwnerName"));
            obj.setEAOwnerId(rs.getString("EAOwnerId"));
            obj.setEAOwnerIdType(rs.getString("EAOwnerType"));
            obj.setDescription(rs.getString("description"));
            obj.setBankName(rs.getString("bankName"));
            ls.add(obj);
        }
        return ls;
    }

    @Override
    public void update(ExternalTransfer obj)
            throws SQLException
    {
        String query
                = "update externaltransfer set idAccount = ?, "
                + " EANumber = ?"
                + " transactionType = ?"
                + " EAType = ?"
                + " amount = ?"
                + " date = ?"
                + " status = ?"
                + " EAOwnerName = ?"
                + " EAOwnerId = ?"
                + " EAOwnerIdType = ?"
                + " description = ?"
                + " bankName = ? where id = ?";
        PreparedStatement ps
                = con.prepareStatement(query);
        ps.setInt(1, obj.getIdAccount());
        ps.setString(2, obj.getEANumber());
        ps.setString(3, obj.getTransactionType());
        ps.setString(4, obj.getEAType());
        ps.setString(5, obj.getAmount());
        ps.setString(6, obj.getStatus());
        ps.setString(7, obj.getEAOwnerName());
        ps.setString(8, obj.getEAOwnerId());
        ps.setString(9, obj.getEAOwnerIdType());
        ps.setString(10, obj.getDescription());
        ps.setString(11, obj.getBankName());
        ps.setInt(12, obj.getId());

    }
}