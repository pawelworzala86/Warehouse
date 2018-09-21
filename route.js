var routes = [
    {
        "url": "\/",
        "template": "\/Public\/Template\/Pl-pl\/Other\/Landing.html",
        "controller": "mainController"
    },
    {
        "url": "\/logowanie",
        "template": "\/Public\/Template\/Pl-pl\/User\/Login.html",
        "controller": "mainController"
    },
    {
        "url": "\/rejestracja",
        "template": "\/Public\/Template\/Pl-pl\/Register.html",
        "controller": "mainController"
    },
    {
        "url": "\/zarejestrowano",
        "template": "\/Public\/Template\/Pl-pl\/User\/AfterRegister.html",
        "controller": "mainController"
    },
    {
        "url": "\/aktywuj-konto",
        "template": "\/Public\/Template\/Pl-pl\/User\/ActiveInfo.html",
        "controller": "mainController"
    },
    {
        "url": "\/konto\/aktywacja\/:id",
        "template": "\/Public\/Template\/Pl-pl\/User\/Activate.html",
        "controller": "mainController"
    },
    {
        "url": "\/konto\/usuniecie\/:id",
        "template": "\/Public\/Template\/Pl-pl\/User\/Deactivate.html",
        "controller": "mainController"
    },
    {
        "url": "\/blog",
        "template": "\/Public\/Template\/Pl-pl\/Other\/Blog.html",
        "controller": "mainController"
    },
    {
        "url": "\/blog\/:id",
        "template": "\/Public\/Template\/Pl-pl\/Other\/BlogDetail.html",
        "controller": "mainController"
    },
    {
        "url": "\/strona\/:id",
        "template": "\/Public\/Template\/Pl-pl\/Other\/Page.html",
        "controller": "mainController"
    },
    {
        "url": "\/",
        "template": "\/Public\/Template\/Pl-pl\/Other\/Dashboard.html",
        "controller": "mainController"
    },
    {
        "url": "\/wyloguj",
        "template": "\/Public\/Template\/Pl-pl\/",
        "controller": "mainController"
    },
    {
        "url": "\/produkty",
        "template": "\/Public\/Template\/Pl-pl\/Product\/Products.html",
        "controller": "mainController"
    },
    {
        "url": "\/produkty\/:page",
        "template": "\/Public\/Template\/Pl-pl\/Product\/Products.html",
        "controller": "mainController"
    },
    {
        "url": "\/produkt\/dodaj",
        "template": "\/Public\/Template\/Pl-pl\/Product\/Product.html",
        "controller": "mainController"
    },
    {
        "url": "\/katalog",
        "template": "\/Public\/Template\/Pl-pl\/Product\/Catalog.html",
        "controller": "mainController"
    },
    {
        "url": "\/produkt\/:id\/edytuj",
        "template": "\/Public\/Template\/Pl-pl\/Product\/Product.html",
        "controller": "mainController"
    },
    {
        "url": "\/produkt\/:id\/szczegoly",
        "template": "\/Public\/Template\/Pl-pl\/Product\/ProductDetailPage.html",
        "controller": "mainController"
    },
    {
        "url": "\/magazyn",
        "template": "\/Public\/Template\/Pl-pl\/Werhouse\/Werhouse.html",
        "controller": "mainController"
    },
    {
        "url": "\/magazyn\/przyjecie",
        "template": "\/Public\/Template\/Pl-pl\/Werhouse\/WerhouseAdd.html",
        "controller": "werhouseAddController"
    },
    {
        "url": "\/magazyn\/wydanie",
        "template": "\/Public\/Template\/Pl-pl\/Werhouse\/WerhouseAdd.html",
        "controller": "werhouseAddController"
    },
    {
        "url": "\/magazyn\/sprzedaz",
        "template": "\/Public\/Template\/Pl-pl\/Werhouse\/WerhouseAdd.html",
        "controller": "werhouseAddController"
    },
    {
        "url": "\/magazyn\/dodaj",
        "template": "\/Public\/Template\/Pl-pl\/Werhouse\/AddWerhouse.html",
        "controller": "mainController"
    },
    {
        "url": "\/magazyn\/:id\/edytuj",
        "template": "\/Public\/Template\/Pl-pl\/Werhouse\/AddWerhouse.html",
        "controller": "mainController"
    },
    {
        "url": "\/magazyny",
        "template": "\/Public\/Template\/Pl-pl\/Werhouse\/Werhouses.html",
        "controller": "mainController"
    },
    {
        "url": "\/magazyn\/:page",
        "template": "\/Public\/Template\/Pl-pl\/Werhouse\/Werhouse.html",
        "controller": "mainController"
    },
    {
        "url": "\/rezerwacje",
        "template": "\/Public\/Template\/Pl-pl\/Werhouse\/Reservations.html",
        "controller": "mainController"
    },
    {
        "url": "\/rezerwacja\/dodaj",
        "template": "\/Public\/Template\/Pl-pl\/Werhouse\/WerhouseAdd.html",
        "controller": "werhouseAddController"
    },
    {
        "url": "\/dokumenty",
        "template": "\/Public\/Template\/Pl-pl\/Document\/Documents.html",
        "controller": "mainController"
    },
    {
        "url": "\/dokumenty\/:id",
        "template": "\/Public\/Template\/Pl-pl\/Document\/Documents.html",
        "controller": "mainController"
    },
    {
        "url": "\/produkcje",
        "template": "\/Public\/Template\/Pl-pl\/Production\/Productions.html",
        "controller": "mainController"
    },
    {
        "url": "\/produkcja\/dodaj",
        "template": "\/Public\/Template\/Pl-pl\/Production\/Production.html",
        "controller": "mainController"
    },
    {
        "url": "\/produkcja\/:id\/edytuj",
        "template": "\/Public\/Template\/Pl-pl\/Production\/Production.html",
        "controller": "mainController"
    },
    {
        "url": "\/produkcja\/:id\/zuzycie",
        "template": "\/Public\/Template\/Pl-pl\/Production\/ProductionOutCome.html",
        "controller": "mainController"
    },
    {
        "url": "\/produkcja\/:id\/wyprodukowano",
        "template": "\/Public\/Template\/Pl-pl\/Production\/ProductionOutCome.html",
        "controller": "mainController"
    },
    {
        "url": "\/produkcja\/:id\/pracownicy",
        "template": "\/Public\/Template\/Pl-pl\/Production\/ProductionWorkers.html",
        "controller": "mainController"
    },
    {
        "url": "\/produkcja\/:id\/dzien",
        "template": "\/Public\/Template\/Pl-pl\/Production\/ProductionDay.html",
        "controller": "mainController"
    },
    {
        "url": "\/produkcja\/:id\/dni",
        "template": "\/Public\/Template\/Pl-pl\/Production\/ProductionDays.html",
        "controller": "mainController"
    },
    {
        "url": "\/windykacja",
        "template": "\/Public\/Template\/Pl-pl\/Contractor\/Debts.html",
        "controller": "mainController"
    },
    {
        "url": "\/windykacja\/:",
        "template": "\/Public\/Template\/Pl-pl\/Contractor\/Debts.html",
        "controller": "mainController"
    },
    {
        "url": "\/kontrahenci",
        "template": "\/Public\/Template\/Pl-pl\/Contractor\/Contractors.html",
        "controller": "mainController"
    },
    {
        "url": "\/kontrahenci\/:page",
        "template": "\/Public\/Template\/Pl-pl\/Contractor\/Contractors.html",
        "controller": "mainController"
    },
    {
        "url": "\/kontrahent\/dodaj",
        "template": "\/Public\/Template\/Pl-pl\/Contractor\/Contractor.html",
        "controller": "mainController"
    },
    {
        "url": "\/kontrahent\/:id\/edytuj",
        "template": "\/Public\/Template\/Pl-pl\/Contractor\/Contractor.html",
        "controller": "mainController"
    },
    {
        "url": "\/pracownicy",
        "template": "\/Public\/Template\/Pl-pl\/Worker\/Workers.html",
        "controller": "mainController"
    },
    {
        "url": "\/pracownicy\/:page",
        "template": "\/Public\/Template\/Pl-pl\/Worker\/Workers.html",
        "controller": "mainController"
    },
    {
        "url": "\/pracownik\/dodaj",
        "template": "\/Public\/Template\/Pl-pl\/Worker\/Worker.html",
        "controller": "mainController"
    },
    {
        "url": "\/pracownik\/:id\/edytuj",
        "template": "\/Public\/Template\/Pl-pl\/Worker\/Worker.html",
        "controller": "mainController"
    },
    {
        "url": "\/drukuj\/:id",
        "template": "\/Public\/Template\/Pl-pl\/",
        "controller": "mainController"
    },
    {
        "url": "\/statystyki",
        "template": "\/Public\/Template\/Pl-pl\/Stat\/Stat.html",
        "controller": "mainController"
    },
    {
        "url": "\/statystyki\/produkty\/zakup",
        "template": "\/Public\/Template\/Pl-pl\/Stat\/ProductBuy.html",
        "controller": "mainController"
    },
    {
        "url": "\/statystyki\/produkty\/zakup\/:id",
        "template": "\/Public\/Template\/Pl-pl\/Stat\/ProductBuy.html",
        "controller": "mainController"
    },
    {
        "url": "\/ustawienia",
        "template": "\/Public\/Template\/Pl-pl\/Setting\/Setting.html",
        "controller": "mainController"
    },
    {
        "url": "\/ustawienia\/adres",
        "template": "\/Public\/Template\/Pl-pl\/Setting\/Address.html",
        "controller": "mainController"
    },
    {
        "url": "\/ustawienia\/rozne",
        "template": "\/Public\/Template\/Pl-pl\/Setting\/Other.html",
        "controller": "mainController"
    },
    {
        "url": "\/catalog\/:id",
        "template": "\/Public\/Template\/Pl-pl\/",
        "controller": "mainController"
    },
    {
        "url": "\/send",
        "template": "\/Public\/Template\/Pl-pl\/Product.html",
        "controller": "mainController"
    },
    {
        "url": "\/products",
        "template": "\/Public\/Template\/Pl-pl\/",
        "controller": "mainController"
    },
    {
        "url": "\/contractors",
        "template": "\/Public\/Template\/Pl-pl\/",
        "controller": "mainController"
    },
    {
        "url": "\/workers",
        "template": "\/Public\/Template\/Pl-pl\/",
        "controller": "mainController"
    },
    {
        "url": "\/document\/detail\/:id",
        "template": "\/Public\/Template\/Pl-pl\/Document\/DocumentDetail.html",
        "controller": "mainController"
    },
    {
        "url": "\/product\/file\/delete",
        "template": "\/Public\/Template\/Pl-pl\/",
        "controller": "mainController"
    },
    {
        "url": "\/werhouse\/:id\/switch",
        "template": "\/Public\/Template\/Pl-pl\/",
        "controller": "mainController"
    },
    {
        "url": "\/demo",
        "template": "\/Public\/Template\/Pl-pl\/",
        "controller": "mainController"
    }
];