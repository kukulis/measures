<?php

use Gt\Measures\Domain\ComputedMeasure;
use Gt\Measures\Domain\Loader;
use Gt\Measures\Domain\Measure;
use Gt\Measures\Util\Grouper;

include __DIR__.'/../vendor/autoload.php';
$file = __DIR__.'/../data/data.csv';

$loader = new Loader();

$measures = $loader->loadMeasures($file);

$groupedByDay = Grouper::group($measures, fn(Measure $measure)=> $measure->getDayStart());

$computedMeasures = [];
foreach ($groupedByDay as $day => $group ) {
    $computedMeasures[] = (new ComputedMeasure())->computeFromMeasures($group);
}

?>
<html>
<body>
<h1>Daily</h1>
<table>
    <?php foreach ($computedMeasures as $computedMeasure) : ?>
    <tr>
        <td><?php echo $computedMeasure->getDate() ?></td>
        <td><?php echo $computedMeasure->getSum() ?></td>
        <td><?php echo $computedMeasure->getPeakValue() ?></td>
        <td><?php echo $computedMeasure->getPeakTimestamp() ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
