<?php

declare(strict_types=1);

/*
 * TYPO3 Frontend Entry Point
 */

(static function (): void {
    $classLoader = require dirname(__DIR__) . '/vendor/autoload.php';
    \TYPO3\CMS\Core\Core\SystemEnvironmentBuilder::run(0, \TYPO3\CMS\Core\Core\SystemEnvironmentBuilder::REQUESTTYPE_FE);
    \TYPO3\CMS\Core\Core\Bootstrap::init($classLoader)->get(\Psr\Http\Server\RequestHandlerInterface::class)->handle(
        \TYPO3\CMS\Core\Http\ServerRequestFactory::fromGlobals()
    );
})();
