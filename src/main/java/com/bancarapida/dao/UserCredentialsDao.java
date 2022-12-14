package com.bancarapida.dao;

import com.bancarapida.model.UserCredentials;

import java.sql.SQLException;
import java.util.List;
public interface UserCredentialsDao {
    public int add(UserCredentials userCredentials)
            throws SQLException;
    public void delete(int id)
            throws SQLException;
    public UserCredentials getUserCredential(int id)
            throws SQLException;
    public List<UserCredentials> getUserCredentials()
            throws SQLException;
    public void update(UserCredentials userCredentials)
            throws SQLException;
}
