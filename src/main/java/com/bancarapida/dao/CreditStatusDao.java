package com.bancarapida.dao;

import com.bancarapida.model.CreditStatus;

import java.sql.SQLException;
import java.util.List;
public interface CreditStatusDao {
    public int add(CreditStatus creditStatus)
            throws SQLException;
    public void delete(int id)
            throws SQLException;
    public CreditStatus getCredit(int id)
            throws SQLException;
    public List<CreditStatus> getCredits()
            throws SQLException;
    public void update(CreditStatus creditStatus)
            throws SQLException;
}