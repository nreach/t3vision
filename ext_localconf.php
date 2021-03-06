<?php
defined('TYPO3_MODE') || die();

$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][] = [
    'nodeName' => 'nreach_imagekeywords',
    'class' => \Nreach\T3Vision\Form\Element\ImageKeywords::class,
    'priority' => 50,
];

$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][] = [
    'nodeName' => 'nreach_imagedescription',
    'class' => \Nreach\T3Vision\Form\Element\ImageDescription::class,
    'priority' => 50,
];

$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][] = [
    'nodeName' => 'nreach_imagepicker',
    'class' => \Nreach\T3Vision\Form\Element\ImagePicker::class,
    'priority' => 50,
];

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Backend\\Form\\Container\\InlineControlContainer'] = array(
    'className' => 'Nreach\\T3Vision\\Xclass\\InlineControlContainer'
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\Nreach\T3Vision\Task\AutoIndexerTask::class] = array(
    'extension' => $_EXTKEY,
    'title' => 'Nreach Vision AutoIndexer',
    'description' => 'Automatically index up to 5 files'
);

$signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);
$signalSlotDispatcher->connect(
        \TYPO3\CMS\Core\Resource\ResourceStorage::class,
        \TYPO3\CMS\Core\Resource\ResourceStorageInterface::SIGNAL_PostFileAdd,
        \Nreach\T3Vision\Slots\FileUpload::class,
        \Nreach\T3Vision\Slots\FileUpload::SIGNAL_VISION
);