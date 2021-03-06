<?php
/**
 * Application config.
 */
final class Config {
    /** @var array config data */
    private static $data = null;
    private static $data2 = null;
    private static $arquivo = '../config/config.ini';
    private static $arquivo2 = '../config/config.ini';
    /**
     * @return array
     * @throws Exception
     */
    public static function getConfig($section = null) {
        if ($section === null) {
            return self::getData();
        }
        $data = self::getData();
        if (!array_key_exists($section, $data)) {
            throw new Exception('Unknown config section: ' . $section);
        }
        return $data[$section];
    }
    public static function getConfig2($section = null) {
        if ($section === null) {
            return self::getData2();
        }
        $data2 = self::getData2();
        if (!array_key_exists($section, $data2)) {
            throw new Exception('Unknown config section: ' . $section);
        }
        return $data2[$section];
    }

    /**
     * @return array
     */
    private static function getData() {
        if (self::$data !== null) {
            return self::$data;
        }
        if(file_exists(self::$arquivo)){
            self::$data = parse_ini_file('../config/config.ini', true);
        }else{
            self::$data = parse_ini_file('config/config.ini', true);
        }
        return self::$data;
    }
    private static function getData2() {
        if (self::$data2 !== null) {
            return self::$data2;
        }
        if(file_exists(self::$arquivo2)){
            self::$data2 = parse_ini_file('../config/conta.ini', true);
        }else{
            self::$data2 = parse_ini_file('config/conta.ini', true);
        }
        return self::$data2;
    }
}
?>