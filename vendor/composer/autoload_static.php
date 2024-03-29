<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb7ed3632bbdec715a9e38ec56225a9f5
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Automattic\\WooCommerce\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Automattic\\WooCommerce\\' => 
        array (
            0 => __DIR__ . '/..' . '/automattic/woocommerce/src/WooCommerce',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb7ed3632bbdec715a9e38ec56225a9f5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb7ed3632bbdec715a9e38ec56225a9f5::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
