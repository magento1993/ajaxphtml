<?php
namespace Biren\Controllerphtml\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;

class Post extends \Magento\Framework\App\Action\Action
{

     /**
     * @var Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    protected $resultJsonFactory; 

    /**
     * @param Context     $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory
        )
    {

        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory; 
        return parent::__construct($context);
    }


    public function execute()
    {
        $post = $this->getRequest()->getPostValue();

    echo "<pre>";
    print_r($post);
    exit;
        $height = $this->getRequest()->getParam('height');
        $weight = $this->getRequest()->getParam('weight');
        $result = $this->resultJsonFactory->create();
        $resultPage = $this->resultPageFactory->create();

        $block = $resultPage->getLayout()
                ->createBlock('Biren\Controllerphtml\Block\Index\Index')
                ->setTemplate('Biren_Controllerphtml::result.phtml')
                // ->setData('height',$height)
                // ->setData('weight',$weight)
                ->toHtml();

        $result->setData(['output' => $block]);
        return $result;
    } 
}
