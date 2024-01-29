<?php

require __DIR__. '/vendor/autoload.php';

define('TITLE', 'Edit job ad');

use \App\Entity\Listing;

//VALIDATION OF THE LISTING ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

//GET LISTING
$obListing = Listing::getListing($_GET['id']);


//VALIDATION OF THE LISTING
if(!$obListing instanceof Listing){
    header('location: index.php?status=error');
    exit;
}

//echo "<pre>"; print_r($obListing); echo "</pre>"; exit;

//POST validation
if(isset($_POST['title'], $_POST['description'], $_POST['active'])) {
    
    $obListing->title       = $_POST['title'];
    $obListing->description = $_POST['description'];
    $obListing->active      = $_POST['active'];
    $obListing->updateListing();

    header('location: index.php?status=success');
    exit;


}

include __DIR__. '/includes/header.php';
include __DIR__. '/includes/form.php';
include __DIR__. '/includes/footer.php';