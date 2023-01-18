package com.bancarapida.model;

public class AccountUser {
    private Integer id;

    private String name;

    private String email;

    private String type;


    public AccountUser(Integer id,String name, String email, String type){

        this.id = id;
        this.name = name;
        this.email = email;
        this.type = type;
    }

    public AccountUser(){

    }

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    @Override
    public String toString()
    {
        return "Account [id=" + id + ", name=" + name + ", email=" + email +", id=" + id + ", type=" + type +"]";
    }
}
