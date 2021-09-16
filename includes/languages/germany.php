<?php

function  lang($key){

  $val=array(

    "home"        =>"Startseite",
    "categories"  =>"Kategorien",
    "item"        =>"Artikel" ,
    "member"      =>"Mitglied",
    "statics"     =>"Statik",
    "logs"        =>"Logs",
    "user"        =>"Benutzer",
    "log out"     =>"Abmelden",
    "edit porfile"=>"Profil bearbeiten",
    "settings"    =>"Einstellung",
    "email_placeholder" =>"Geben Sie Ihr Email ein",
    "username_placeholder" =>"Geben Sie Ihr Name ein",
    "password_placeholder"=>"Geben Sie Ihr Password ein",
    "sign in"      =>"Anmelden",
    "Add"=>"Konto Hinzufügen",
);

return $val[$key];


}

?>