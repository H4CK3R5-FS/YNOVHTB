<?php

/**
 * @Author: Mockingbird
 * @Date:   2021-10-20 15:02:31
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 10:45:49
 */

if(Session::getInstance()->hasFlashes()):
    foreach(Session::getInstance()->getFlashes() as $type => $message): ?>

        <div class="alert alert-<?= $type; ?>">
            <?= $message; ?>
        </div>

    <?php endforeach; ?>
    <?php endif; ?>