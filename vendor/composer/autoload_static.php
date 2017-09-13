<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit627d6431d71685b06e5727c0570f5e2c
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'AymericDev\\AsyncPHP\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'AymericDev\\AsyncPHP\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit627d6431d71685b06e5727c0570f5e2c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit627d6431d71685b06e5727c0570f5e2c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}