<?php
/*
** parte de rotas do sistema desenvolvido pela upinside
*/

use CoffeeCode\Router\Router;

$router = new Router(BASE_URL);

$router->namespace('\App\Controllers');
$router->get('/', 'HomeController:index');
$router->get('/carrinho', 'CartController:index');
$router->post('/carrinho', 'CartController:deleteAProductFromCart');
$router->post('/carrinho/busca', 'CartController:search');
$router->get('/produtos', 'ProductsController:index');
$router->post('/produtos', 'ProductsController:getProducts');
$router->get('/detalhes/{id}', 'DetailsController:index');
$router->get('/carrinho/busca', 'DetailsController:search');
$router->get('/checkout', 'CheckOutController:index');
$router->get('/cadastro', 'CadastroController:index');
$router->post('/cadastro', 'CadastroController:index');
$router->post('/rates', 'RatesController:store');
$router->post('/coupons', 'CouponsController:verifyCoupon');
$router->get('/login', 'LoginController:index');
$router->post('/login', 'LoginController:verify');
$router->get('/cadastro', 'RegistrationController:index');
$router->post('/cadastro', 'RegistrationController:verify');
$router->get('/logout', 'LogoutController:index');

//chamado a função
$router->dispatch();

if ($router->error()) {
  $router->redirect('/');
}
