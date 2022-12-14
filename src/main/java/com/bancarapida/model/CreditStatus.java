package com.bancarapida.model;

import java.sql.Date;

public class CreditStatus{
    private Integer id;
    private String status;
    private Date date;
    private Integer idCredit;
    private Integer idUser_responsible;

    public CreditStatus(String status, Integer idCredit, Integer idUser_responsible) {
        this.status = status;
        this.idCredit = idCredit;
        this.idUser_responsible = idUser_responsible;
    }

    public CreditStatus() {

    }

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    public Integer getIdCredit() {
        return idCredit;
    }

    public void setIdCredit(Integer idCredit) {
        this.idCredit = idCredit;
    }

    public Integer getIdUser_responsible() {
        return idUser_responsible;
    }

    public void setIdUser_responsible(Integer idUser_responsible) {
        this.idUser_responsible = idUser_responsible;
    }
    @Override
    public String toString()
    {
        return "CreditStatus [id=" + id + ", status=" + status + ", date=" + date +", idCredit=" + idCredit +", idUser_responsible=" + idUser_responsible + "]";
    }
}