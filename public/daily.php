<?php
include __DIR__.'/../vendor/autoload.php';

$controller = new \Gt\Measures\Domain\MeasuresController();

$computedMeasures = $controller->prepareDailyMeasures(
    __DIR__ . '/../data/data.csv',
    new DateTimeZone('Europe/Vilnius'),
    8 * 60 * 60
);
?>
<html lang="en">
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
