<h1>Exception <?php $e->getCode() ?></h1>
<h2><?= $e->getMessage() ?></h2>
<h3>File: <?= $e->getMessage() ?></h3>
<h3>Line: <?= $e->getLine() ?></h3>
<h4>Trace:</h4>
<pre><?php print_r($e->getTrace()) ?></pre>
