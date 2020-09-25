<?php
    class Padronizacao{

        /*
        CRIPTOGRAFANDO SENHAS
        */
        public static function criptografarSenhas($senhas){
            return sha1($senha);
        }

        /*
        public static function juntarNomeESobreNome($input, $sobreNome){
            $nomes = array($input, $sobreNome);
            $juntar = implode(" ", $nomes);
            return $juntar;
        }
        */

        public static function padronizandoNome($input){
            return ucwords(strtolower($input));
        }
    }