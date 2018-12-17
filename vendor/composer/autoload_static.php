<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit51b523f56e298134d109fbc73bbc4aba
{
    public static $files = array (
        'ce5ea74800fab16a27788e289558027d' => __DIR__ . '/../..' . '/inc/Helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Inc\\' => 4,
        ),
        'D' => 
        array (
            'Dotenv\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
        'Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/phpdotenv/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit51b523f56e298134d109fbc73bbc4aba::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit51b523f56e298134d109fbc73bbc4aba::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
