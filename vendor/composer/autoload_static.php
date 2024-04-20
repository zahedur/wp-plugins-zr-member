<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1c490487c0ea42abd16f4e4fe9dd02eb
{
    public static $files = array (
        'b28c668a0c5b53a373214842fb462938' => __DIR__ . '/../..' . '/includes/Helper.php',
    );

    public static $prefixLengthsPsr4 = array (
        'Z' => 
        array (
            'Zr\\Member\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Zr\\Member\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1c490487c0ea42abd16f4e4fe9dd02eb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1c490487c0ea42abd16f4e4fe9dd02eb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1c490487c0ea42abd16f4e4fe9dd02eb::$classMap;

        }, null, ClassLoader::class);
    }
}
