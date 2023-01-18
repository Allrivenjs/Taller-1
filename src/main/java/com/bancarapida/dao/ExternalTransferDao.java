package com.bancarapida.dao;

import com.bancarapida.model.ExternalTransfer;

import java.sql.SQLException;
import java.util.List;
public interface ExternalTransferDao {
    public int add(ExternalTransfer externalTransfer)
            throws SQLException;
    public void delete(int id)
            throws SQLException;
    public ExternalTransfer getExternalTransfer(int id)
            throws SQLException;
    public List<ExternalTransfer> getExternalTransfers()
            throws SQLException;
    public void update(ExternalTransfer externalTransfer)
            throws SQLException;
    public Float verifiedAmount(int id)
            throws SQLException;

}