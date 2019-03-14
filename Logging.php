<?php

$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$logger = $objectManager->get('\Psr\Log\LoggerInterface');
$logger->info('Log: ' . print_r($log, true));
