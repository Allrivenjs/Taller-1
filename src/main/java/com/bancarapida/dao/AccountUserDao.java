package com.bancarapida.dao;

import com.bancarapida.model.Account;
import com.bancarapida.model.AccountUser;

import java.sql.SQLException;

public interface AccountUserDao {
    public AccountUser getAccountUser(int id)
            throws SQLException;
}
