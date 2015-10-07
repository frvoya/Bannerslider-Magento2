<?php

/**
 * Magestore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Magestore
 * @package     Magestore_Bannerslider
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

namespace Magestore\Bannerslider\Controller;

/**
 * Index action
 * @category Magestore
 * @package  Magestore_Bannerslider
 * @module   Bannerslider
 * @author   Magestore Developer
 */
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * Slider factory.
     *
     * @var \Megami\MiniLocator\Model\SliderFactory
     */
    protected $_sliderFactory;

    /**
     * banner factory.
     *
     * @var \Megami\MiniLocator\Model\BannerFactory
     */
    protected $_bannerFactory;

    /**
     * Report factory.
     *
     * @var \Megami\MiniLocator\Model\ReportFactory
     */
    protected $_reportFactory;

    /**
     * Report collection factory.
     *
     * @var \Magestore\Bannerslider\Model\Resource\Report\CollectionFactory
     */
    protected $_reportCollectionFactory;

    /**
     * A result that contains raw response - may be good for passing through files
     * returning result of downloads or some other binary contents.
     *
     * @var \Magento\Framework\Controller\Result\RawFactory
     */
    protected $_resultRawFactory;

    /**
     * A factory that knows how to create a "page" result
     * Requires an instance of controller action in order to impose page type,
     * which is by convention is determined from the controller action class.
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * Cookie Manager.
     *
     * @var \Magento\Framework\Stdlib\CookieManagerInterface
     */
    protected $_cookieManager;

    /**
     * @var \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory
     */
    protected $_cookieMetadataFactory;

    /**
     * @var \Magento\Framework\HTTP\PhpEnvironment\Request
     */
    protected $_phpEnvironmentRequest;

    /**
     * logger.
     *
     * @var \Magento\Framework\Logger\Monolog
     */
    protected $_monolog;

    /**
     * stdlib timezone.
     *
     * @var \Magento\Framework\Stdlib\DateTime\Timezone
     */
    protected $_stdTimezone;

    /**
     * [__construct description].
     *
     * @param \Magento\Framework\App\Action\Context                           $context
     * @param \Magestore\Bannerslider\Model\SliderFactory                     $sliderFactory
     * @param \Magestore\Bannerslider\Model\BannerFactory                     $bannerFactory
     * @param \Magestore\Bannerslider\Model\ReportFactory                     $reportFactory
     * @param \Magestore\Bannerslider\Model\Resource\Report\CollectionFactory $reportCollectionFactory
     * @param \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory          $cookieMetadataFactory
     * @param \Magento\Framework\Stdlib\CookieManagerInterface                $cookieManager
     * @param \Magento\Framework\Controller\Result\RawFactory                 $resultRawFactory
     * @param \Magento\Framework\View\Result\PageFactory                      $resultPageFactory
     * @param \Magento\Framework\HTTP\PhpEnvironment\Request                  $phpEnvironmentRequest
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magestore\Bannerslider\Model\SliderFactory $sliderFactory,
        \Magestore\Bannerslider\Model\BannerFactory $bannerFactory,
        \Magestore\Bannerslider\Model\ReportFactory $reportFactory,
        \Magestore\Bannerslider\Model\Resource\Report\CollectionFactory $reportCollectionFactory,
        \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory,
        \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\HTTP\PhpEnvironment\Request $phpEnvironmentRequest,
        \Magento\Framework\Logger\Monolog $monolog,
        \Magento\Framework\Stdlib\DateTime\Timezone $stdTimezone
    ) {
        parent::__construct($context);
        $this->_sliderFactory = $sliderFactory;
        $this->_bannerFactory = $bannerFactory;
        $this->_reportFactory = $reportFactory;
        $this->_reportCollectionFactory = $reportCollectionFactory;

        $this->_resultRawFactory = $resultRawFactory;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_cookieManager = $cookieManager;
        $this->_cookieMetadataFactory = $cookieMetadataFactory;
        $this->_phpEnvironmentRequest = $phpEnvironmentRequest;
        $this->_monolog = $monolog;
        $this->_stdTimezone = $stdTimezone;
    }

    /**
     * get user code.
     *
     * @param mixed $id
     *
     * @return string
     */
    protected function getUserCode($id)
    {
        $ipAddress = $this->_phpEnvironmentRequest->getClientIp(true);
        $cookiefrontend = $this->_cookieManager->getCookie('frontend');
        $usercode = $ipAddress.$cookiefrontend.$id;

        return md5($usercode);
    }
}
