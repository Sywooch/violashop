<?php
$this->title = $product['name'];
$this->params['breadcrumbs'][] = array(
    'label' => 'Каталог',  // required
    'url' => '/catalog' );
$this->params['breadcrumbs'][] = $this->title;

echo $product['name'];
echo $product['description'];