<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitaf08ac1cc59b298556533c3c9e8d2435
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Klein\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Klein\\' => 
        array (
            0 => __DIR__ . '/..' . '/klein/klein/src/Klein',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitaf08ac1cc59b298556533c3c9e8d2435::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitaf08ac1cc59b298556533c3c9e8d2435::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
