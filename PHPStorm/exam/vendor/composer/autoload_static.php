<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit36eaa5ec20481c763c1aba73c694a880
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'Game\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Game\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib/Game',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit36eaa5ec20481c763c1aba73c694a880::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit36eaa5ec20481c763c1aba73c694a880::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}