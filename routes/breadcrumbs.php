<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('guest.home.index'));
});

Breadcrumbs::for('news', function ($trail) {
    $trail->parent('home');
    $trail->push('News', route('guest.news.index'));
});

Breadcrumbs::for('news_details', function ($trail, $news) {
    $trail->parent('news');
    $trail->push($news->title, route('guest.news.details', $news->slug));
});


Breadcrumbs::for('announcement', function ($trail) {
    $trail->parent('home');
    $trail->push('Announcements', route('guest.announcement.index'));
});

Breadcrumbs::for('announcement_details', function ($trail, $announcement) {
    $trail->parent('announcement');
    $trail->push($announcement->title, route('guest.announcement.details', $announcement->slug));
});

Breadcrumbs::for('aboutUs_mandate', function ($trail) {
    $trail->parent('home');
    $trail->push('About Us - Mandate', route('guest.about_us.mandate'));
});

Breadcrumbs::for('aboutUs_services', function ($trail) {
    $trail->parent('home');
    $trail->push('About Us - Services', route('guest.about_us.services'));
});

Breadcrumbs::for('aboutUs_charter', function ($trail) {
    $trail->parent('home');
    $trail->push('About Us - Charter', route('guest.about_us.charter'));
});

Breadcrumbs::for('aboutUs_orgChart', function ($trail) {
    $trail->parent('home');
    $trail->push('About Us - Organizational Chart', route('guest.about_us.org_chart'));
});

Breadcrumbs::for('aboutUs_corpObjectives', function ($trail) {
    $trail->parent('home');
    $trail->push('About Us - Corporate Objectives', route('guest.about_us.corp_objectives'));
});

Breadcrumbs::for('aboutUs_history', function ($trail) {
    $trail->parent('home');
    $trail->push('About Us - History', route('guest.about_us.history'));
});

Breadcrumbs::for('aboutUs_officials', function ($trail) {
    $trail->parent('home');
    $trail->push('About Us - Officials', route('guest.about_us.officials'));
});

Breadcrumbs::for('aboutUs_administrators', function ($trail) {
    $trail->parent('home');
    $trail->push('About Us - Administrators', route('guest.about_us.administrators'));
});

Breadcrumbs::for('downloads_applicationForms', function ($trail) {
    $trail->parent('home');
    $trail->push('Downloads - Application Forms', route('guest.downloads.application_forms'));
});