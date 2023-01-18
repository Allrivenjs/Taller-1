package com.bancarapida.dao;

import com.bancarapida.databaseConnection.DatabaseConnection;
import com.bancarapida.model.AccountUser;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

public class AccountUserDaoImplementation implements AccountUserDao{
    static Connection con
            = DatabaseConnection.getConnection();
    @Override
    public AccountUser getAccountUser(int id) throws SQLException {
        String query
                = "select account.id,user.name , user.email FROM bancarapida.account inner join bancarapida.user on account.idUser = user.id where accountNumber = ?";
        PreparedStatement ps
                = con.prepareStatement(query);
        ps.setInt(1, id);
        AccountUser obj = new AccountUser();
        ResultSet rs = ps.executeQuery();
        boolean check = false;
        while (rs.next()) {
            check = true;
            obj.setId(rs.getInt("id"));
            obj.setName(rs.getString("name"));
            obj.setEmail(rs.getString("email"));
            obj.setType(rs.getString("type"));
        }

        if (check == true) {
            return obj;
        }else{
            return  null;
        }
    }
}
