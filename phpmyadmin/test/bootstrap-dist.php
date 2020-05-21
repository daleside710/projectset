<?php
/**
 * Bootstrap for phpMyAdmin tests
 */
declare(strict_types=1);

use PhpMyAdmin\Config;
use PhpMyAdmin\DatabaseInterface;
use PhpMyAdmin\Language;
use PhpMyAdmin\LanguageManager;
use PhpMyAdmin\MoTranslator\Loader;
use PhpMyAdmin\Tests\Stubs\DbiDummy;
use PhpMyAdmin\Theme;

if (! defined('ROOT_PATH')) {
    // phpcs:disable PSR1.Files.SideEffects
    define('ROOT_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
    // phpcs:enable
}

/**
 * Set precision to sane value, with higher values
 * things behave slightly unexpectedly, for example
 * round(1.2, 2) returns 1.199999999999999956.
 */
ini_set('precision', '14');

// Let PHP complain about all errors
error_reporting(E_ALL);

// Ensure PHP has set timezone
date_default_timezone_set('UTC');

// Adding phpMyAdmin sources to include path
set_include_path(
    get_include_path() . PATH_SEPARATOR . dirname((string) realpath('../index.php'))
);

// Setting constants for testing
// phpcs:disable PSR1.Files.SideEffects
define('PHPMYADMIN', 1);
define('TESTSUITE', 1);
// phpcs:enable

// Selenium tests setup
$test_defaults = [
    'TESTSUITE_SERVER' => 'localhost',
    'TESTSUITE_USER' => 'root',
    'TESTSUITE_PASSWORD' => '',
    'TESTSUITE_DATABASE' => 'test',
    'TESTSUITE_PORT' => 3306,
    'TESTSUITE_URL' => 'http://localhost/phpmyadmin/',
    'TESTSUITE_SELENIUM_HOST' => '',
    'TESTSUITE_SELENIUM_PORT' => '4444',
    'TESTSUITE_SELENIUM_BROWSER' => 'firefox',
    'TESTSUITE_SELENIUM_COVERAGE' => '',
    'TESTSUITE_BROWSERSTACK_USER' => '',
    'TESTSUITE_BROWSERSTACK_KEY' => '',
    'TESTSUITE_FULL' => '',
    'CI_MODE' => '',
];
if (PHP_SAPI == 'cli') {
    foreach ($test_defaults as $varname => $defvalue) {
        $envvar = getenv($varname);
        if ($envvar) {
            $GLOBALS[$varname] = $envvar;
        } else {
            $GLOBALS[$varname] = $defvalue;
        }
    }
}

require_once ROOT_PATH . 'libraries/vendor_config.php';
require_once AUTOLOAD_FILE;
Loader::loadFunctions();
$GLOBALS['PMA_Config'] = new Config();
$GLOBALS['PMA_Config']->set('environment', 'development');
$GLOBALS['cfg']['environment'] = 'development';

// Initialize PMA_VERSION variable
// phpcs:disable PSR1.Files.SideEffects
define('PMA_VERSION', $GLOBALS['PMA_Config']->get('PMA_VERSION'));
define('PMA_MAJOR_VERSION', $GLOBALS['PMA_Config']->get('PMA_MAJOR_VERSION'));
// phpcs:enable

/* Ensure default language is active */
/** @var Language $languageEn */
$languageEn = LanguageManager::getInstance()->getLanguage('en');
$languageEn->activate();

/* Load Database interface */
$GLOBALS['dbi'] = DatabaseInterface::load(new DbiDummy());

$httpProxy = getenv('http_proxy');
$urlInfo = parse_url((string) $httpProxy);

if (PHP_SAPI == 'cli' && is_array($urlInfo)) {
    $proxyUrl = ($urlInfo['host'] ?? '')
        . (isset($urlInfo['port']) ? ':' . $urlInfo['port'] : '');
    $proxyUser = $urlInfo['user'] ?? '';
    $proxyPass = $urlInfo['pass'] ?? '';
}

// phpcs:disable PSR1.Files.SideEffects
define('PROXY_URL', $proxyUrl ?? '');
define('PROXY_USER', $proxyUser ?? '');
define('PROXY_PASS', $proxyPass ?? '');
// phpcs:enable

// Ensure we have session started
session_start();

// Standard environment for tests
$_SESSION[' PMA_token '] = 'token';
$GLOBALS['PMA_Theme'] = Theme::load(ROOT_PATH . 'themes/pmahomme');
$_SESSION['tmpval']['pftext'] = 'F';
$GLOBALS['lang'] = 'en';