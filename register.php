<?php
//ADICIONAR IF ELSE PARA SUCCESS E SE OS CAMPOS NÃO ESTÃO VAZIOS

require __DIR__. '/vendor/autoload.php';

define('TITLE', 'Register job ad');

use \App\Entity\Listing;
$obListing = new Listing;

//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;

//POST validation
if(isset($_POST['title'], $_POST['description'], $_POST['active'])) {
    
    $obListing->title       = $_POST['title'];
    $obListing->description = $_POST['description'];
    $obListing->active      = $_POST['active'];
    $obListing->register();

    //echo "<pre>"; print_r($obListing); echo "</pre>"; exit;
    header('location: index.php?status=success');
    exit;


}

include __DIR__. '/includes/header.php';
include __DIR__. '/includes/form.php';
include __DIR__. '/includes/footer.php';