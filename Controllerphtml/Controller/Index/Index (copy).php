<?php
namespace Biren\ProductColl\Controller\Index;


class Index extends \Magento\Framework\App\Action\Action
{


    /**
     * Customer Repository.
     *
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    protected $_customerRepository;

    /**
     * Encryptor.
     *
     * @var \Magento\Framework\Encryption\Encryptor
     */
    protected $_encryptor;

    /**
     * Customer registry.
     *
     * @var \Magento\Customer\Model\CustomerRegistry
     */
    protected $_customerRegistry;


    protected $resultPageFactory;
    protected $fileFactory;
    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Framework\Encryption\Encryptor $encryptor,
        \Magento\Customer\Model\CustomerRegistry $customerRegistry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->fileFactory = $fileFactory;
        $this->_customerRepository = $customerRepository;
        $this->_encryptor          = $encryptor;
        $this->_customerRegistry   = $customerRegistry;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $password = "Bp22051993";
        $customer = $this->_customerRepository->getById(40);
        $passwordHash = $this->_encryptor->getHash($password, true);
        $customerSecure = $this->_customerRegistry->retrieveSecureData($customer->getId());
        $customerSecure->setRpToken(null);
        $customerSecure->setRpTokenCreatedAt(null);
        $customerSecure->setPasswordHash($passwordHash);
        $this->_customerRepository->save($customer, $passwordHash);
        return $this->resultPageFactory->create();
    }
}
