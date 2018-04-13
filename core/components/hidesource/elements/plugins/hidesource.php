<?php
/** @var modX $modx */
switch ($modx->event->name) {
    case 'OnMediaSourceGetProperties':
        $properties = json_decode($properties, true);
        if (!empty($properties['hideSource']) AND !empty($properties['hideSource']['value']) AND $_REQUEST['node'] == '/') {
            die('{}');
        }
        break;
}