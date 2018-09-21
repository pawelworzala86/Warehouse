<?php

namespace App;

$_POST = json_decode(file_get_contents('php://input'), true);

require_once('Autoload.php');

use App\Modules\Other\Model\SetupModel;

new SetupModel;

new ExceptionHandler;

global $route;
global $r;
$route = [];

IP::getId();
new Session;

use App\User;
User::setId(1);
use App\Company;
Company::setId(1);
use App\Werhouse;
Werhouse::setId(1);

if (User::getId() === null) {
    Router::get('/api/', Modules\Other\Controller\IndexFront::class);
    Router::get('/api/logowanie', Modules\User\Controller\Login::class);
    Router::get('/api/rejestracja', Modules\User\Controller\Register::class);
    Router::get('/api/zarejestrowano', Modules\User\Controller\AfterRegister::class);
    Router::get('/api/aktywuj-konto', Modules\User\Controller\ActiveInfo::class);
    Router::get('/api/konto/aktywacja/:id', Modules\User\Controller\Activate::class);
    Router::get('/api/konto/usuniecie/:id', Modules\User\Controller\Deactivate::class);
    Router::get('/api/blog', Modules\Other\Controller\Blog::class);
    Router::get('/api/blog/:id', Modules\Other\Controller\BlogDetail::class);
    Router::get('/api/strona/:id', Modules\Other\Controller\Page::class);
    new Page404;
}

if (User::getSuperAdmin() === 1) {
    Router::get('/api/wyloguj', Modules\User\Controller\Logout::class);
    new Page404;
}





require_once('Class/Modules/Contractor/Route.php');
//exit;

Router::get('/api/test', Modules\Other\Controller\Test::class);









Router::get('/api/', Modules\Other\Controller\Index::class);
Router::get('/api/wyloguj', Modules\User\Controller\Logout::class);

Router::get('/api/produkty', Modules\Product\Controller\Products::class, 'product-list');
Router::get('/api/produkty/:page', Modules\Product\Controller\Products::class, 'product-list');
Router::get('/api/produkt/dodaj', Modules\Product\Controller\Product::class, 'product-edit');
Router::get('/api/katalog', Modules\Product\Controller\Catalog::class);
Router::get('/api/produkt/:id/edytuj', Modules\Product\Controller\Product::class, 'product-edit');
Router::get('/api/produkt/:id/szczegoly', Modules\Product\Controller\ProductDetailPage::class);

Router::get('/api/magazyn', Modules\Werhouse\Controller\Werhouse::class, 'werhouse-list');
Router::get('/api/magazyn/przyjecie', Modules\Werhouse\Controller\WerhouseAdd::class, 'werhouse-add');
Router::get('/api/magazyn/wydanie', Modules\Werhouse\Controller\WerhouseDec::class, 'werhouse-dec');
Router::get('/api/magazyn/sprzedaz', Modules\Werhouse\Controller\WerhouseSell::class);
Router::get('/api/magazyn/dodaj', Modules\Werhouse\Controller\AddWerhouse::class);
Router::get('/api/magazyn/:id/edytuj', Modules\Werhouse\Controller\AddWerhouse::class);
Router::get('/api/magazyny', Modules\Werhouse\Controller\Werhouses::class);
Router::get('/api/magazyn/:page', Modules\Werhouse\Controller\Werhouse::class, 'werhouse-list');
Router::get('/api/rezerwacje', Modules\Werhouse\Controller\Reservations::class);
Router::get('/api/rezerwacja/dodaj', Modules\Werhouse\Controller\Reservation::class);

Router::get('/api/dokumenty', Modules\Document\Controller\Documents::class, 'document-list');
Router::get('/api/dokumenty/:id', Modules\Document\Controller\Documents::class, 'document-list');

Router::get('/api/produkcje', Modules\Production\Controller\Productions::class, 'production-list');
Router::get('/api/produkcja/dodaj', Modules\Production\Controller\Production::class, 'production-edit');
Router::get('/api/produkcja/:id/edytuj', Modules\Production\Controller\Production::class, 'production-edit');
Router::get('/api/produkcja/:id/zuzycie', Modules\Production\Controller\ProductionOutCome::class, 'production-outcome');
Router::get('/api/produkcja/:id/wyprodukowano', Modules\Production\Controller\ProductionInCome::class, 'production-income');
Router::get('/api/produkcja/:id/pracownicy', Modules\Production\Controller\ProductionWorkers::class, 'production-worker');
Router::get('/api/produkcja/:id/dzien', Modules\Production\Controller\ProductionDay::class);
Router::get('/api/produkcja/:id/dni', Modules\Production\Controller\ProductionDays::class);

Router::get('/api/pracownicy', Modules\Worker\Controller\Workers::class, 'worker-list');
Router::get('/api/pracownicy/:page', Modules\Worker\Controller\Workers::class, 'worker-list');
Router::get('/api/pracownik/dodaj', Modules\Worker\Controller\Worker::class, 'worker-edit');
Router::get('/api/pracownik/:id/edytuj', Modules\Worker\Controller\Worker::class, 'worker-edit');

Router::get('/api/drukuj/:id', Modules\Other\Controller\PrintDocument::class, 'document-print');

Router::get('/api/statystyki', Modules\Stat\Controller\Stat::class);
Router::get('/api/statystyki/produkty/zakup', Modules\Stat\Controller\StatProductBuy::class);
Router::get('/api/statystyki/produkty/zakup/:id', Modules\Stat\Controller\StatProductBuy::class);

Router::get('/api/ustawienia', Modules\Setting\Controller\Setting::class);
Router::get('/api/ustawienia/adres', Modules\Setting\Controller\SettingAddress::class);
Router::get('/api/ustawienia/rozne', Modules\Setting\Controller\SettingOther::class);

Router::get('/api/catalog/:id', Modules\Product\Controller\CatalogAjax::class);
Router::get('/api/send', Modules\Other\Controller\Send::class);
Router::get('/api/products', Modules\Product\Controller\ProductsFind::class);
Router::get('/api/contractors', Modules\Contractor\Controller\ContractorsFind::class);
Router::get('/api/workers', Modules\Worker\Controller\WorkersFind::class);
Router::get('/api/document/detail/:id', Modules\Document\Controller\DocumentDetail::class);
Router::get('/api/product/file/delete', Modules\Product\Controller\ProductImageDelete::class);
Router::get('/api/werhouse/:id/switch', Modules\Werhouse\Controller\WerhouseSwitch::class, 'werhouse-list');

Router::get('/api/demo', Modules\Other\Controller\Demo::class);

//new Page404;

/*foreach($route as $r){
    print_r($r);

    echo '</br>';
}
file_put_contents('route.js', 'var routes = '.json_encode($route, JSON_PRETTY_PRINT).';');*/
