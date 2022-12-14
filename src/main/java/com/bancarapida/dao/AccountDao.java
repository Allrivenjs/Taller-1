package com.bancarapida.dao;

import com.bancarapida.model.Account;

import java.sql.SQLException;
import java.util.List;
public interface AccountDao {
    public int add(Account account)
            throws SQLException;
    public void delete(int id)
            throws SQLException;
    public Account getAccount(int id)
            throws SQLException;
    public List<Account> getAccounts()
            throws SQLException;
    public void update(Account account)
            throws SQLException;
}
