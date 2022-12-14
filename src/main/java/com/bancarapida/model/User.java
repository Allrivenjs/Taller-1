package com.bancarapida.model;

import java.sql.Date;

public class User {
    private Integer id;
    private String identityNumber;
    private String identityType;
    private String name;
    private String lastname;
    private String address;
    private String phone;
    private String email;
    private String gender;
    private String dob;
    private Integer idUserCredentials;
    private Date creationDate;

    public User(String identityNumber, String identityType, String name, String lastname, String address, String phone, String email, String gender, String dob, Integer idUserCredentials) {
        this.identityNumber = identityNumber;
        this.identityType = identityType;
        this.name = name;
        this.lastname = lastname;
        this.address = address;
        this.phone = phone;
        this.email = email;
        this.gender = gender;
        this.dob = dob;
        this.idUserCredentials = idUserCredentials;
    }

    public User() {

    }


    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public String getIdentityNumber() {
        return identityNumber;
    }

    public void setIdentityNumber(String identityNumber) {
        this.identityNumber = identityNumber;
    }

    public String getIdentityType() {
        return identityType;
    }

    public void setIdentityType(String identityType) {
        this.identityType = identityType;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getLastname() {
        return lastname;
    }

    public void setLastname(String lastname) {
        this.lastname = lastname;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getPhone() {
        return phone;
    }

    public void setPhone(String phone) {
        this.phone = phone;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getGender() {
        return gender;
    }

    public void setGender(String gender) {
        this.gender = gender;
    }

    public String getDob() {
        return dob;
    }

    public void setDob(String dob) {
        this.dob = dob;
    }

    public Integer getIdUserCredentials() {
        return idUserCredentials;
    }

    public void setIdUserCredentials(Integer idUserCredentials) {
        this.idUserCredentials = idUserCredentials;
    }

    public Date getCreationDate() {
        return creationDate;
    }

    public void setCreationDate(Date creationDate) {
        this.creationDate = creationDate;
    }

    @Override
    public String toString()
    {
        return "User [id=" + id + ", identityNumber=" + identityNumber + ", identityType=" + identityType +", name=" + name + ", lastname=" + lastname + ", address=" + address + ", phone=" + phone + ", email=" + email + ", gender=" + gender + ", dob=" + dob + ", idUserCredentials=" + idUserCredentials + ", creationDate=" + creationDate + "]";
    }
}

