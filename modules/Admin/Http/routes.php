<?php

Route::group([
    'middleware' => ['web', 'admin.auth'],
    'prefix' => 'admin',
    'namespace' => 'Modules\Admin\Http\Controllers'
], function () {

    // Global Patterns
    Route::pattern('id', '[0-9]+');
    Route::pattern('_token', '[\w\d]+');


    Route::get('/', ['as' => 'admin', 'uses' => 'IndexController@index']);

    Route::get('/search', ['as' => 'admin.search', 'uses' => 'Search\SearchController@search']);

    // Authentication routes...
    Route::get('login', ['as' => 'admin.login', 'uses' => 'Auth\AuthController@showLoginForm']);
    Route::post('login', ['as' => 'admin.login', 'uses' => 'Auth\AuthController@login']);
    Route::get('logout', ['as' => 'admin.logout', 'uses' => 'Auth\AuthController@logout']);

    Route::group([
        'as' => 'admin.management.fha-licenses.',
        'prefix' => 'management/fha-licenses',
        'namespace' => 'Management'
    ], function () {
        Route::get('data', ['as' => 'data', 'uses' => 'FhaLicensesController@data']);
        Route::get('/', ['as' => 'index', 'uses' => 'FhaLicensesController@index']);
        Route::get('show/{id}', ['as' => 'show', 'uses' => 'FhaLicensesController@show']);
    });

    // CRM
    Route::group(['prefix' => 'crm', 'namespace' => 'CRM', 'as' => 'admin.crm.'], function () {

        // Sale Stages
        Route::group(['prefix' => 'sale-stages', 'as' => 'sale.stages.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'SaleStagesController@index']);
            Route::any('create', ['as' => 'create', 'uses' => 'SaleStagesController@create']);
            Route::get('edit/{saleStage?}', ['as' => 'edit', 'uses' => 'SaleStagesController@edit']);
            Route::put('edit/{saleStage?}', ['as' => 'update', 'uses' => 'SaleStagesController@update']);
            Route::get('delete/{saleStage}', ['as' => 'delete', 'uses' => 'SaleStagesController@delete']);
            Route::get('data', ['as' => 'data', 'uses' => 'SaleStagesController@data']);
        });
    });

    //AutoSelect & Pricing
    Route::group(['prefix' => 'autoselect-pricing', 'namespace' => 'AutoSelectPricing',], function() {
        // /AutoSelect Counties
        Route::group(['prefix' => 'counties'], function() {
            Route::get('/', ['as' => 'admin.autoselect.counties', 'uses' => 'AutoSelectCountiesController@index']);
            Route::get('data', ['as' => 'admin.autoselect.counties.data', 'uses' => 'AutoSelectCountiesController@data']);
            Route::get('/edit/{slug}', ['as' => 'admin.autoselect.counties.edit', 'uses' => 'AutoSelectCountiesController@edit']);
            Route::put('/{slug}/update', ['as' => 'admin.autoselect.counties.update', 'uses' => 'AutoSelectCountiesController@update']);
        });
        // Autoselect appraiser fees
        Route::group(['prefix' => 'appraiser-fees'], function() {
            Route::get('/', 'AutoSelectAppraiserFeesController@index')->name('admin.autoselect.appraiser.fees.index');
            Route::get('/download', 'AutoSelectAppraiserFeesController@downloadTemplate')->name('admin.autoselect.appraiser.fees.template.download');
            Route::get('/download/{state}', 'AutoSelectAppraiserFeesController@downloadStateTemplate')->name('admin.autoselect.appraiser.fees.template.state.download');
            Route::get('/show/{state}', 'AutoSelectAppraiserFeesController@show')->name('admin.autoselect.appraiser.fees.state.form');
            Route::post('/update/{state}', 'AutoSelectAppraiserFeesController@update')->name('admin.autoselect.appraiser.fees.store.form');
            Route::post('/store', 'AutoSelectAppraiserFeesController@store')->name('admin.autoselect.appraiser.fees.store');

        });
    });

    //Integrations
    Route::group(['prefix' => 'integrations', 'namespace' => 'Integrations',], function() {
        
        //MercuryNetwork
        Route::group(['prefix' => 'mercury', 'namespace' => 'MercuryNetwork',], function() {
            Route::get('/', ['as' => 'admin.integrations.mercury', 'uses' => 'MercuryNetworkController@index']);
            Route::post('/update-statuses', ['as' => 'admin.integrations.update-statuses', 'uses' => 'MercuryNetworkController@updateStatuses']);
            Route::post('/update-loan-reason', ['as' => 'admin.integrations.update-loan-reason', 'uses' => 'MercuryNetworkController@updateLoanReason']);
            Route::post('/update-loan-type', ['as' => 'admin.integrations.update-loan-type', 'uses' => 'MercuryNetworkController@updateLoanType']);
            Route::post('/update-appr-types', ['as' => 'admin.integrations.update-appr-types', 'uses' => 'MercuryNetworkController@updateApprTypes']);
        });

    });



    // Tools
    Route::group(['prefix' => 'tools'], function () {

        // Settings
        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', ['as' => 'admin.tools.settings', 'uses' => 'Tools\SettingsController@index']);

            Route::get('/category/create',
                ['as' => 'admin.tools.settings.category.create', 'uses' => 'Tools\SettingsController@createCategory']);
            Route::post('/category/create',
                ['as' => 'admin.tools.settings.category.create', 'uses' => 'Tools\SettingsController@createCategory']);
            Route::get('/category/update/{id}',
                ['as' => 'admin.tools.settings.category.update', 'uses' => 'Tools\SettingsController@updateCategory']);
            Route::post('/category/update/{id}',
                ['as' => 'admin.tools.settings.category.update', 'uses' => 'Tools\SettingsController@updateCategory']);

            Route::get('/category/{id}',
                ['as' => 'admin.tools.settings.category.view', 'uses' => 'Tools\SettingsController@viewCategory']);
            Route::post('/category/{id}',
                ['as' => 'admin.tools.settings.category.view', 'uses' => 'Tools\SettingsController@viewCategory']);
            Route::get('/category/data', [
                'as' => 'admin.tools.settings.category.data',
                'uses' => 'Tools\SettingsController@settingsCategoryData'
            ]);
        });

        //Logos
        Route::group(['prefix' => 'logos', 'namespace' => 'Tools'], function() {
            Route::get('/', ['as' => 'admin.tools.logos', 'uses' => 'LogoManagerController@index']);
            Route::get('/create', ['as' => 'admin.tools.logos.create', 'uses' => 'LogoManagerController@create']);
            Route::post('/store', ['as' => 'admin.tools.logos.store', 'uses' => 'LogoManagerController@store']);
            Route::get('/edit/{id}', ['as' => 'admin.tools.logos.edit', 'uses' => 'LogoManagerController@edit']);
            Route::put('/{id}/update', ['as' => 'admin.tools.logos.update', 'uses' => 'LogoManagerController@update']);
            Route::get('data', ['as' => 'admin.tools.logos.data', 'uses' => 'LogoManagerController@data']);
            Route::delete('/delete/{id}', ['as' => 'admin.tools.logos.delete', 'uses' => 'LogoManagerController@destroy']);
        });


        Route::group(['prefix' => 'templates'], function () {
            Route::get('/', ['as' => 'admin.tools.templates', 'uses' => 'Tools\TemplatesController@index']);
            Route::get('data',
                ['as' => 'admin.tools.templates.data', 'uses' => 'Tools\TemplatesController@templatesData']);
            Route::any('create/{id?}',
                ['as' => 'admin.tools.templates.create', 'uses' => 'Tools\TemplatesController@createTemplates']);
            Route::any('update/{id}',
                ['as' => 'admin.tools.templates.update', 'uses' => 'Tools\TemplatesController@updateTemplates']);
            Route::get('delete/{id}',
                ['as' => 'admin.tools.templates.delete', 'uses' => 'Tools\TemplatesController@deleteTemplates']);

        });


        Route::group(['prefix' => 'user-logins', 'namespace' => 'Tools'], function () {
            Route::get('/', ['as' => 'admin.tools.user.logins', 'uses' => 'UserLoginsController@index']);
            Route::get('/data',
                ['as' => 'admin.tools.user.logins.data', 'uses' => 'UserLoginsController@userLoginsData']);
        });
        Route::group(['prefix' => 'user-logs', 'namespace' => 'Tools'], function () {
            Route::get('/', ['as' => 'admin.tools.user-logs', 'uses' => 'UserLogsController@index']);
            Route::get('/data',
                ['as' => 'admin.tools.user-logs.data', 'uses' => 'UserLogsController@userLogsData']);
            Route::post('/htmlContent/',
                ['as' => 'admin.tools.user-logs.html-content', 'uses' => 'UserLogsController@getHtmlContent']);
            Route::get('/iframe/{id}',
                ['as' => 'admin.tools.user-logs.iframe', 'uses' => 'UserLogsController@loadIframe']);
        });

        Route::group(['prefix' => 'emails-sent', 'namespace' => 'Tools'], function () {
            Route::get('/', ['as' => 'admin.tools.emails-sent', 'uses' => 'EmailsSentController@index']);
            Route::get('/data',
                ['as' => 'admin.tools.emails-sent.data', 'uses' => 'EmailsSentController@emailsSentData']);
            Route::post('/emailBody',
                ['as' => 'admin.tools.emails-sent.email-body', 'uses' => 'EmailsSentController@getEmailBody']);
            Route::get('/iframe/{id}',
                ['as' => 'admin.tools.emails-sent.iframe', 'uses' => 'EmailsSentController@loadIframe']);
        });

        Route::group(['prefix' => 'shipping-labels', 'namespace' => 'Tools'], function () {
            Route::get('/', ['as' => 'admin.tools.shipping-labels', 'uses' => 'ShippingLabelsController@index']);
            Route::get('/data',
                ['as' => 'admin.tools.shipping-labels.data', 'uses' => 'ShippingLabelsController@shippingLabelsData']);
            Route::post('/downloadPDF',
                ['as' => 'admin.tools.shipping-labels.downloadPDF', 'uses' => 'ShippingLabelsController@downloadPDF']);
        });

        //HomePagePanelsManager
        Route::group(['prefix' => 'home-page-panels', 'namespace' => 'Tools'], function () {
            Route::get('/', ['as' => 'admin.tools.home-page-panels', 'uses' => 'HomePagePanelController@index']);
            Route::get('data', ['as' => 'admin.tools.home-page-panels.data', 'uses' => 'HomePagePanelController@data']);
            Route::get('/create', ['as' => 'admin.tools.home-page-panels.create', 'uses' => 'HomePagePanelController@create']);
            Route::post('/create', ['as' => 'admin.tools.home-page-panels.store', 'uses' => 'HomePagePanelController@store']);
            Route::get('/edit/{id}', ['as' => 'admin.tools.home-page-panels.edit', 'uses' => 'HomePagePanelController@edit']);
            Route::put('/{id}/edit', ['as' => 'admin.tools.home-page-panels.update', 'uses' => 'HomePagePanelController@update']);
            Route::delete('/delete/{id}', ['as' => 'admin.tools.home-page-panels.delete', 'uses' => 'HomePagePanelController@destroy']);
            Route::post('/reorder', ['as' => 'admin.tools.home-page-panels.reorder', 'uses' => 'HomePagePanelController@reorder']);
        });

        // CustomPagesManagerController
        Route::group(['prefix' => 'custom-pages-manager', 'namespace' => 'Tools'], function () {
            Route::get('index', 'CustomPagesManagerController@index')->name('admin.tools.custom-pages-manager.index');
            Route::get('create', 'CustomPagesManagerController@create')->name('admin.tools.custom-pages-manager.create');
            Route::post('store', 'CustomPagesManagerController@store')->name('admin.tools.custom-pages-manager.store');            
            Route::get('data', 'CustomPagesManagerController@data')->name('admin.tools.custom-pages-manager.data');
            Route::get('delete/{id}', 'CustomPagesManagerController@delete')->name('admin.tools.custom-pages-manager.delete');            
            Route::get('edit/{id}', 'CustomPagesManagerController@edit')->name('admin.tools.custom-pages-manager.edit');
            Route::put('edit/{id}', 'CustomPagesManagerController@update')->name('admin.tools.custom-pages-manager.update');
        });

        // GeoController
        Route::group(['prefix' => 'geo', 'namespace' => 'Tools'], function () {
            Route::get('index', 'GeoController@index')->name('admin.tools.geo.index');
            Route::get('create', 'GeoController@create')->name('admin.tools.geo.create');
            Route::post('store', 'GeoController@store')->name('admin.tools.geo.store');                        
            Route::get('data', 'GeoController@data')->name('admin.tools.geo.data');
            Route::get('edit/{id}', 'GeoController@edit')->name('admin.tools.geo.edit');
            Route::put('edit/{id}', 'GeoController@update')->name('admin.tools.geo.update');            
            Route::get('delete/{id}', 'GeoController@delete')->name('admin.tools.geo.delete'); 
        });

    });

    Route::group(['prefix' => 'valuation'], function () {
        Route::group(['prefix' => 'order'], function () {
            Route::group(['prefix' => 'status', 'namespace' => 'Valuation\Order'], function () {
                Route::get('/', ['as' => 'admin.valuation.orders.status', 'uses' => 'StatusController@index']);
                Route::get('data',
                    ['as' => 'admin.valuation.orders.status.data', 'uses' => 'StatusController@orderStatusData']);
                Route::any('create/{status?}',
                    ['as' => 'admin.valuation.orders.status.create', 'uses' => 'StatusController@createOrderStatus']);
                Route::put('update/{status}',
                    ['as' => 'admin.valuation.orders.status.update', 'uses' => 'StatusController@updateOrderStatus']);
                Route::get('delete/{status}',
                    ['as' => 'admin.valuation.orders.status.delete', 'uses' => 'StatusController@deleteOrderStatus']);
            });
        });

    });

    Route::group(['prefix' => 'appraisal', 'namespace' => 'Appraisal'], function () {
        Route::group(['prefix' => 'addendas'], function () {
            Route::get('/', ['as' => 'admin.appraisal.addendas', 'uses' => 'AddendaController@index']);
            Route::get('data', ['as' => 'admin.appraisal.addendas.data', 'uses' => 'AddendaController@addendasData']);
            Route::any('create/{addenda?}',
                ['as' => 'admin.appraisal.addendas.create', 'uses' => 'AddendaController@createAddenda']);
            Route::put('update/{addenda}',
                ['as' => 'admin.appraisal.addendas.update', 'uses' => 'AddendaController@updateAddenda']);
            Route::get('delete/{addenda}',
                ['as' => 'admin.appraisal.addendas.delete', 'uses' => 'AddendaController@deleteAddenda']);
        });
        Route::group(['prefix' => 'loantype'], function () {
            Route::get('/', ['as' => 'admin.appraisal.loantype', 'uses' => 'LoanTypeController@index']);
            Route::get('data', ['as' => 'admin.appraisal.loantype.data', 'uses' => 'LoanTypeController@loanTypeData']);
            Route::any('create/{id?}',
                ['as' => 'admin.appraisal.loantype.create', 'uses' => 'LoanTypeController@createLoanType']);
            Route::any('update/{id}',
                ['as' => 'admin.appraisal.loantype.update', 'uses' => 'LoanTypeController@updateLoanType']);
            Route::get('delete/{id}',
                ['as' => 'admin.appraisal.loantype.delete', 'uses' => 'LoanTypeController@deleteLoanType']);
        });
        Route::group(['prefix' => 'occupancy'], function () {
            Route::get('/', ['as' => 'admin.appraisal.occupancy.status', 'uses' => 'OccupancyStatusController@index']);
            Route::get('data',
                ['as' => 'admin.appraisal.occupancy.data', 'uses' => 'OccupancyStatusController@occupancyData']);
            Route::any('create/{occupancy?}',
                ['as' => 'admin.appraisal.occupancy.create', 'uses' => 'OccupancyStatusController@createOccupancy']);
            Route::put('update/{occupancy}',
                ['as' => 'admin.appraisal.occupancy.update', 'uses' => 'OccupancyStatusController@updateOccupancy']);
            Route::get('delete/{occupancy}',
                ['as' => 'admin.appraisal.occupancy.delete', 'uses' => 'OccupancyStatusController@deleteOccupancy']);
        });
        Route::group(['prefix' => 'delay-codes'], function () {
            Route::get('/', ['as' => 'admin.appraisal.delay-codes', 'uses' => 'DelayCodesController@index']);
            Route::get('data',
                ['as' => 'admin.appraisal.delay-codes.data', 'uses' => 'DelayCodesController@delayCodesData']);
            Route::any('create/{delayCode?}',
                ['as' => 'admin.appraisal.delay-codes.create', 'uses' => 'DelayCodesController@createDelayCodes']);
            Route::put('update/{delayCode}',
                ['as' => 'admin.appraisal.delay-codes.update', 'uses' => 'DelayCodesController@updateDelayCodes']);
            Route::get('delete/{delayCode}',
                ['as' => 'admin.appraisal.delay-codes.delete', 'uses' => 'DelayCodesController@deleteDelayCodes']);
        });

        Route::group(['prefix' => 'property-types'], function () {
            Route::get('/',
                ['as' => 'admin.appraisal.property-types.index', 'uses' => 'PropertyTypes@index']);
            Route::get('data',
                ['as' => 'admin.appraisal.property-types.data', 'uses' => 'PropertyTypes@data']);
            Route::get('create',
                ['as' => 'admin.appraisal.property-types.create', 'uses' => 'PropertyTypes@create']);
            Route::post('store',
                ['as' => 'admin.appraisal.property-types.store', 'uses' => 'PropertyTypes@store']);
            Route::get('{id}/edit',
                ['as' => 'admin.appraisal.property-types.edit', 'uses' => 'PropertyTypes@edit']);
            Route::patch('{id}',
                ['as' => 'admin.appraisal.property-types.update', 'uses' => 'PropertyTypes@update']);
            Route::get('{propertyType}',
                ['as' => 'admin.appraisal.property-types.delete', 'uses' => 'PropertyTypes@delete']);
        });

        Route::group(['prefix' => 'loanreason'], function () {
            Route::get('/', ['as' => 'admin.appraisal.loanreason', 'uses' => 'LoanReasonController@index']);
            Route::get('data',
                ['as' => 'admin.appraisal.loanreason.data', 'uses' => 'LoanReasonController@loanreasonData']);
            Route::any('create/{loanreason?}',
                ['as' => 'admin.appraisal.loanreason.create', 'uses' => 'LoanReasonController@createLoanReason']);
            Route::put('update/{loanreason}',
                ['as' => 'admin.appraisal.loanreason.update', 'uses' => 'LoanReasonController@updateLoanReason']);
            Route::get('delete/{loanreason}',
                ['as' => 'admin.appraisal.loanreason.delete', 'uses' => 'LoanReasonController@deleteLoanReason']);
        });

        Route::group(['as' => 'admin.appraisal.access_type.', 'prefix' => 'access-type'], function () {
            Route::get('data', ['as' => 'data', 'uses' => 'AccessTypeController@getData']);
            Route::get('/', ['as' => 'index', 'uses' => 'AccessTypeController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'AccessTypeController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'AccessTypeController@store']);
            Route::get('show/{id}', ['as' => 'show', 'uses' => 'AccessTypeController@show']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'AccessTypeController@edit']);
            Route::post('edit/{id}', ['as' => 'update', 'uses' => 'AccessTypeController@update']);
            Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'AccessTypeController@destroy']);
        });

        Route::group(['prefix' => 'ucdp-unit', 'namespace' => 'UCDP'], function () {
            Route::get('/', ['as' => 'admin.appraisal.ucdp-unit', 'uses' => 'UCDPUnitController@index']);
            Route::get('data',
                ['as' => 'admin.appraisal.ucdp-unit.data', 'uses' => 'UCDPUnitController@ucdpData']);
            Route::any('create/{ucdpUnit?}',
                ['as' => 'admin.appraisal.ucdp-unit.create', 'uses' => 'UCDPUnitController@createUCDPUnit']);
            Route::put('update/{ucdpUnit}',
                ['as' => 'admin.appraisal.ucdp-unit.update', 'uses' => 'UCDPUnitController@updateUCDPUnit']);
            Route::get('delete/{ucdpUnit}',
                ['as' => 'admin.appraisal.ucdp-unit.delete', 'uses' => 'UCDPUnitController@deleteUCDPUnit']);
            Route::post('deleteFNM',
                ['as' => 'admin.appraisal.ucdp-unit.deleteFNM', 'uses' => 'UCDPUnitController@deleteFNM']);
            Route::post('deleteFRE',
                ['as' => 'admin.appraisal.ucdp-unit.deleteFRE', 'uses' => 'UCDPUnitController@deleteFRE']);
            Route::post('fnm-edit',
                ['as' => 'admin.appraisal.ucdp-unit.fnm-edit', 'uses' => 'UCDPUnitController@editFnm']);
            Route::post('fre-edit',
                ['as' => 'admin.appraisal.ucdp-unit.fre-edit', 'uses' => 'UCDPUnitController@editFre']);
        });
        Route::group(['prefix' => 'ead-unit', 'namespace' => 'EAD'], function () {
            Route::get('/', ['as' => 'admin.appraisal.ead-unit', 'uses' => 'EADUnitController@index']);
            Route::get('data',
                ['as' => 'admin.appraisal.ead-unit.data', 'uses' => 'EADUnitController@eadData']);
            Route::any('create/{eadUnit?}',
                ['as' => 'admin.appraisal.ead-unit.create', 'uses' => 'EADUnitController@createEADUnit']);
            Route::put('update/{eadUnit}',
                ['as' => 'admin.appraisal.ead-unit.update', 'uses' => 'EADUnitController@updateEADUnit']);
            Route::get('delete/{eadUnit}',
                ['as' => 'admin.appraisal.ead-unit.delete', 'uses' => 'EADUnitController@deleteEADUnit']);
        });
        Route::group(['prefix' => 'under-writing', 'namespace' => 'UW'], function () {
            Route::group(['prefix' => 'checklist'], function () {
                Route::get('/',
                    ['as' => 'admin.appraisal.under-writing.checklist', 'uses' => 'ChecklistController@index']);
                Route::any('/category/create/{category?}', [
                    'as' => 'admin.appraisal.under-writing.checklist.category.create',
                    'uses' => 'ChecklistController@createUwCategory'
                ]);
                Route::put('/category/update/{category}', [
                    'as' => 'admin.appraisal.under-writing.checklist.category.update',
                    'uses' => 'ChecklistController@updateUwCategory'
                ]);
                Route::get('/category/active-inactive/{category}', [
                    'as' => 'admin.appraisal.under-writing.checklist.category.active-inactive',
                    'uses' => 'ChecklistController@categoryMakeActiveInactive'
                ]);
                Route::get('/category/delete/{category}', [
                    'as' => 'admin.appraisal.under-writing.checklist.category.delete',
                    'uses' => 'ChecklistController@deleteCategory'
                ]);
                Route::any('/question/create/{question?}', [
                    'as' => 'admin.appraisal.under-writing.checklist.question.create',
                    'uses' => 'ChecklistController@createQuestion'
                ]);
                Route::get('/question/active-inactive/{question}', [
                    'as' => 'admin.appraisal.under-writing.checklist.question.active-inactive',
                    'uses' => 'ChecklistController@createQuestion'
                ]);
                Route::put('/question/update/{question}', [
                    'as' => 'admin.appraisal.under-writing.checklist.question.update',
                    'uses' => 'ChecklistController@updateQuestion'
                ]);
                Route::get('/question/delete/{question}', [
                    'as' => 'admin.appraisal.under-writing.checklist.question.delete',
                    'uses' => 'ChecklistController@deleteQuestion'
                ]);
            });
        });
        
    });

    Route::group(['prefix' => 'document', 'namespace' => 'Documents'], function () {
        Route::group(['prefix' => 'types'], function () {
            Route::get('/', ['as' => 'admin.document.types', 'uses' => 'DocumentTypesController@index']);
            Route::get('data',
                ['as' => 'admin.document.types.data', 'uses' => 'DocumentTypesController@documentTypesData']);
            Route::any('create/{documentType?}',
                ['as' => 'admin.document.types.create', 'uses' => 'DocumentTypesController@createDocumentType']);
            Route::put('update/{documentType}',
                ['as' => 'admin.document.types.update', 'uses' => 'DocumentTypesController@updateDocumentType']);
            Route::get('delete/{documentType}',
                ['as' => 'admin.document.types.delete', 'uses' => 'DocumentTypesController@deleteDocumentType']);
        });
        Route::group(['prefix' => 'user'], function () {
            Route::group(['prefix' => 'types'], function () {
                Route::get('/', ['as' => 'admin.document.user.types', 'uses' => 'UserDocumentTypesController@index']);
                Route::get('data',
                    [
                        'as' => 'admin.document.user.types.data',
                        'uses' => 'UserDocumentTypesController@documentUserTypesData'
                    ]);
                Route::any('create/{userDocumentType?}',
                    [
                        'as' => 'admin.document.user.types.create',
                        'uses' => 'UserDocumentTypesController@createUserDocumentType'
                    ]);
                Route::put('update/{userDocumentType}',
                    [
                        'as' => 'admin.document.user.types.update',
                        'uses' => 'UserDocumentTypesController@updateUserDocumentType'
                    ]);
                Route::get('delete/{userDocumentType}',
                    [
                        'as' => 'admin.document.user.types.delete',
                        'uses' => 'UserDocumentTypesController@deleteUserDocumentType'
                    ]);
            });
        });
        Route::group(['prefix' => 'resource'], function () {
            Route::get('/', ['as' => 'admin.document.resource', 'uses' => 'ResourceDocumentController@index']);
            Route::get('data',
                ['as' => 'admin.document.resource.data', 'uses' => 'ResourceDocumentController@resourceData']);
            Route::any('create/{resource?}',
                ['as' => 'admin.document.resource.create', 'uses' => 'ResourceDocumentController@createResource']);
            Route::put('update/{resource}',
                ['as' => 'admin.document.resource.update', 'uses' => 'ResourceDocumentController@updateResource']);
            Route::get('delete/{resource}',
                ['as' => 'admin.document.resource.delete', 'uses' => 'ResourceDocumentController@deleteResource']);
        });

        // Upload Manager
        Route::group(['prefix' => 'upload'], function () {
            Route::get('/',
                ['as' => 'admin.document.upload', 'uses' => 'UploadController@index']);

            Route::get('data',
                ['as' => 'admin.document.upload.data', 'uses' => 'UploadController@uploadedData']);

            Route::post('upload',
                ['as' => 'admin.document.upload.upload', 'uses' => 'UploadController@uploadFile']);

            Route::get('delete/{file}',
                ['as' => 'admin.document.upload.delete', 'uses' => 'UploadController@deleteFile']);

            Route::get('update_status/{file}',
                ['as' => 'admin.document.upload.update_status', 'uses' => 'UploadController@updateStatus']);

        });
    });

    Route::group(['prefix' => 'management', 'namespace' => 'Management'], function () {

        Route::group(['prefix' => 'amc-licenses'], function () {
            Route::get('/', ['as' => 'admin.management.amc-licenses', 'uses' => 'AMCLicensesController@index']);
            Route::get('data',
                ['as' => 'admin.management.amc-licenses.data', 'uses' => 'AMCLicensesController@amcLicensesData']);
            Route::any('create/{AMCLicense?}',
                ['as' => 'admin.management.amc-licenses.create', 'uses' => 'AMCLicensesController@createAMCLicense']);
            Route::put('update/{AMCLicense}',
                ['as' => 'admin.management.amc-licenses.update', 'uses' => 'AMCLicensesController@updateAMCLicense']);
            Route::get('delete/{AMCLicense}',
                ['as' => 'admin.management.amc-licenses.delete', 'uses' => 'AMCLicensesController@deleteAMCLicense']);
        });
        Route::group(['prefix' => 'asc-licenses'], function () {
            Route::get('/', ['as' => 'admin.management.asc-licenses', 'uses' => 'ASCLicensesController@index']);
            Route::post('data',
                ['as' => 'admin.management.asc-licenses.data', 'uses' => 'ASCLicensesController@ascLicensesData']);

        });
        Route::group(['prefix' => 'email-templates'], function () {
            Route::get('/', ['as' => 'admin.management.email-templates', 'uses' => 'EmailTemplatesController@index']);
            Route::get('data',
                [
                    'as' => 'admin.management.email-templates.data',
                    'uses' => 'EmailTemplatesController@emailTemplatesData'
                ]);
            Route::any('create/{emailTemplate?}',
                [
                    'as' => 'admin.management.email-templates.create',
                    'uses' => 'EmailTemplatesController@createEmailTemplate'
                ]);
            Route::put('update/{emailTemplate}',
                [
                    'as' => 'admin.management.email-templates.update',
                    'uses' => 'EmailTemplatesController@updateEmailTemplate'
                ]);
            Route::get('delete/{emailTemplate}',
                [
                    'as' => 'admin.management.email-templates.delete',
                    'uses' => 'EmailTemplatesController@deleteEmailTemplate'
                ]);
        });

        Route::group(['prefix' => 'sale-tax', 'as' => 'admin.management.sale.tax.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'SaleTaxController@index']);
            Route::get('data', ['as' => 'data', 'uses' => 'SaleTaxController@data']);
            Route::get('edit/{state}', ['as' => 'edit', 'uses' => 'SaleTaxController@edit']);
            Route::put('edit', ['as' => 'update', 'uses' => 'SaleTaxController@update']);
            Route::get('create/{saleTax?}', ['as' => 'create', 'uses' => 'SaleTaxController@create']);
            Route::post('create/{saleTax?}', ['as' => 'createPost', 'uses' => 'SaleTaxController@update']);
            Route::get('counties', ['as' => 'counties', 'uses' => 'SaleTaxController@counties']);
        });

        Route::group(['prefix' => 'user-templates'], function () {
            Route::get('/', ['as' => 'admin.management.user-templates', 'uses' => 'UserTemplatesController@index']);
            Route::get('data',
                [
                    'as' => 'admin.management.user-templates.data',
                    'uses' => 'UserTemplatesController@userTemplatesData'
                ]);
            Route::any('create/{userTemplate?}',
                [
                    'as' => 'admin.management.user-templates.create',
                    'uses' => 'UserTemplatesController@createUserTemplate'
                ]);
            Route::put('update/{userTemplate}',
                [
                    'as' => 'admin.management.user-templates.update',
                    'uses' => 'UserTemplatesController@updateUserTemplate'
                ]);
            Route::get('delete/{userTemplate}',
                [
                    'as' => 'admin.management.user-templates.delete',
                    'uses' => 'UserTemplatesController@deleteUserTemplate'
                ]);
        });
        Route::group(['prefix' => 'zipcodes'], function () {
            Route::get('/',
                ['as' => 'admin.management.zipcodes', 'uses' => 'ZipCodesController@index']);
            Route::get('data',
                ['as' => 'admin.management.zipcodes.data', 'uses' => 'ZipCodesController@zipCodeData']);
            Route::any('create/{ZipCode?}',
                ['as' => 'admin.management.zipcodes.create', 'uses' => 'ZipCodesController@createZipCode']);
            Route::put('update/{ZipCode}',
                ['as' => 'admin.management.zipcodes.update', 'uses' => 'ZipCodesController@updateZipCode']);
            Route::get('delete/{ZipCode}',
                ['as' => 'admin.management.zipcodes.delete', 'uses' => 'ZipCodesController@deleteZipCode']);

        });
        Route::group(['prefix' => 'custom-email-templates'], function () {
            Route::get('/',
                ['as' => 'admin.management.custom-email-templates', 'uses' => 'CustomEmailTemplatesController@index']);
            Route::get('data',
                [
                    'as' => 'admin.management.custom-email-templates.data',
                    'uses' => 'CustomEmailTemplatesController@customEmailTemplatesData'
                ]);
            Route::any('create/{customEmailTemplate?}',
                [
                    'as' => 'admin.management.custom-email-templates.create',
                    'uses' => 'CustomEmailTemplatesController@createCustomEmailTemplate'
                ]);
            Route::put('update/{customEmailTemplate}',
                [
                    'as' => 'admin.management.custom-email-templates.update',
                    'uses' => 'CustomEmailTemplatesController@updateCustomEmailTemplate'
                ]);
            Route::get('delete/{customEmailTemplate}',
                [
                    'as' => 'admin.management.custom-email-templates.delete',
                    'uses' => 'CustomEmailTemplatesController@deleteCustomEmailTemplate'
                ]);
        });
        Route::group(['prefix' => 'groups'], function () {
            Route::get('/',
                ['as' => 'admin.management.groups.index', 'uses' => 'GroupsController@index']);
            Route::get('data',
                ['as' => 'admin.management.groups.data', 'uses' => 'GroupsController@data']);
            Route::get('create',
                ['as' => 'admin.management.groups.create', 'uses' => 'GroupsController@create']);
            Route::post('store',
                ['as' => 'admin.management.groups.store', 'uses' => 'GroupsController@store']);
            Route::get('{id}/edit',
                ['as' => 'admin.management.groups.edit', 'uses' => 'GroupsController@edit']);
            Route::patch('{id}',
                ['as' => 'admin.management.groups.update', 'uses' => 'GroupsController@update']);
            Route::get('{group}',
                ['as' => 'admin.management.groups.delete', 'uses' => 'GroupsController@delete']);
        });

        // AppraiserGroupsController 
        Route::group(['prefix' => 'appraiser-groups'], function () {
            Route::get('index', 'AppraiserGroupsController@index')->name('admin.management.appraiser.index');
            Route::get('data', 'AppraiserGroupsController@data')->name('admin.management.appraiser.data');
            Route::get('create', 'AppraiserGroupsController@create')->name('admin.management.appraiser.create');
            Route::post('store', 'AppraiserGroupsController@store')->name('admin.management.appraiser.store');
            Route::get('managers', 'AppraiserGroupsController@getManagers')->name('admin.management.appraiser.managers');
            Route::get('appraisers', 'AppraiserGroupsController@getAppraisers')->name('admin.management.appraiser.appraisers');
            Route::post('appraisers', 'AppraiserGroupsController@storeAppraiser')->name('admin.management.appraiser.appraisers.store');
            Route::delete('appraisers', 'AppraiserGroupsController@destroyAppraiser')->name('admin.management.appraiser.appraisers.destroy');
            Route::get('edit/{id}', 'AppraiserGroupsController@edit')->name('admin.management.appraiser.edit');
            Route::put('{id}', 'AppraiserGroupsController@update')->name('admin.management.appraiser.update');
        });

        Route::group(['prefix' => 'announcements'], function () {
            Route::get('/', ['as' => 'admin.management.announcements', 'uses' => 'AnnouncementsController@index']);
            Route::get('data',
                ['as' => 'admin.management.announcements.data', 'uses' => 'AnnouncementsController@announcementsData']);
            Route::post('user-types',
                [
                    'as' => 'admin.management.announcements.user-types',
                    'uses' => 'AnnouncementsController@userTypesData'
                ]);
            Route::post('viewed',
                ['as' => 'admin.management.announcements.viewed', 'uses' => 'AnnouncementsController@viewedData']);
            Route::any('create/{announcement?}',
                [
                    'as' => 'admin.management.announcements.create',
                    'uses' => 'AnnouncementsController@createAnnouncement'
                ]);
            Route::put('update/{announcement}',
                [
                    'as' => 'admin.management.announcements.update',
                    'uses' => 'AnnouncementsController@updateAnnouncement'
                ]);
            Route::get('delete/{announcement}',
                [
                    'as' => 'admin.management.announcements.delete',
                    'uses' => 'AnnouncementsController@deleteAnnouncement'
                ]);
        });

});