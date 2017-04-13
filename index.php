<?php 

use App\Database\Database as Database;
use App\Filters\OptionFilter as OptionFilter;
use App\Filters\PaginationFilter as PaginationFilter;

/**
 * load autoload.php
 */
require_once __DIR__ . '/vendor/autoload.php';


/**
 * create new instance of Database
 */
$database = new Database();


/**
 * create new instance of Filter
 */
$filter = new OptionFilter($database);


/**
 * create new instance of Paginator
 */
$paginator = new PaginationFilter();


/**
 * load view form.php
 */
require 'public/views/form.php';