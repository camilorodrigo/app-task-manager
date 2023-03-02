<?php
namespace App\Libraries;
use DateTime;
/**
 * =========================================================================
 * BIBLIOTECA DE FUNÇÕES UTEIS E NECESSÁRIAS E REUTILIZADAS EM TODO CÓDIGO
 * =========================================================================
 **/

class GlobalFunctions {
    
    /**
     *
     * Função: Verifica se um determinado valor é inteiro
     * @return boolean  
     *
     * */
    public static function checkIfIsInteger($number): bool
    {
        if (is_int($number)) {
            return true;
        }

        return false;
    }
    /**
     *
     * Função: Converte texto para letras maiúsculas
     * @return string  
     *
     * */
    public static function changeTextToUppercase($text) 
    {
         
        $capitalText = mb_strtoupper($text,'utf-8');
        
        return $capitalText;

    }
    
    /**
     *
     * Função: Validação se e-mail é verdadeiro ou não em PHP 
     * @return boolean  
     *
     **/
    	public static function checksIfEmailIsValid($email): bool  {

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {

            return false;
        } else {

            /* 
              list($alias, $domain) = explode("@", $email);
              if (checkdnsrr($domain, "MX")) {

                    return true;

              }else{

                return false;

              } */

            return true;
        }
    }
    /**
     *
     * Função: Validar se data 1 é maior que data 2 
     * @return true ou false  
     *
     * */
    public static function checkIfDateIsGreaterThan($dateOne, $dateTwo) {
        
        if (strtotime($dateOne) > strtotime($dateTwo)) {    
            return true;            
        } else {
            return false;
        }             
    }
    
    /**
     *
     * Função: Validar data
     * @return int  
     *
     * */
    public static function checksIfDateIsValid($date, $formato = 'DD/MM/AAAA') {

        switch ($formato) {

            case 'DD-MM-AAAA':
            case 'DD/MM/AAAA':
                //list($day, $month, $year) = preg_split("/[-./ ]/", $date);
                list($day, $month, $year) = preg_split('/[-\.\/ ]/', $date);
            break;
            case 'AAAA/MM/DD':
            case 'AAAA-MM-DD':
                //list($year, $m, $day) = preg_split("/[-./ ]/", $date);
                list($year, $month, $day) = preg_split('/[-\.\/ ]/', $date);
            break;
            case 'AAAA/DD/MM':
            case 'AAAA-DD-MM':
                //list($year, $day, $month) = preg_split("/[-./ ]/", $date);
                list($year, $day, $month) = preg_split('/[-\.\/ ]/', $date);
            break;
            case 'MM-DD-AAAA':
            case 'MM/DD/AAAA':
                //list($month, $day, $year) = preg_split("/[-./ ]/", $date);
                list($month, $day, $year) = preg_split('/[-\.\/ ]/', $date);
            break;
            case 'AAAAMMDD':
                $year = substr($date, 0, 4);
                $month = substr($date, 4, 2);
                $day = substr($date, 6, 2);
            break;
            case 'AAAADDMM':
                $year = substr($date, 0, 4);
                $day = substr($date, 4, 2);
                $month = substr($date, 6, 2);
            break;
            default:
                return false;
            break;

        }

        if (strlen($year) > 4) {

            return false;

        } else {

            return checkdate($month, $day, $year);

        }

    }
    
}