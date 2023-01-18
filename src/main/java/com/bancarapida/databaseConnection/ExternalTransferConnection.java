package com.bancarapida.databaseConnection;

import com.bancarapida.domain.service.ExternalTransferService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class ExternalTransferConnection {

    @Autowired
    private ExternalTransferService externalService;

    @GetMapping("/helloworld")
    public String greeting(){
        return "this is a test 🚀";
    }
}
