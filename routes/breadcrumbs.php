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

Breadcrumbs::for('industryUpdate_ssads', function ($trail) {
    $trail->parent('home');
    $trail->push('Industry Updates / Sugar Supply and Demand Situation', route('guest.industry_update.ssads'));
});

Breadcrumbs::for('industryUpdate_millsitePrices', function ($trail) {
    $trail->parent('home');
    $trail->push('Industry Updates / Millsite Prices ', route('guest.industry_update.millsite_prices'));
});

Breadcrumbs::for('industryUpdate_BERPrice', function ($trail) {
    $trail->parent('home');
    $trail->push('Industry Updates / Bioethanol Reference Price', route('guest.industry_update.ber_price'));
});

Breadcrumbs::for('industryUpdate_MMPrices', function ($trail) {
    $trail->parent('home');
    $trail->push('Industry Updates / Metro Manila Prices', route('guest.industry_update.mm_prices'));
});

Breadcrumbs::for('industryUpdate_sugarStatistics', function ($trail) {
    $trail->parent('home');
    $trail->push('Industry Updates / Sugar Statistics', route('guest.industry_update.sugar_statistics'));
});

Breadcrumbs::for('industryUpdate_roadmap', function ($trail) {
    $trail->parent('home');
    $trail->push('Industry Updates / Roadmap', route('guest.industry_update.roadmap'));
});

Breadcrumbs::for('industryUpdate_eic', function ($trail) {
    $trail->parent('home');
    $trail->push('Industry Updates / Expired Import Clearance', route('guest.industry_update.eic'));
});

Breadcrumbs::for('industryUpdate_millingSchedule', function ($trail) {
    $trail->parent('home');
    $trail->push('Industry Updates / Milling Schedule', route('guest.industry_update.milling_schedule'));
});

Breadcrumbs::for('industryUpdate_blockFarm', function ($trail) {
    $trail->parent('home');
    $trail->push('Industry Updates / Block Farm', route('guest.industry_update.block_farm'));
});

Breadcrumbs::for('industryUpdate_ces', function ($trail) {
    $trail->parent('home');
    $trail->push('Industry Updates / Crop Estimate', route('guest.industry_update.ces'));
});

Breadcrumbs::for('industryUpdate_vacantPosition', function ($trail) {
    $trail->parent('home');
    $trail->push('Industry Updates / Vacant Positions', route('guest.industry_update.vacant_position'));
});

Breadcrumbs::for('policies_sugarOrder', function ($trail) {
    $trail->parent('home');
    $trail->push('Policies / Sugar Orders', route('guest.policies.sugar_order'));
});

Breadcrumbs::for('policies_circularLetter', function ($trail) {
    $trail->parent('home');
    $trail->push('Policies / Circular Letters', route('guest.policies.circular_letter'));
});

Breadcrumbs::for('policies_memoOrder', function ($trail) {
    $trail->parent('home');
    $trail->push('Policies / Memorandum Order', route('guest.policies.memo_order'));
});

Breadcrumbs::for('policies_memoCir', function ($trail) {
    $trail->parent('home');
    $trail->push('Policies / Memorandum Circular', route('guest.policies.memo_cir'));
});

Breadcrumbs::for('policies_molassesOrder', function ($trail) {
    $trail->parent('home');
    $trail->push('Policies / Molasses Order', route('guest.policies.molasses_order'));
});

Breadcrumbs::for('policies_muscovadoOrder', function ($trail) {
    $trail->parent('home');
    $trail->push('Policies / Muscovado Order', route('guest.policies.muscovado_order'));
});

Breadcrumbs::for('policies_gaOrder', function ($trail) {
    $trail->parent('home');
    $trail->push('Policies / General Administrative Order', route('guest.policies.ga_order'));
});

Breadcrumbs::for('policies_sugarLaw', function ($trail) {
    $trail->parent('home');
    $trail->push('Policies / Sugar Laws', route('guest.policies.sugar_law'));
});

Breadcrumbs::for('policies_bioenergy', function ($trail) {
    $trail->parent('home');
    $trail->push('Policies / Bioenergy', route('guest.policies.bioenergy'));
});

Breadcrumbs::for('policies_asean', function ($trail) {
    $trail->parent('home');
    $trail->push('Policies / ASEAN', route('guest.policies.asean'));
});

Breadcrumbs::for('sida_sidaUpdates', function ($trail) {
    $trail->parent('home');
    $trail->push('SIDA / SIDA Updates', route('guest.sida.sida_updates'));
});

Breadcrumbs::for('sida_sidaGuidelines', function ($trail) {
    $trail->parent('home');
    $trail->push('SIDA / SIDA Guidelines', route('guest.sida.sida_guideline'));
});

Breadcrumbs::for('sida_sidaLaws', function ($trail) {
    $trail->parent('home');
    $trail->push('SIDA / SIDA Laws', route('guest.sida.sida_law'));
});

Breadcrumbs::for('sida_sidaFU', function ($trail) {
    $trail->parent('home');
    $trail->push('SIDA / SIDA Fund Utilizations', route('guest.sida.sida_fu'));
});