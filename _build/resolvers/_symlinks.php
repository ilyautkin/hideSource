<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/hideSource/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/hidesource')) {
            $cache->deleteTree(
                $dev . 'assets/components/hidesource/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/hidesource/', $dev . 'assets/components/hidesource');
        }
        if (!is_link($dev . 'core/components/hidesource')) {
            $cache->deleteTree(
                $dev . 'core/components/hidesource/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/hidesource/', $dev . 'core/components/hidesource');
        }
    }
}

return true;