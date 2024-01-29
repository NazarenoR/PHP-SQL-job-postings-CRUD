<?php

require __DIR__. '/vendor/autoload.php';

use \App\Entity\Listing;

$listings = Listing::getListings();

include __DIR__. '/includes/header.php';
include __DIR__. '/includes/joblist.php';
include __DIR__. '/includes/footer.php';