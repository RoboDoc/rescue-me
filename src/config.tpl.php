<?php
    session_start();
    
    // RescueMe constants
    define('VERSION', 'VERSION');
    
    // RescueMe application paths
    define('APP_PATH', dirname(__FILE__).'/');
    define('APP_PATH_INC', APP_PATH.'inc/');
    define('APP_PATH_CLASS', APP_PATH.'classes/');

    // RescueMe administration paths
    define('ADMIN_PATH', APP_PATH.'admin/');
    define('ADMIN_PATH_INC', ADMIN_PATH.'inc/');
    define('ADMIN_PATH_GUI', ADMIN_PATH.'gui/');
    define('ADMIN_PATH_CLASS', ADMIN_PATH.'classes/');
    
    // Load common resources
    require('inc/common.inc.php');
    
    // RescueMe application URI
    define('APP_URI', get_rescueme_uri());
    
    // RescueMe application URL
    define('APP_URL', get_rescueme_url());

    // RescueMe administration URI
    define('ADMIN_URI', APP_URI.'admin/');
    
    // RescueMe salt value
    define('SALT', 'SALT');

    // SMS integration constants
    define('SMS_FROM', 'RescueMe');

    // Google API key
    define('GOOGLE_API_KEY', 'GOOGLE_API_KEY');
    
    // RescueMe database constants
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'rescueme');
    define('DB_USERNAME', 'DB_USERNAME');
    define('DB_PASSWORD', 'DB_PASSWORD');
    
    // RescueMe custom constants
    define('TITLE', 'Rescue Me!');

    // RescueMe message constants
    define('NO', 'Nei');
    define('YES', 'Ja');
    define('SAVE', 'Lagre');
    define('CREATE', 'Opprett');    
    define('NEW', 'Ny');
    define('ADD', 'Legg til');
    define('EDIT', 'Endre');
    define('REMOVE', 'Fjern');
    define('DELETE', 'Slett');
    define('CANCEL', 'Avbryt');
    define('START', 'Start');
    define('LOGON', 'Logg inn');
    define('LOGOUT', 'Logg ut');
    define('ALERT', 'Varsle');
    define('TRACE', 'Sporing');
    define('TRACES', 'Sporinger');
    define('NEW_TRACE', 'Ny sporing');    
    define('MISSING_PERSON', 'Savnet');
    define('MISSING_PERSONS', 'Savnede');
    define('USER', 'Bruker');
    define('USERS', 'Brukere');
    define('NEW_USER', 'Ny bruker');
    define('OVERVIEW', 'Oversikt');
    define('DASHBOARD', 'Dashboard');
    define('SYSTEM', 'System');
    define('SETUP', 'Oppsett');
    define('ABOUT', 'Om '.TITLE);
    define('SMS_TEXT', 'TEST: Du er savnet! <br /> Trykk på lenken for at vi skal se hvor du er: <br /> '.APP_URL.'#missing_id-#to');
    define('SMS_NOT_SENT', 'OBS: Varsel ble ikke sendt til "#mb_name"');
    define('SMS2_TEXT', 'Om du har GPS på telefonen, anbefaler vi at du aktiverer dette. Vanligvis finner du dette under Innstillinger -> Generelt, eller Innstillinger -> Plassering');
    define('SMS_MB_TEXT', 'Mottatt posisjon på "#m_name" (+/- #acc meter)! '.APP_URL.'admin/missing/details/#missing_id');
    
    // Import class loaders
    require('vendor/autoload.php');