<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class Page extends Controller
{
  // queue data structure
  public function sec_standard() {
    return get_field('page_content');
  }
}
