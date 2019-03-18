<?php

class GetBackendSetting
{
    private $scopeConfigInterface;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfigInterface,
    )
    {
        $this->scopeConfigInterface = $scopeConfigInterface;
    }

    public function getScopeConfigValue()
    {
        return $this->scopeConfigInterface->getValue($path); //eg. fulfilment_configuration/general/fulfilment_instock_items
    }
}
