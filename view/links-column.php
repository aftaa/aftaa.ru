<?php

use entity\LinkBlockDb;
use helper\Visitor;

/** @var LinkBlockDb $block */

$isAftaa = Visitor::isAftaa();
$isAdmin = $isAftaa;


if ($block->getCount()): ?>
    <h3 class="mt-3"><?= $block->getName() ?></h3>
    <?php foreach ($block->getLinks() as $link): ?>

        <div style="white-space: nowrap;" class="mb-1">
            <?php if ($icon = $link->getIcon()): ?>
                <a href="<?= $icon ?>" target="_blank"><img alt="<?= strip_tags($link->getName()) ?>" src="<?= $icon ?>" width="16"
                                                            height="16" style=""></a>&nbsp;
            <?php endif ?>
            <a href="<?= $link->getHref() ?>" target="_blank" class="view" data-link-id="<?= $link->id ?>">
                <?= $link->getName() ?>
            </a>

            <?php if ($link->views > 0): ?>
                <sup>
                    <small>
                        <?= $link->views ?>
                    </small>
                </sup>
            <?php endif ?>

        </div>
    <? endforeach ?>
<?php endif ?>
