package com.bancarapida.web.config;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import springfox.documentation.builders.ApiInfoBuilder;
import springfox.documentation.builders.PathSelectors;
import springfox.documentation.builders.RequestHandlerSelectors;
import springfox.documentation.service.ApiInfo;
import springfox.documentation.service.ApiKey;
import springfox.documentation.spi.DocumentationType;
import springfox.documentation.spring.web.plugins.Docket;
import springfox.documentation.swagger2.annotations.EnableSwagger2;

import java.util.Arrays;

@Configuration
@EnableSwagger2
public class SwaggerConfig {

    @Bean
    public Docket api(){
        return new Docket(DocumentationType.SWAGGER_2)
                .select()
                .apis(RequestHandlerSelectors.basePackage("com.bancarapida.web.controller"))
                .paths(PathSelectors.regex("/.*"))
                .build().apiInfo(apiEndPointInfo())
                .securitySchemes(Arrays.asList(apiKey()));
    }
    //michen and rubeslt login and register // dao doman persistence mapper
    private ApiInfo apiEndPointInfo(){
        return new ApiInfoBuilder().title("API de productos")
                .description("Servicio para 'Bancarapida'")
                .license("Apache 2.0")
                .version("1.0.0")
                .licenseUrl("http://www.apache.org/licenses/LICENSE-2.0.html")
                .build();
    }

    private ApiKey apiKey(){
        return new ApiKey("JWT", "Authorization", "header");
    }
}
