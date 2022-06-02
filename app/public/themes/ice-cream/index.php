<?php

  $context = \Timber\Timber::context();
  $context['menu']  = new Timber\Menu('Navigation principale');
  $context['menu_footer']  = new Timber\Menu('Navigation footer');
  $context['page']  = \Timber\Timber::get_post();
  \Timber\Timber::render('pages/index.twig', $context);
