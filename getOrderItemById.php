<?php

class getOrderItemById
{
    /**
     * @var \Magento\Sales\Api\OrderItemRepositoryInterface
     */
    private $orderItemRepository;

    /**
     * @param \Magento\Sales\Api\OrderItemRepositoryInterface $orderItemRepository
     */
    public function __construct(
        \Magento\Sales\Api\OrderItemRepositoryInterface $orderItemRepository
    )
    {
        $this->orderItemRepository = $orderItemRepository;
    }

    public function fetchOrderItem($orderItemId)
    {
        $itemCollection = $this->orderItemRepository->get($orderItemId);

        //$itemCollection->getOrderId();
        //$itemCollection->getQtyRefunded();
        //$itemCollection->getQtyCanceled();

        return $itemCollection;
    }
}
