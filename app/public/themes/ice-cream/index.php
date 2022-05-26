<?php

  $context = \Timber\Timber::context();
  $context['menu']  = new Timber\Menu();
  $context['page']  = \Timber\Timber::get_post();
  \Timber\Timber::render('pages/index.twig', $context);
