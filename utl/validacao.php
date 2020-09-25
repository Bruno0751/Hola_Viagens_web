<?php
    class Validacao{

        /*
        PROTEGENDO CONTRA SQL INJECT
        */
        
        public static function antiXSS($input){
            return htmlspecialchars($input);
        }

        /*
        VALIDANDANDO ENTRADAS DE TEXTO ATRAVÉZ DE EXPRESÕES REGULARES
        */
        /*
        public static function validarNomeCompleto($nomeCompleto){
            $exp = "^[0-9]{0,}$";
            return preg_match($exp,$nomeCompleto);
          }
        */
        public static function validandoEmail($email){
            //echo filter_var($email,FILTER_VALIDATE_EMAIL) ? "" : "<scrip>window.alert('Email Inválido');</script>";
            if(filter_var($email,FILTER_VALIDATE_EMAIL)){


                echo "<script>window.alert('Email Válido');</script>";
            }else{
          

               echo "<script>window.alert('Email Válido');</script>"  ;
            }
        }
    }