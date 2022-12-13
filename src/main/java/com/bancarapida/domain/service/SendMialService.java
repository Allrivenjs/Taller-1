package com.bancarapida.domain.service;

import org.springframework.ui.freemarker.FreeMarkerConfigurationFactoryBean;
import java.util.HashMap;
import java.util.Map;
import java.nio.charset.StandardCharsets;

import javax.mail.internet.MimeMessage;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.mail.javamail.JavaMailSender;
import org.springframework.mail.javamail.MimeMessageHelper;
import org.springframework.stereotype.Service;
import org.springframework.ui.freemarker.FreeMarkerTemplateUtils;

import freemarker.template.Configuration;
import freemarker.template.Template;

@Service
public class SendMialService {
    @Autowired
    private JavaMailSender sender;

    @Autowired
    private Configuration config;

    public void sendEmail(String userMail, String userName, String valueSent, String accountType,
            String typeTransfer, Boolean isFaild) {

        MimeMessage message = sender.createMimeMessage();

        try {

            String faild = isFaild ? "rechazada" : "exitosa";
            String faildTitle = isFaild ? "Transaccion rechazada" : "Transaccion exitosa";

            FreeMarkerConfigurationFactoryBean bean = new FreeMarkerConfigurationFactoryBean();
            bean.setTemplateLoaderPath("classpath:/templates");

            Map<String, Object> model = new HashMap<>();
            model.put("faildTitle", faildTitle);
            model.put("userName", userName);
            model.put("accountType", accountType);
            model.put("faild", faild);
            model.put("typeTransfer", typeTransfer);
            model.put("valueSent", valueSent);

            Template t = config.getTemplate("email-template.ftl");
            String html = FreeMarkerTemplateUtils.processTemplateIntoString(t, model);

            MimeMessageHelper helper = new MimeMessageHelper(message, MimeMessageHelper.MULTIPART_MODE_MIXED_RELATED,
                    StandardCharsets.UTF_8.name());

            helper.setFrom("bancarapidanoreply@gmail.com");
            helper.setTo(userMail);
            helper.setText(html, true);
            helper.setSubject("BancaRapida le informa");
            sender.send(message);
            System.out.println("Mail Send...");
        } catch (Exception e) {
            System.err.println(e);
        }
    }
}
