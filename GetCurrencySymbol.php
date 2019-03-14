<?php

class GetCurrencySymbol 
{
    private $currencycode;

    private $currencysymbol;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $currencycode,
        \Magento\Directory\Model\CurrencyFactory $currencysymbol
    )
    {
        $this->currencysymbol = $currencysymbol;
        $this->currencycode = $currencycode;
    }

    public function execute()
    {
        $currentCurrencyCode = $this->currencycode->getStore()->getCurrentCurrencyCode();
        $currencySymbol = $this->currencysymbol->create()->load($currentCurrencyCode);
    }
}
