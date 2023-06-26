<?php
session_start();

/**
 * Hata raporlarının düzenlenmesi
 * Development sirasinda bütün hataları görünür.
 */
error_reporting(0);
ini_set("display_errors", 0);
ini_set("memory_limit","-1");
/**
 * Database bağlantısı
 * 
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'hospital_system');   //Do Not change
define('DB_USER', 'username_is_here');  //DBUSER
define('DB_PASS', 'password_is_here');  //DBPASS

//----------- user types ------
define('UNDEFINED',0); // Sitenin ilk açılış sayfası (site ziyaretcisi gibi)
define('SUPERVISOR','SUPERVISOR'); // Tüm kontrolleri elinde tutan kullanıcı 
define('ADMIN','ADMIN'); // Belli bazı kontroller, elinde tutan kullanıcı (ürün satan gibi)
define('CUSTOMER','CUSTOMER'); // Hem default arayüzü hemde bazı yetkilere sahip kullanıcı (alış veriş yapmış kullanıcı)
//------ default language ------------------------------------------------
//------ default language ------------------------------------------------
define('DEFAULTLANG','tr');
define('ACCEPTEDLANG','tr');