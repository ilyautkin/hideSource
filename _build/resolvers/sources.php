<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $sources_for_hide = array(
                'BannerY',
                'MS2 Images',
                'MS2Gallery',
                'Tickets Files',
                'User Files'
            );
            $sources = $modx->getCollection('sources.modFileMediaSource');
            foreach ($sources as $source) {
                $value = false;
                if (in_array($source->name, $sources_for_hide)) {
                    $value = true;
                }
                $properties = $source->get('properties');
                if (!isset($properties['hideSource'])) {
                    $properties['hideSource'] = array(
                        'name' => 'hideSource',
                        'desc' => 'hidesource_hide_in_tree',
                        'type' => 'combo-boolean',
                        'options' => array(),
                        'value' => $value,
                        'lexicon' => 'hidesource:default'
                    );
                    $source->set('properties', $properties);
                    $source->save();
                }
            }
            break;

        case xPDOTransport::ACTION_UNINSTALL:
            break;
    }
}

return true;