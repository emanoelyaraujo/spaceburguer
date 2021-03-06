<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc331cb2923e2d059b4fd938520472430
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc331cb2923e2d059b4fd938520472430::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc331cb2923e2d059b4fd938520472430::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc331cb2923e2d059b4fd938520472430::$classMap;

        }, null, ClassLoader::class);
    }
}
