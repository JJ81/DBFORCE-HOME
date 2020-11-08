<?php
if(strpos($_SERVER['HTTP_HOST'],"victoryinvestment.co.kr") === 0 or strpos($_SERVER['HTTP_HOST'],"victoryinvest.cafe24.com") === 0) {
    // define("DB_HOST", "victoryinvest.cafe24.com");
    define("DB_HOST", "localhost");
    define("DB_USER", "victoryinvest");
    define("DB_PASS", "victoryinvest!@!");
    define("DB_NAME", "victoryinvest");
    define("DB_PORT", "3306");
    define("DB_CHARSET", "utf8");
} else {
    define("DB_HOST", "127.0.0.1");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "victory");
    define("DB_PORT", "3306");
    define("DB_CHARSET", "utf8");
}