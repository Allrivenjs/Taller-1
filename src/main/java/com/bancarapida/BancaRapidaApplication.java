package com.bancarapida;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;

// import org.springframework.boot.context.event.ApplicationReadyEvent;
// import org.springframework.context.event.EventListener;
// import org.springframework.beans.factory.annotation.Autowired;


// import com.bancarapida.domain.service.SendMialService;

@SpringBootApplication
public class BancaRapidaApplication {
	// @Autowired
	// private SendMialService SendMialService;

	public static void main(String[] args) {
		SpringApplication.run(BancaRapidaApplication.class, args);
	}

	// @EventListener(ApplicationReadyEvent.class)
	// public void triggerMail() {
	// 	SendMialService.sendEmail("correo@gmail.com", "username", "10000", "ahorro", "interna", false);
	// }
}
