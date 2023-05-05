<?php // routes/breadcrumbs.php

use App\Models\Customers;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


Breadcrumbs::for('customers.index', function (BreadcrumbTrail $trail) {
    $trail->push('Customers', route('customers.index'));
});

// Photos > Upload Photo
Breadcrumbs::for('customers.create', function (BreadcrumbTrail $trail) {
    $trail->parent('customers.index');
    $trail->push('Tambah Data', route('customers.create'));
});

// Photos > [Photo Name]
Breadcrumbs::for('customers.show', function (BreadcrumbTrail $trail, Customers $customers) {
    $trail->parent('customers.index');
    $trail->push($customers->name, route('customers.show', $customers->id));
});

// Photos > [Photo Name] > Edit Photo
Breadcrumbs::for('customers.edit', function (BreadcrumbTrail $trail, Customers $customers) {
    $trail->parent('customers.show', $customers);
    $trail->push('Edit Photo', route('customers.edit', $customers));
});