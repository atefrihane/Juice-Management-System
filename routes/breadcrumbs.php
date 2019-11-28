<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Liste des societés', route('showHome'));
});



Breadcrumbs::for('static', function ($trail) {
    $trail->parent('home');
    $trail->push('Gestion des constantes', route('showStaticManagement'));
});

Breadcrumbs::for('addCountry', function ($trail) {
    $trail->parent('static');
    $trail->push('Ajouter un pays', route('showAddCountry'));
});

Breadcrumbs::for('updateCountry', function ($trail,$country) {
    $trail->parent('static');
    $trail->push('Modifier un pays', route('showAddCountry'));
    $trail->push($country);
});



// Home > Societé
Breadcrumbs::for('company', function ($trail) {
    $trail->parent('home');
    $trail->push('Ajouter une societé', route('showAddCompany'));
});
Breadcrumbs::for('editCompany', function ($trail,$company) {
    $trail->parent('home');
    $trail->push('Modifier une societé', route('editCompany',$company));
    $trail->push($company->designation);
});
// Home
Breadcrumbs::for('admin', function ($trail) {
    $trail->push('Liste des admins', route('admin'));
});

// Home > Societé
Breadcrumbs::for('addAdmin', function ($trail) {
    $trail->parent('admin');
    $trail->push('Ajouter un admin', route('addAdmin'));
});
// Home > Societé
Breadcrumbs::for('editAdmin', function ($trail) {
    $trail->parent('admin');
    $trail->push('Modifier un admin', route('editAdmin', ''));
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

Breadcrumbs::for('editStore', function ($trail, $company) {
    $trail->parent('store', $company);
    $trail->push('Modifier  magasin', route('showStores', $company));
});

Breadcrumbs::for('detailStore', function ($trail,$company,$store) {
    $trail->parent('store',$company);
    $trail->push($store);
});

Breadcrumbs::for('detailStoreMachines', function ($trail,$company,$store) {
    $trail->parent('store',$company);
    $trail->push($store);
    $trail->push('Machines en location');
});

Breadcrumbs::for('storeStock', function ($trail,$company,$store) {
    $trail->parent('detailStore',$company,$store);
    $trail->push('Liste des produits en stock');

});
Breadcrumbs::for('addStoreStock', function ($trail,$company,$store) {
    $trail->parent('storeStock',$company,$store);
    $trail->push('Ajouter un produit en stock');

});
Breadcrumbs::for('updateStoreStock', function ($trail,$company,$store) {
    $trail->parent('storeStock',$company,$store);
    $trail->push('Modifier un produit en stock');

});

Breadcrumbs::for('contact', function ($trail, $company) {
    $trail->parent('detail', $company);
    $trail->push('Contacts', route('showContacts', $company));
});

Breadcrumbs::for('addContact', function ($trail, $company) {
    $trail->parent('contact', $company);
    $trail->push('Ajouter un contact', route('showAddContact', $company));
});

Breadcrumbs::for('showContact', function ($trail, $company,$user) {
    $trail->parent('contact', $company);
    $trail->push(ucfirst($user->nom).' '.ucfirst($user->prenom));
});
Breadcrumbs::for('order', function ($trail) {
    $trail->push('Liste des commandes', route('showOrders'));
});

Breadcrumbs::for('archive', function ($trail) {
    $trail->parent('order');
    $trail->push('Archives');
});
Breadcrumbs::for('addOrder', function ($trail) {
    $trail->parent('order');
    $trail->push('Ajouter une commande', route('showOrders'));
});

Breadcrumbs::for('showOrder', function ($trail,$order) {
    $trail->parent('order');
    $trail->push('Commande');
    $trail->push($order->code);
});

Breadcrumbs::for('showUpdateStatusOrder', function ($trail,$order) {
    $trail->parent('order');
    $trail->push('Commande');
    $trail->push($order->code);
});



Breadcrumbs::for('updateOrder', function ($trail,$order) {
    $trail->parent('order');
    $trail->push('Modifier une commande');
    $trail->push($order->code);
});

Breadcrumbs::for('machine', function ($trail) {

    $trail->push('Liste des machines', route('showMachines'));
});
Breadcrumbs::for('rental', function ($trail, $machine) {
    $trail->parent('machine');
    $trail->push('Commencer location machine', route('startRental', $machine));
});
Breadcrumbs::for('addMachine', function ($trail) {
    $trail->parent('machine');
    $trail->push('Ajouter une  machine', route('showAddMachine'));
});

Breadcrumbs::for('editMachine', function ($trail) {
    $trail->parent('machine');
    $trail->push('Modifier une  machine');
});

Breadcrumbs::for('detailRentMachine', function ($trail,$rent) {
    $trail->push('Détail location machine');
    $trail->push($rent);
});
Breadcrumbs::for('detailEditMachine', function ($trail,$rent) {
    $trail->push('Détail modification location machine');
    $trail->push($rent);
});


Breadcrumbs::for('endRental', function ($trail) {
    $trail->parent('machine');
    $trail->push('Arrêter location machine');
});


Breadcrumbs::for('historyMachine', function ($trail,$machine) {
    $trail->parent('machine');
    $trail->push($machine);
    $trail->push('Historique des locations');

});
Breadcrumbs::for('editMachineState', function ($trail) {
    $trail->parent('machine');
    $trail->push('Mise à jour état machine');
});

Breadcrumbs::for('machineHistory', function ($trail,$machine) {
    $trail->parent('machine');
    $trail->push($machine->code);
    $trail->push('Détails machine');
});


Breadcrumbs::for('product', function ($trail) {

    $trail->push('Liste des produits', route('showProducts'));
});

Breadcrumbs::for('addProduct', function ($trail) {
    $trail->parent('product');
    $trail->push('Ajouter un produit', route('showAddProduct'));
});

Breadcrumbs::for('editProduct', function ($trail,$product) {
    $trail->parent('product');
    $trail->push('Modifier un produit', route('editProduct',$product->id));
    $trail->push($product->nom);
});

Breadcrumbs::for('rentedMachine', function ($trail, $company) {
    $trail->parent('detail', $company);
    $trail->push('Liste des machines en location ', route('showRentedMachines', $company));
});

Breadcrumbs::for('customProduct', function ($trail, $company) {
    $trail->parent('detail', $company);
    $trail->push('Tarif societé -Liste de produits ', route('showCustomProducts', $company));
});

Breadcrumbs::for('addCustomProduct', function ($trail, $company) {
    $trail->parent('customProduct', $company);
    $trail->push('Ajouter un produit au tarif ', route('showRentedMachines', $company));
});

Breadcrumbs::for('productWarehouse', function ($trail) {
    $trail->push('Liste des produits en stock', route('showWarehouseProducts'));
});

Breadcrumbs::for('productQuantity', function ($trail) {
    $trail->parent('productWarehouse');
    $trail->push('Ajouter une Entrée en stock', route('showAddProductQuantity'));
});

Breadcrumbs::for('productQuantityEdit', function ($trail) {
    $trail->parent('productWarehouse');
    $trail->push('Modifier une entrée', route('showAddProductQuantity'));
});
Breadcrumbs::for('warhouses', function ($trail) {
    $trail->push('Liste des entrepôts', route('showWarehouses'));
});
Breadcrumbs::for('warhouse', function ($trail,$warehouse) {
    $trail->push('Liste des entrepôts', route('showWarehouses'));
    $trail->push($warehouse);
});
Breadcrumbs::for('addWarhouse', function ($trail) {
    $trail->parent('warhouses');
    $trail->push('Ajouter un entrepôt', route('showAddWarehouse'));
});

Breadcrumbs::for('updateWarhouse', function ($trail) {
    $trail->parent('warhouses');
    $trail->push('Modifier un entrepôt', route('showAddWarehouse'));
});

