<?php
// Django authentication plugin.
// https://bitbucket.org/pythonian4000/django-mediawiki-authentication-by-user-id/

// Configuration variables
$wgAuthDjangoConfig = array();

$wgAuthDjangoConfig['DjangoHost']   = 'localhost';                 // Django PostgreSQL Host Name.
$wgAuthDjangoConfig['DjangoPort']   = '5432';	                   // Django PostgreSQL port
$wgAuthDjangoConfig['DjangoUser']   = 'mediawiki';                 // Django PostgreSQL Username.
$wgAuthDjangoConfig['DjangoPass']   = getenv('DATABASE_PASSWORD'); // Django PostgreSQL Password.
$wgAuthDjangoConfig['DjangoDBName'] = getenv('DATABASE_USER');     // Django PostgreSQL Database Name.

$wgAuthDjangoConfig['AuthDjangoTable']      = 'authdjango';
$wgAuthDjangoConfig['UserTable']            = 'auth_user';
$wgAuthDjangoConfig['SessionTable']         = 'django_session';
$wgAuthDjangoConfig['SessionprofileTable']  = 'wiki_sessionprofile';

$wgAuthDjangoConfig['LinkToSiteLogin']       = 'https://megabeta.se/'; //Django site login URL
$wgAuthDjangoConfig['LinkToWiki']            = '/wiki/'; //Subdirectory wiki

// Load classes
$wgAutoloadClasses['AuthPlugin'] = dirname('./include') . '/AuthPlugin.php';
$wgAutoloadClasses['AuthDjango'] = dirname(__FILE__) . '/AuthDjango.body.php';

// Schema updates for update.php

$wgHooks['LoadExtensionSchemaUpdates'][] = 'addAuthDjangoTables';
function addAuthDjangoTables() {
    global $wgExtNewTables;
    $wgExtNewTables[] = array(
        'authdjango',
        dirname( __FILE__ ) . '/tables-authdjango.sql' );
    return true;
}

$wgExtensionFunctions[] = "initAuthDjango";
function initAuthDjango() {
    $wgAuth = new AuthDjango();     // Initiate Auth Plugin
}
