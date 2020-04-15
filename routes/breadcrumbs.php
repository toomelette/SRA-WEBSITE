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
    $trail->push('Mandate', route('guest.about_us.mandate'));
});

Breadcrumbs::for('aboutUs_services', function ($trail) {
    $trail->parent('home');
    $trail->push('Services', route('guest.about_us.services'));
});

Breadcrumbs::for('aboutUs_charter', function ($trail) {
    $trail->parent('home');
    $trail->push('Charter', route('guest.about_us.charter'));
});

Breadcrumbs::for('aboutUs_orgChart', function ($trail) {
    $trail->parent('home');
    $trail->push('Organizational Chart', route('guest.about_us.org_chart'));
});

Breadcrumbs::for('aboutUs_corpObjectives', function ($trail) {
    $trail->parent('home');
    $trail->push('Corporate Objectives', route('guest.about_us.corp_objectives'));
});

Breadcrumbs::for('aboutUs_history', function ($trail) {
    $trail->parent('home');
    $trail->push('History', route('guest.about_us.history'));
});

Breadcrumbs::for('aboutUs_officials', function ($trail) {
    $trail->parent('home');
    $trail->push('Officials', route('guest.about_us.officials'));
});

Breadcrumbs::for('aboutUs_administrators', function ($trail) {
    $trail->parent('home');
    $trail->push('Administrators', route('guest.about_us.administrators'));
});

Breadcrumbs::for('downloads_applicationForms', function ($trail) {
    $trail->parent('home');
    $trail->push('Application Forms', route('guest.downloads.application_forms'));
});

Breadcrumbs::for('downloads_smsForms', function ($trail) {
    $trail->parent('home');
    $trail->push('SMS Forms', route('guest.downloads.sms_forms'));
});

Breadcrumbs::for('downloads_historicalData', function ($trail) {
    $trail->parent('home');
    $trail->push('Historical Data', route('guest.downloads.historical_data'));
});

Breadcrumbs::for('aboutSugarcane_varieties', function ($trail) {
    $trail->parent('home');
    $trail->push('Sugarcane Varieties', route('guest.about_sugarcane.varieties'));
});

Breadcrumbs::for('aboutSugarcane_researches', function ($trail) {
    $trail->parent('home');
    $trail->push('Sugarcane Researches', route('guest.about_sugarcane.researches'));
});

Breadcrumbs::for('aboutSugarcane_researchDetails', function ($trail, $research) {
    $trail->parent('aboutSugarcane_researches');
    $trail->push($research->title, route('guest.about_sugarcane.research_details', $research->slug));
});

Breadcrumbs::for('stakeholders', function ($trail) {
    $trail->parent('home');
    $trail->push('Stakeholders', route('guest.stakeholders.index'));
});