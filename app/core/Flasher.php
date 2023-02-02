<?php
class Flasher
{
    public static function setFlash($pesan,$aksi,$tipe)
    {
        $_SESSION['flash']=[
            'pesan'=>$pesan,
            'aksi'=>$aksi,
            'tipe'=>$tipe
        ];
    }
 public static function flash()
    {
        if(isset($_SESSION['flash']))
        {
            echo '<div class="alert alert-'.$_SESSION['flash']['tipe'] . ' alert-dismissible fade show" role="alert"> <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="'.$_SESSION['flash']['tipe'].':"><use xlink:href="#'.$_SESSION['flash']['tipe'].'-icon"/></svg>
                    <strong>' .$_SESSION['flash']['pesan'] . '</strong>' .$_SESSION['flash']['aksi'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        
                    </button>
                </div>';
                unset($_SESSION['flash']);
            }
        }
    }