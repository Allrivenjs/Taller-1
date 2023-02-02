package com.bancarapida.databaseConnection;

import com.bancarapida.domain.service.ExternalTransferService;
import com.bancarapida.model.UserCredentials;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.*;
import com.bancarapida.model.ExternalTransfer;

import java.sql.*;
import java.util.List;


@Controller
public class ExternalTransferConnection {

    private static Connection con = null;
    private static final String url = "jdbc:mysql:// localhost:3306/bancarapidadb";

    static
    {
        ConectarDB(null);
    }


    private static void ConectarDB(UserCredentials UC){
        int Rol = (UC==null)?3:UC.getIdRole();
        /*
         * usuario publico solamente para hacer el login
         * */
        String UserDB = "root";
        String Pass = "";
        switch(Rol) {
            case 3:
                UserDB = "root";
                Pass = "";
                break;
            case 2:
                UserDB = "root";
                Pass = "";
                break;
            case 1:
                UserDB = "root";
                Pass = "";
                break;
        }

        try {
            Class.forName("com.mysql.jdbc.Driver");
            con = DriverManager.getConnection(url, UserDB, Pass);
        }
        catch (ClassNotFoundException | SQLException e) {
            e.printStackTrace();
        }
    }

    public static Connection getConnection()
    {
        return con;
    }
    @Autowired
    private ExternalTransferService externalService;

    @GetMapping("/getTransactions")
    public ResponseEntity<List<ExternalTransfer>>listar()  throws SQLException {
        return new ResponseEntity<>(externalService.getExternalTransfers(), HttpStatus.OK);
    }

    @GetMapping("/getExternalTransfer/{id}")
    public ExternalTransfer getId(@PathVariable Integer id) throws SQLException{
        return externalService.getExternalTransfer(id);
    }

    @RequestMapping(value = "/deleteTransfer/{id}", method = RequestMethod.DELETE)
    public ResponseEntity<String> deleteExternal(@PathVariable int id) throws SQLException{
        externalService.delete(id);
        return new ResponseEntity<>("Elemento eliminado",HttpStatus.OK);
    }

    @PostMapping("/saveExternal")
    public ResponseEntity<ExternalTransfer> save(@RequestBody ExternalTransfer external) throws SQLException{
        externalService.add(external);
        return new ResponseEntity<>(external, HttpStatus.OK);

    }
    @GetMapping("/helloworld")
    public String greeting() {
        return "this is a test 🚀";
    }
}
