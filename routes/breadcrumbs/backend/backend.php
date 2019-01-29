<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

Breadcrumbs::for('admin.phan-tich-moi', function ($trail) {
    $trail->push(__('strings.backend.dashboard.phan-tich-moi'), route('admin.phan-tich-moi'));
});

Breadcrumbs::for('admin.phan-tich', function ($trail) {
    $trail->push(__('strings.backend.dashboard.phan-tich'), route('admin.phan-tich'));
});

Breadcrumbs::for('admin.ds-phan-tich', function ($trail) {
    $trail->push(__('strings.backend.dashboard.ds-phan-tich'), route('admin.ds-phan-tich'));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';
