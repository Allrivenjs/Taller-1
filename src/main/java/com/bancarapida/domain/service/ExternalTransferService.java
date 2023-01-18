package com.bancarapida.domain.service;

import com.bancarapida.dao.ExternalTransferDao;
import com.bancarapida.dao.ExternalTransferDaoImplementation;
import com.bancarapida.model.ExternalTransfer;
import org.springframework.beans.factory.annotation.Autowired;

import java.sql.SQLException;
import java.util.List;

public class ExternalTransferService implements ExternalTransferDao {

    @Autowired
    private ExternalTransferDaoImplementation externalTransferDao;

    @Override
    public int add(ExternalTransfer externalTransfer) throws SQLException {
        return externalTransferDao.add(externalTransfer);
    }

    @Override
    public void delete(int id) throws SQLException {

    }

    @Override
    public ExternalTransfer getExternalTransfer(int id) throws SQLException {
        return externalTransferDao.getExternalTransfer(id);
    }

    @Override
    public List<ExternalTransfer> getExternalTransfers() throws SQLException {
        return externalTransferDao.getExternalTransfers();
    }

    @Override
    public void update(ExternalTransfer externalTransfer) throws SQLException {
        externalTransferDao.update(externalTransfer);
    }

    @Override
    public Float verifiedAmount(int id) throws SQLException {
        return externalTransferDao.verifiedAmount(id);
    }

}
