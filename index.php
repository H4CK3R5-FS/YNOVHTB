<?php

/**
 * @Author: root
 * @Date:   2022-04-05 19:28:52
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 10:52:50
 */
require_once 'inc/bootstrap.php';

$auth = App::getAuth();
$db = App::getDatabase();
$auth->connectFromCookie($db);

require_once 'inc/components/header.php';
require_once 'inc/components/navbar.php';
require_once 'inc/components/footer.php';

try { if(isset($auth->user()->token)): App::redirect('auth/profile/'); endif; } catch (Exception $e) {}