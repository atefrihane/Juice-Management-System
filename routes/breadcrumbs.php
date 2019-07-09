<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Liste des societés', route('showHome'));
});

// Home > Societé
Breadcrumbs::for('company', function ($trail) {
    $trail->parent('home');
    $trail->push('Ajouter une societé', route('showAddCompany'));
});

Breadcrumbs::for('detail', function ($trail, $company) {
    $trail->parent('home');
    $trail->push($company->name, route('showHome', $company));
});

Breadcrumbs::for('store', function ($trail, $company) {
    $trail->parent('detail', $company);
    $trail->push('Magasins', route('showStores', $company));
});

Breadcrumbs::for('addStore', function ($trail, $company) {
    $trail->parent('store', $company);
    $trail->push('Ajouter un magasin', route('showStores', $company));
});

Breadcrumbs::for('contact', function ($trail, $company) {
    $trail->parent('detail', $company);
    $trail->push('Contacts', route('showContacts', $company));
});

Breadcrumbs::for('addContact', function ($trail, $company) {
    $trail->parent('contact', $company);
    $trail->push('Ajouter un contact', route('showAddContact', $company));
});

Breadcrumbs::for('order', function ($trail) {
    $trail->push('Liste des commandes', route('showOrders'));
});
Breadcrumbs::for('addOrder', function ($trail) {
    $trail->parent('order');
    $trail->push('Ajouter une commande', route('showOrders'));
});

Breadcrumbs::for('machine', function ($trail) {

    $trail->push('Liste des machines', route('showMachines'));
});
Breadcrumbs::for('addMachine', function ($trail) {
    $trail->parent('machine');
    $trail->push('Ajouter une  machine', route('showAddMachine'));
});


Breadcrumbs::for('product', function ($trail) {

    $trail->push('Liste des produits', route('showProducts'));
});


Breadcrumbs::for('addProduct', function ($trail) {
    $trail->parent('product');
    $trail->push('Ajouter un produit', route('showAddProduct'));
});


Breadcrumbs::for('rentedMachine', function ($trail, $company) {
    $trail->parent('detail', $company);
    $trail->push('Liste des machines en location ', route('showRentedMachines', $company));
});

Breadcrumbs::for('customProduct', function ($trail, $company) {
    $trail->parent('detail', $company);
    $trail->push('Tarif societé -Liste de produits ', route('showRentedMachines', $company));
});

Breadcrumbs::for('addCustomProduct', function ($trail, $company) {
    $trail->parent('customProduct', $company);
    $trail->push('Ajouter un produit ', route('showRentedMachines', $company));
});