<?php

namespace App\External_Transaction;

use DateTime;

class External_Transaction{

    private $idAccount;
    private String $EANumber = '';
    private String $transactioType = '';
    private String $EAType = '';
    private int $amount = 0;
    private DateTime $date;
    private String $status = '';
    private String $EAOwnerName = '';
    private String $EAOwnerId = '';
    private String $EAOwnerType = '';
    private String $description = '';
    private String $bankName = '';
}

/*
     *
     * All Rights Reserved.
     *
     * Made in Colombia by:
     * Sebastian Quinchia
     *
     * ©14/11/2022
     * Update in Colombia by:
     * Milly Benitez Martinez
     * Luis Macea Beltran
     * Luis Renteria Martinez
     * Alex Urango Avila
     * */