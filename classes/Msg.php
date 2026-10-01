<?php

class Msg 
{
    /**
     * Exibe um modal de aviso (Warning)
     */
    public static function aviso($texto, $titulo = 'Atenção!')
    {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: '{$titulo}',
                text: '{$texto}',
                confirmButtonColor: '#f39c12'
            });
        </script>";
    }

    /**
     * Exibe um modal de sucesso (Success)
     */
    public static function sucesso($texto, $titulo = 'Sucesso!')
    {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: '{$titulo}',
                text: '{$texto}',
                confirmButtonColor: '#28a745'
            });
        </script>";
    }

    /**
     * Exibe um modal de erro (Error)
     */
    public static function erro($texto, $titulo = 'Ops...')
    {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: '{$titulo}',
                text: '{$texto}',
                confirmButtonColor: '#d33'
            });
        </script>";
    }
}