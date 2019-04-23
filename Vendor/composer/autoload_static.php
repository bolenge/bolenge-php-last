<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1ddd2677ff3cc04c30bfc75b754dda36
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Core\\' => 5,
            'Conf\\' => 5,
        ),
        'A' => 
        array (
            'Apps\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Core',
        ),
        'Conf\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Config',
        ),
        'Apps\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Applications',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1ddd2677ff3cc04c30bfc75b754dda36::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1ddd2677ff3cc04c30bfc75b754dda36::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
