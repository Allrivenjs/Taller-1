package com.bancarapida.model;

public class Account {
    private Integer id;
    private String accountNumber;
    private String type;
    private Float amount;
    private Integer idUser;

    public Account(String accountNumber, String type, Float amount, Integer idUser) {
        this.accountNumber = accountNumber;
        this.type = type;
        this.amount = amount;
        this.idUser = idUser;
    }

    public Account() {

    }

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public String getAccountNumber() {
        return accountNumber;
    }

    public void setAccountNumber(String accountNumber) {
        this.accountNumber = accountNumber;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public Float getAmount() {
        return amount;
    }

    public void setAmount(Float amount) {
        this.amount = amount;
    }

    public Integer getIdUser() {
        return idUser;
    }

    public void setIdUser(Integer idUser) {
        this.idUser = idUser;
    }

    @Override
    public String toString()
    {
        return "Account [id=" + id + ", accountNumber=" + accountNumber + ", type=" + type +", amount=" + amount + ", idUser=" + idUser + "]";
    }

}
