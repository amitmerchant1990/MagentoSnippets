<?php

class TaxCalculation 
{
    private $taxCalculation;
    
    private $scopeConfig;

    public function __construct(
        \Magento\Tax\Model\Calculation $taxCalculation,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->taxCalculation = $taxCalculation;
        $this->scopeConfig = $scopeConfig;
    }


    public function execute()
    {
        // loop of products
        for (;;) {
            $product = $this->product->load($id);
            
            // Tax Calculation
            $productTaxClassId = $product->getTaxClassId();
            $defaultCustomerTaxClassId = $this->scopeConfig->getValue('tax/classes/default_customer_tax_class');

            $request = new \Magento\Framework\DataObject(
                [
                    'country_id' => $countryId,
                    'region_id' => $regionId,
                    'postcode' => $postcode,
                    'customer_class_id' => $defaultCustomerTaxClassId,
                    'product_class_id' => $productTaxClassId
                ]
            );

            // Calculate tax
            $taxInfo = $this->taxCalculation->getResource()->getRateInfo($request);

            // Classify different taxes
            if (count($taxInfo['process']) > 0) {
                foreach ($taxInfo['process'][0]['rates'] as $key => $rate) {
                    if ($i === 0) {
                        $taxDetails['taxes'][$j]['title'] = $rate['title'];
                        $taxDetails['taxes'][$j]['percent'] = $rate['percent'];
                        $taxDetails['taxes'][$j]['rule_id'] = $rate['rule_id'];
                        $taxDetails['taxes'][$j]['taxAmount'] = ($product->getPrice() * $rate['percent']) / 100;
                        $i++;
                    } else {
                        $ruleIndex = $this->getRuleIndex($rate['rule_id'], $taxDetails['taxes']);
                        if ($ruleIndex !== null) {
                            $taxDetails['taxes'][$ruleIndex]['taxAmount'] += ($product->getPrice() * $rate['percent']) / 100;
                        } else {
                            $j++;
                            $taxDetails['taxes'][$j]['title'] = $rate['title'];
                            $taxDetails['taxes'][$j]['percent'] = $rate['percent'];
                            $taxDetails['taxes'][$j]['rule_id'] = $rate['rule_id'];
                            $taxDetails['taxes'][$j]['taxAmount'] = ($product->getPrice() * $rate['percent']) / 100;
                        }
                    }
                }
                $overallTax += ($product->getPrice() * $taxInfo['process'][0]['percent']) / 100;
            } else {
                $overallTax += 0;
            }
        }
    }

    /**
     * Get index of rule_id in taxDetail array
     *
     * @param $rule_id
     * @param $taxDetails
     * @return int|null|string
     */
    private function getRuleIndex($rule_id, $taxDetails)
    {
        foreach($taxDetails as $key => $tax){
            if(is_array($tax) && $tax['rule_id'] === $rule_id)
                return $key;
        }
        return null;
    }
}
