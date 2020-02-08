<?php declare(strict_types=1);

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;
use Symfony\Component\VarDumper\VarDumper;

VarDumper::setHandler(static function ($var) {
    $isCli = PHP_SAPI === 'cli';
    
    $cloner = new VarCloner();
    $dumper = $isCli ? new CliDumper() : new HtmlDumper();
    
    if (!$isCli) {
        $theme = getenv('TKM_DUMP_THEME') ?: 'light';
        $maxDepth = getenv('TKM_DUMP_DEPTH') ?: 1;
        $dumper->setTheme($theme);
        $dumper->setDisplayOptions(['maxDepth' => $maxDepth]);
    }
    
    $dumper->dump($cloner->cloneVar($var));
});
