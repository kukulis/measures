<?php
include __DIR__ . '/vendor/autoload.php';

$controller = new \Gt\Measures\Domain\MeasuresController();

$timeZone = 'Europe/Vilnius';
$shiftHours = 8;

$computedMeasures = $controller->prepareWeeklyMeasures(
    __DIR__ . '/data/data.csv',
    new DateTimeZone($timeZone),
    $shiftHours * 60 * 60
);
?>
<html lang="en">
<head>
    <title>Measures weekly</title>
    <style>
        td {
            padding-left:15px;
        }
    </style>
</head>
<body>
<h1>Daily</h1>
<ul>
    <li>Timezone: <?php echo $timeZone ?></li>
    <li>Finished hour: <?php echo $shiftHours ?></li>
</ul>
<table>
    <tr>
        <th>Year</th>
        <th>Week</th>
        <th>Sum</th>
        <th>Peak Value</th>
        <th>Peak time</th>
    </tr>
    <?php foreach ($computedMeasures as $computedMeasure) : ?>
    <tr>
        <td><?php echo $computedMeasure->getDate()->format('Y') ?></td>
        <td><?php echo $computedMeasure->getDate()->format('W') ?></td>
        <td><?php echo $computedMeasure->getSum() ?></td>
        <td><?php echo $computedMeasure->getPeakValue() ?></td>
        <td><?php echo $computedMeasure->getPeakDate()->format('Y-m-d H:i:s') ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
