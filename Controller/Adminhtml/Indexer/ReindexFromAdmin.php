<?php

namespace PhilTurner\AdminReindex\Controller\Adminhtml\Indexer;

use Magento\Backend\App\Action\Context;

class ReindexFromAdmin extends \Magento\Backend\App\Action
{

    protected $indexerFactory;

    public function __construct(
        Context $context,
        \Magento\Indexer\Model\IndexerFactory $indexerFactory
    ) {
        $this->indexerFactory = $indexerFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $indexerIds = explode(",",$this->getRequest()->getParam('indexer_ids'));
        var_dump($indexerIds);
        if (!isset($indexerIds)) {
            $this->messageManager->addError(__('Please select indexers.'));
        } else {
            $this->messageManager->addSuccess(__('We have some stuff to reindex'));
        }

        $this->_redirect('*/*/list');
    }
}