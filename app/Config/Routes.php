<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/produk', 'Produk::index');
$routes->get('/produk/tampil', 'Produk::tampil_produk');
$routes->post('/produk/simpan', 'Produk::simpan_produk');
$routes->post('/produk/hapus', 'Produk::hapus');
$routes->get('produk/get_produk_by_id', 'Produk::get_produk_by_id');
$routes->post('produk/update_produk', 'Produk::update_produk');

$routes->get('/pelanggan', 'Pelanggan::index');
$routes->get('/pelanggan/tampil', 'Pelanggan::tampil_pelanggan');
$routes->post('/pelanggan/simpan', 'Pelanggan::simpan_pelanggan');
$routes->post('/pelanggan/hapus', 'Pelanggan::hapus');
$routes->get('pelanggan/get_pelanggan_by_id', 'Pelanggan::get_pelanggan_by_id');
$routes->post('produk/update_pelanggan', 'Pelanggan::update_pelanggan');