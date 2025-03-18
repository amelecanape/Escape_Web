<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

use App\Controllers\Accueil;
$routes->get('/', [Accueil::class, 'afficher']);
$routes->get('/test', [Accueil::class, 'test']);
$routes->get('accueil/afficher', [Accueil::class, 'afficher']);
$routes->get('accueil/afficher/(:segment)', [Accueil::class, 'afficher']);

use App\Controllers\Compte;
$routes->get('compte/lister', [Compte::class, 'lister']);
$routes->get('compte/creer', [Compte::class, 'creer']);
$routes->post('compte/creer', [Compte::class, 'creer']);
$routes->get('compte/connecter', [Compte::class, 'connecter']);
$routes->post('compte/connecter', [Compte::class, 'connecter']);
$routes->get('compte/profil', [Compte::class, 'afficher_profil']);
$routes->get('compte/deconnexion', [Compte::class, 'deconnecter']);
$routes->get('compte/changermotdepasse', [Compte::class, 'changermotdepasse']);
$routes->post('compte/changermotdepasse', [Compte::class, 'changermotdepasse']);

use App\Controllers\Actualite;
$routes->get('actualite/afficher', [Actualite::class, 'afficher']);
$routes->get('actualite/afficher/(:num)', [Actualite::class, 'afficher']);

use App\Controllers\Scenario;
$routes->get('scenario', [Scenario::class, 'afficher']);
$routes->get('scenario/jouer/', [Scenario::class, 'afficher']);
$routes->get('scenario/jouer/(:segment)/', [Scenario::class, 'jouer']);
$routes->post('scenario/jouer/(:segment)/', [Scenario::class, 'jouer']);
$routes->get('scenario/jouer/(:segment)/(:num)', [Scenario::class, 'jouer']);
$routes->post('scenario/jouer/(:segment)/(:num)', [Scenario::class, 'jouer']);

$routes->get('scenario/franchir/', [Scenario::class, 'afficher']);
$routes->get('scenario/franchir/(:segment)/', [Scenario::class, 'franchir_etape']);
$routes->post('scenario/franchir/(:segment)/', [Scenario::class, 'franchir_etape']);
$routes->get('scenario/franchir/(:segment)/(:num)', [Scenario::class, 'franchir_etape']);
$routes->post('scenario/franchir/(:segment)/(:num)', [Scenario::class, 'franchir_etape']);

$routes->get('scenario/lister', [Scenario::class, 'lister']);
$routes->get('scenario/visualiser/(:segment)', [Scenario::class, 'visualiser']);
$routes->get('scenario/creer', [Scenario::class, 'creer']);
$routes->post('scenario/creer', [Scenario::class, 'creer']);
$routes->get('scenario/supprimer/(:segment)', [Scenario::class, 'supprimer']);
$routes->post('scenario/supprimer/(:segment)', [Scenario::class, 'supprimer']);

use App\Controllers\Victoire;
$routes->post('scenario/finir/(:num)/(:num)', [Victoire::class, 'finir']);

