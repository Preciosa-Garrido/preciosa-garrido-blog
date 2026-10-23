<?php

add_theme_support('post-thumbnails');

function register_my_menus(): void
{
    register_nav_menus([
        'header-menu' => __('Menu no topo', 'preciosagarrido'),
    ]);
}

add_action('init', 'register_my_menus');
