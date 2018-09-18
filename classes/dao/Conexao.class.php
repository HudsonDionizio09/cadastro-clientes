<?php
class Conexao {
    
    private const SERVER = "localhost";
    private const USER = "root";
    private const PASS = "";
    private const DB = "db_projetosenac";
    private const URL = "mysql:host=" . self::SERVER . ";dbname=" . self::DB;
    private const UTF = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    private static $conexao;
    public static function get() {
        try {
            if (!isset(self::$conexao)) {
                self::$conexao = new PDO(self::URL, self::USER, self::PASS, self::UTF);
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$conexao;
        
        } catch(PDOException $error) {
            echo "Conexão falhou: {$error->getMessage()}";
            return null;
        }
    }
}