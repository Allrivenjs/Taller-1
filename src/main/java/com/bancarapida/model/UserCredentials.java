package com.bancarapida.model;

public class UserCredentials {
    private Integer id;
    private String user;
    private String password;
    private Integer idRole;

    public UserCredentials(String user, String password, Integer idRole) {
        this.user = user;
        this.password = password;
        this.idRole = idRole;
    }

    public UserCredentials() {
    }

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public String getUser() {
        return user;
    }

    public void setUser(String user) {
        this.user = user;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public Integer getIdRole() {
        return idRole;
    }

    public void setIdRole(Integer idRole) {
        this.idRole = idRole;
    }

    @Override
    public String toString()
    {
        return "UserCredentials [id=" + id + ", user=" + user + ", password=" + password +", idRole=" + idRole + "]";
    }
}
