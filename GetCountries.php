<?php

class GetCountries 
{
    private $countryFactory;

    public function __construct(
        \Magento\Directory\Model\Config\Source\Country $countryFactory
    )
    {
        $this->countryFactory = $countryFactory;
    }

    public function execute()
    {
        // List of countries as an array
        $countryArray = $this->countryFactory->toOptionArray();
    }
}
