<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('guest.home.index'));
});

// Home > News
Breadcrumbs::for('news', function ($trail) {
    $trail->parent('home');
    $trail->push('News', route('guest.news.index'));
});

// Home > News > [Title]
Breadcrumbs::for('news_details', function ($trail, $news) {
    $trail->parent('news');
    $trail->push($news->title, route('guest.news.details', $news->slug));
});

// Home > Announcements
Breadcrumbs::for('announcement', function ($trail) {
    $trail->parent('home');
    $trail->push('Announcements', route('guest.announcement.index'));
});

// Home > Announcements > [Title]
Breadcrumbs::for('announcement_details', function ($trail, $announcement) {
    $trail->parent('announcement');
    $trail->push($announcement->title, route('guest.announcement.details', $announcement->slug));
});

// Home > About us > Mandate
Breadcrumbs::for('aboutUs_mandate', function ($trail) {
    $trail->parent('home');
    $trail->push('About Us - Mandate', route('guest.about_us.mandate'));
});

// Home > About us > Services
Breadcrumbs::for('aboutUs_services', function ($trail) {
    $trail->parent('home');
    $trail->push('About Us - Services', route('guest.about_us.services'));
});

// Home > About us > Services
Breadcrumbs::for('aboutUs_charter', function ($trail) {
    $trail->parent('home');
    $trail->push('About Us - Charter', route('guest.about_us.charter'));
});

// Home > About us > Org Chart
Breadcrumbs::for('aboutUs_orgChart', function ($trail) {
    $trail->parent('home');
    $trail->push('About Us - Organizational Chart', route('guest.about_us.org_chart'));
});

// Home > About us > Corp Objectives
Breadcrumbs::for('aboutUs_corpObjectives', function ($trail) {
    $trail->parent('home');
    $trail->push('About Us - Corporate Objectives', route('guest.about_us.corp_objectives'));
});

// Home > About us > History
Breadcrumbs::for('aboutUs_history', function ($trail) {
    $trail->parent('home');
    $trail->push('About Us - History', route('guest.about_us.history'));
});