<?php

namespace Company\Module\Controller\Index;
use Magento\Framework\Controller\ResultFactory; 

class Actionname name extends \Magento\Framework\App\Action\Action
{      
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        // Your code

        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
