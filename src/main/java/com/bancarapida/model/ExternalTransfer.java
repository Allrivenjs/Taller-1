package com.bancarapida.model;

import java.sql.Date;

public class ExternalTransfer {
    private Integer id;
    private Integer idAccount;
    private String EANumber;
    private String transactionType;
    private String EAType;
    private String amount;
    private Date date;
    private String status;
    private String EAOwnerName;
    private String EAOwnerId;
    private String EAOwnerIdType;
    private String description;
    private String bankName;

    public ExternalTransfer(Integer idAccount, String EANumber, String transactionType, String EAType, String amount, String status, String EAOwnerName, String EAOwnerId, String EAOwnerIdType, String description, String bankName) {
        this.idAccount = idAccount;
        this.EANumber = EANumber;
        this.transactionType = transactionType;
        this.EAType = EAType;
        this.amount = amount;
        this.status = status;
        this.EAOwnerName = EAOwnerName;
        this.EAOwnerId = EAOwnerId;
        this.EAOwnerIdType = EAOwnerIdType;
        this.description = description;
        this.bankName = bankName;
    }

    public ExternalTransfer() {

    }

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public Integer getIdAccount() {
        return idAccount;
    }

    public void setIdAccount(Integer idAccount) {
        this.idAccount = idAccount;
    }

    public String getEANumber() {
        return EANumber;
    }

    public void setEANumber(String EANumber) {
        this.EANumber = EANumber;
    }

    public String getTransactionType() {
        return transactionType;
    }

    public void setTransactionType(String transactionType) {
        this.transactionType = transactionType;
    }

    public String getEAType() {
        return EAType;
    }

    public void setEAType(String EAType) {
        this.EAType = EAType;
    }

    public String getAmount() {
        return amount;
    }

    public void setAmount(String amount) {
        this.amount = amount;
    }

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public String getEAOwnerName() {
        return EAOwnerName;
    }

    public void setEAOwnerName(String EAOwnerName) {
        this.EAOwnerName = EAOwnerName;
    }

    public String getEAOwnerId() {
        return EAOwnerId;
    }

    public void setEAOwnerId(String EAOwnerId) {
        this.EAOwnerId = EAOwnerId;
    }

    public String getEAOwnerIdType() {
        return EAOwnerIdType;
    }

    public void setEAOwnerIdType(String EAOwnerIdType) {
        this.EAOwnerIdType = EAOwnerIdType;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getBankName() {
        return bankName;
    }

    public void setBankName(String bankName) {
        this.bankName = bankName;
    }
    @Override
    public String toString()
    {
        return "ExternalTransfer [id=" + id + ", idAccount=" + idAccount + ", EANumber=" + EANumber +", transactionType=" + transactionType +", EAType=" + EAType + ", amount=" + amount +", date=" + date +", status=" + status +", EAOwnerName=" + EAOwnerName +", EAOwnerId=" + EAOwnerId +", EAOwnerIdType="+ EAOwnerIdType +", description=" + description +", bankName=" + bankName +"  ]";
    }
}


