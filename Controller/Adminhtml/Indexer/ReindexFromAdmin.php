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
        $indexIds = explode(",", $this->getRequest()->getParam('indexer_ids'));
        if (!isset($indexIds)) {
            $this->messageManager->addError(__('Please select an index'));
        } else {
            try {
                foreach ($indexIds as $id) {
                    $indexer = $this->indexerFactory->create();
                    $indexer->load($id)->reindexAll();
                }
                $this->messageManager->addSuccess(__('Reindex job complete', count($indexIds)));
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/list');
    }
}