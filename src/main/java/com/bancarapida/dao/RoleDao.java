package com.bancarapida.dao;

import com.bancarapida.model.Role;

import java.sql.SQLException;
import java.util.List;
public interface RoleDao {
    public int add(Role rol)
            throws SQLException;
    public void delete(int id)
            throws SQLException;
    public Role getRole(int id)
            throws SQLException;
    public List<Role> getRoles()
            throws SQLException;
    public void update(Role emp)
            throws SQLException;
}
