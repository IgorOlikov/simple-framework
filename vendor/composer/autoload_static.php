<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit308f677de138c28b58ad7bb25e7c5308
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit308f677de138c28b58ad7bb25e7c5308::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit308f677de138c28b58ad7bb25e7c5308::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit308f677de138c28b58ad7bb25e7c5308::$classMap;

        }, null, ClassLoader::class);
    }
}
