<?php 

class Valida
{
    private $name;
    private $email;
    // private $password;
    // private $passwordC;
    // private $CPF;

    public function __construct($name, $email, $CPF)
    {
        $this->name = $name;
        $this->email = $email;
        
        if($this->validaCPF($CPF))
        {
            $this->CPF = $CPF;
        }
        
     
    }

    public function Validar()
    {
        $name = $this->name;
        $email = $this->email;
        
        try{
            if(strstr($name, " ") || (strstr($email, " "))){
                throw new \Exception('<h1>ERROR: Nome , E-mail não podem conter espaço!</h1><br />');
            }else{
            
            }
        }catch(Exception $g){
            echo $g->getMessage();
            die();
        }
    
        try{
            if(is_numeric($name)){
                throw new \Exception('<h1>ERROR: Nome não pode conter numeros!</h1><br />');
            }else{
                
            }
        }catch(Exception $g){
            echo $g->getMessage();
            die();
        }
    
        try{
            if(strlen($name) > 12){
                throw new \Exception('<h1>ERROR: nome não pode ter comprimento maior que 12 caracteres!</h1><br />');
            }else{
            
            }
        }catch(Exception $g){
            echo $g->getMessage();
            die();
        }
    
        try{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                throw new \Exception('<h1>ERROR: Email não é valido!</h1><br />');
            }else{
            
            }
        }catch(Exception $g){
            echo $g->getMessage();
            die();
        }
    
    }

    public function validaCPF($cpf)
    {

        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        if (strlen($cpf) != 11) {
            return false;
        } else if ($cpf == '00000000000' || 
            $cpf == '11111111111' || 
            $cpf == '22222222222' || 
            $cpf == '33333333333' || 
            $cpf == '44444444444' || 
            $cpf == '55555555555' || 
            $cpf == '66666666666' || 
            $cpf == '77777777777' || 
            $cpf == '88888888888' || 
            $cpf == '99999999999')
            {
                return false;
            } else {
                $val1= $cpf[0] * 10 + $cpf[1] * 9 + $cpf[2] * 8 + $cpf[3] * 7 + $cpf[4] * 6 + $cpf[5] * 5 + $cpf[6] * 4 + $cpf[7] * 3 + $cpf[8] * 2;
                //print_r($val1);
                $val1 = $val1 * 10 % 11;
                //print_r($val1);
                

                $val2= $cpf[0] * 11 + $cpf[1] * 10 + $cpf[2] * 9 + $cpf[3] * 8 + $cpf[4] * 7 + $cpf[5] * 6 + $cpf[6] * 5 + $cpf[7] * 4 + $cpf[8] * 3 + $cpf[9] * 2;
                
                $val2 = $val2 * 10 % 11;
                
                //print_r($val1);
                //print_r($cpf[9]);
                if ($val1 == $cpf[9])
                {
                    //print_r("VAL1 É TRUE");
                    $val1 = true;
                }else{
                    //print_r("VAL1 É FALSE");
                    $val1 = false;
                }

                if ($val2 == $cpf[10])
                {
                    $val2 = true;
                }else {
                    $val2 = false;
                }

                if ($val1 == true && $val2 == true)
                {
                    //print_r("PASSEI NA CONDIÇAO");
                    return true;
                }else {
                    return false;
                }

            
            }
    }
}