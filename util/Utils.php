<?php
final class Utils {
    private function __construct() {
    }
    /**
     * Generate link.
     * @param string $page target page
     * @param array $params page parameters
     */
    public static function createLink($page, array $params = array()) {
        $params = array_merge(array('pagina' => $page), $params);
        return '../web/index.php?' .http_build_query($params);
    }
    /**
     * Format date.
     * @param DateTime $date date to be formatted
     * @return string formatted date
     */
    public static function formatDate(DateTime $date = null) {
        if ($date === null) {
            return '';
        }
        return $date->format('Y-m-d');
    }
    /**
     * Format date and time.
     * @param DateTime $date date to be formatted
     * @return string formatted date and time
     */
    public static function formatDateTime(DateTime $date = null) {
        if ($date === null) {
            return '';
        }
        return $date->format('d/m/Y H:i');
    }
    /**
     * Redirect to the given page.
     * @param type $page target page
     * @param array $params page parameters
     */
    public static function redirect($page, array $params = array()) {
        header('Location: ' . self::createLink($page, $params));
        die();
    }

    /**
     * Get value of the URL param.
     * @return string parameter value
     * @throws NotFoundException if the param is not found in the URL
     */
    public static function getUrlParam($name) {
        if (!array_key_exists($name, $_GET)) {
            throw new NotFoundException('URL parameter "' . $name . '" not found.');
        }
        //print_r($_GET[$name]);die;
        return $_GET[$name];
    }

    /**
     * Get {@link Todo} by the identifier 'id' found in the URL.
     * @return Todo {@link Todo} instance
     * @throws NotFoundException if the param or {@link Todo} instance is not found
     */
    public static function getTodoByGetId() {
        $id = null;
        try {
            $id = self::getUrlParam('id');
        } catch (Exception $ex) {
            throw new NotFoundException('No TODO identifier provided.');
        }
        if (!is_numeric($id)) {
            throw new NotFoundException('Invalid TODO identifier provided.');
        }
        $dao = new TodoDao();
        $todo = $dao->findById($id);
        if ($todo === null) {
            throw new NotFoundException('Unknown TODO identifier provided.');
        }
        return $todo;
    }

    /**
     * Capitalize the first letter of the given string
     * @param string $string string to be capitalized
     * @return string capitalized string
     */
    public static function capitalize($string) {
        return ucfirst(mb_strtolower($string));
    }

    /**
     * Escape the given string
     * @param string $string string to be escaped
     * @return string escaped string
     */
    public static function escape($string) {
        //print_r(htmlspecialchars($string, ENT_QUOTES));
        return htmlspecialchars($string, ENT_QUOTES);
    }
    public static function datafatura($str,$etapa=null){
        $str=date($str);
        $hoje=date('d/m/Y');
        if($etapa=='60'||$etapa=='70'){
            $cor='black';
            $msg='Faturado';
        }elseif($str < $hoje){
            $cor='red';
            $msg='Faturamento atrasado';
        }elseif($str==$hoje){
            $cor='green';
            $msg='Vence hoje';
        }elseif($str > $hoje){
            $cor='blue';
            $msg='Previsto para '.$str;
        }
        return $msg.','.$cor;
    }
    public static function removePonto($str){
        $str=str_replace('.','',$str);
        $str=str_replace(',','.',$str);
        return $str;
    }
}
?>