<?php
finalclass Utils{ private function __construct(){} public static function createLink($page,array$params=array()){$params=array_merge(array('pagina'=>$page),$params);return '../web/index.php?'.http_build_query($params);} public static function formatDate(DateTime$date=null){if($date===null){return '';}return $date->format('Y-m-d');} public static function formatDateTime(DateTime$date=null){if($date===null){return '';}return $date->format('d/m/Y H:i');} public static function redirect($page,array$params=array()){header('Location: '.self::createLink($page,$params));die();} public static function getUrlParam($name){if(!array_key_exists($name,$_GET)){ throw new NotFoundException('URL parameter "'.$name.'" not found.');}return $_GET[$name];} public static function getTodoByGetId(){$id=null;try{$id=self::getUrlParam('id');}catch(Exception$ex){ throw new NotFoundException('No TODO identifier provided.');}if(!is_numeric($id)){ throw new NotFoundException('Invalid TODO identifier provided.');}$dao=new TodoDao();$todo=$dao->findById($id);if($todo===null){ throw new NotFoundException('Unknown TODO identifier provided.');}return $todo;} public static function capitalize($string){return ucfirst(mb_strtolower($string));} public static function escape($string){return htmlspecialchars($string,ENT_QUOTES);} public static function datafatura($str,$etapa=null){$str=date($str);$hoje=date('d/m/Y');if($etapa=='60'||$etapa=='70'){$cor='black';$msg='Faturado';}elseif($str<$hoje){$cor='red';$msg='Faturamento atrasado';}elseif($str==$hoje){$cor='green';$msg='Vence hoje';}elseif($str>$hoje){$cor='blue';$msg='Previsto para '.$str;}return $msg.','.$cor;}}?>