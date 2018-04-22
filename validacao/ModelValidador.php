<?php
final class ModelValidador {
    private function __construct() {
    }
    public static function validar(Model $todo) {
        $errors = array();
        if (!$todo->getCreatedOn()) {
            $errors[] = new Error('createdOn', 'Empty or invalid Created On.');
        }
        if (!$todo->getLastModifiedOn()) {
            $errors[] = new Error('lastModifiedOn', 'Empty or invalid Last Modified On.');
        }
        if (!trim($todo->getPriority())) {
            $errors[] = new Error('priority', 'Priority cannot be empty.');
        } elseif (!self::isValidPriority($todo->getPriority())) {
            $errors[] = new Error('priority', 'Invalid Priority set.');
        }
        if (!trim($todo->getStatus())) {
            $errors[] = new Error('status', 'Status cannot be empty.');
        } elseif (!self::isValidStatus($todo->getStatus())) {
            $errors[] = new Error('status', 'Invalid Status set.');
        }
        return $errors;
    }
    public static function validateStatus($status) {
        if (!self::isValidStatus($status)) {
            throw new Exception('Unknown status: ' . $status);
        }
    }
    public static function validatePriority($priority) {
        if (!self::isValidPriority($priority)) {
            throw new Exception('Unknown priority: ' . $priority);
        }
    }
    private static function isValidStatus($status) {
        return in_array($status, Todo::allStatuses());
    }
    private static function isValidPriority($priority) {
        return in_array($priority, Todo::allPriorities());
    }
    public static function nomeMes($mes){
       switch ($mes){
         case 1:
          $mes="janeiro";
          break;
         case 2:
          $mes="fevereiro";
          break;
         case 3:
          $mes="março";
          break;
         case 4:
          $mes="abril";
          break;
         case 5:
          $mes="maio";
          break;
         case 6:
          $mes="junho";
          break;
         case 7:
          $mes="julho";
          break;
         case 8:
          $mes="agosto";
          break;
         case 9:
          $mes="setembro";
          break;
         case 10:
          $mes="outubro";
          break;
         case 11:
          $mes="novembro";
          break;
         case 12:
          $mes="dezembro";
          break;
       }
       return $mes;
    }
    public static function numeroMes($mes){
       switch ($mes){
         case "janeiro":
          $mes="01";
          break;
         case "fevereiro":
          $mes="02";
          break;
         case "marco":
          $mes="03";
          break;
         case "abril":
          $mes="04";
          break;
         case "maio":
          $mes="05";
          break;
         case "junho":
          $mes="06";
          break;
         case "julho":
          $mes="07";
          break;
         case "agosto":
          $mes="08";
          break;
         case "setembro":
          $mes="09";
          break;
         case "outubro":
          $mes="10";
          break;
         case "novembro":
          $mes="11";
          break;
         case "dezembro":
          $mes="12";
          break;
       }
       return $mes;
    }
    public static function mask($val, $mask){
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++){
	 if($mask[$i] == '#'){
            if(isset($val[$k]))
                $maskared .= $val[$k++];
         }else{
            if(isset($mask[$i]))
            $maskared .= $mask[$i];
         }
        }
	 return $maskared;
    }
    public static function data($data){
        $ano=substr($data,0,4);
        $mes=substr($data,5,2);
        $dia=substr($data,8,2);
        
        $data="$dia/$mes/$ano";
        return $data;
    }
    public static function tirarAcento($string){  
      return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c Ç"),$string);
    }
    public static function removePonto($dado){
        //$dado='10.00';
        $dado=str_replace('.','',$dado);
        $dado_=preg_replace( '#[^0-9]#', '.', $dado );
        //echo $dado_;die;
        return $dado_;
    }
    public static function iniciaisMaiusculas($string, $act=null){
        $sobrenome=explode(' ',mb_strtolower($string,'utf-8'));
        $nomeCompleto=null;
        $x=1;
        foreach($sobrenome as $str){
            if('maria'==strtolower($str) && $act=='carteirinha'){
                $str='M.ª';
            }
            if('filho'==strtolower($str) && $act=='carteirinha'){
                $str='F.';
            }
            if(strlen($string)>18 && $act=='carteirinha'){
                if(($x==2 ) && strlen($str)>3){
                    $nomeCompleto .=mb_strtoupper(substr($str,0,1),'utf-8').'. ';
                    goto s;
                }elseif((($x==3||$x==6) && strlen($str)>3) && count($sobrenome) > 3){
                    $nomeCompleto .=mb_strtoupper(substr($str,0,1),'utf-8').'. ';
                    goto s;
                }              
            }
            if(count($sobrenome)==5){
                if($x==3 && strlen($str)>3 && $act!='nome'){
                    $nomeCompleto .=mb_strtoupper(substr($str,0,1),'utf-8').'. ';
                    goto s;
                }elseif(($x==2||$x==4)&&$str!='de'&&$str!='da'&&$str!='do'&&$str!='dos' && $act!='nome'){
                    $nomeCompleto .=mb_strtoupper(substr($str,0,1),'utf-8').'. ';
                    goto s;
                }
            }elseif(count($sobrenome)>5){
                if(($x==3||$x==4) && strlen($str)>3 && $act!="nome"){
                    $nomeCompleto .=mb_strtoupper(substr($str,0,1),'utf-8').'. ';
                    goto s;
                }
            }elseif(strlen($string)>27){
                if(($x==2||$x==2) && strlen($str)>3){
                    $nomeCompleto .=mb_strtoupper(substr($str,0,1),'utf-8').'. ';
                    goto s;
                }                
            }
            if(strtolower($str) != 'das' && strtolower($str) != 'da' && strtolower($str) != 'de' && strtolower($str) != 'do' && strtolower($str) != 'dos'){
                $nomeCompleto .=ucfirst($str).' ';
            }else{
                $nomeCompleto .=$str.' ';
            }
            s:
            $x++;
        }
        return trim($nomeCompleto);
    }
    public static function logradouro($string){
        switch(strtolower($string)){
           case 'rua':
               $string='R.';
               break;
           case 'avenida':
               $string='Av.';
               break;
           case 'travessa':
               $string='Trv.';
               break;
           case 'alameda':
               $string='Al.';
               break;
           case 'area':
               $string='A.';
               break;
           case 'beco':
               $string='Bc.';
               break;
           case 'bloco':
               $string='Bl.';
               break;
           case 'campo':
               $string='Cpo.';
               break;
           case 'canal':
               $string='Can.';
               break;
           case 'condominio':
               $string='Cond.';
               break;
           case 'conjunto':
               $string='Cj.';
               break;
           case 'jardim':
               $string='Jd.';
               break;
           case 'parque':
               $string='Pq.';
               break;
           case 'casa':
               $string='Cs.';
               break;
           case 'fundos':
               $string='Fds.';
               break;
           default: 
               $string=$string;
        }
        return $string;
    }
    public static function funcao($string){
        switch($string){
            case 'aventino quintino da silva':
                $funcao='Pastor';
                break;
            default:
                $funcao='Membro';
                break;
        }
        return $funcao;
    }
    public static function membroDesde($data){
        if($data < "2014-04-07"){
            $data='2014-04-07';
        }
        return self::data($data);
    }
}
?>