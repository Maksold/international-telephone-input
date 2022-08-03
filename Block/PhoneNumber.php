<?php
/**
 *
 * @category   MaxMage
 * @package    mc-magento2
 * @author     MaxMage Core Team <maxmagedev@gmail.com>
 * @date       1/14/2018
 * @copyright  Copyright © 2018 MaxMage. All rights reserved.
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @file       PhoneNumber.php
 */

namespace MaxMage\InternationalTelephoneInput\Block;

use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use MaxMage\InternationalTelephoneInput\Helper\Data;

class PhoneNumber extends Template
{
    /**
     * @var Json
     */
    protected $jsonHelper;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * PhoneNumber constructor.
     *
     * @param Context $context
     * @param Json    $jsonHelper
     * @param Data    $helper
     */
    public function __construct(
        Context $context,
        Json $jsonHelper,
        Data $helper
    ) {
        $this->jsonHelper = $jsonHelper;
        $this->helper     = $helper;
        parent::__construct($context);
    }

    /**
     * @return bool|string
     */
    public function phoneConfig()
    {
        $config = [
            'nationalMode'     => false,
            'separateDialCode' => true,
            'utilsScript'      => $this->getViewFileUrl('MaxMage_InternationalTelephoneInput::js/utils.js'),
        ];

        if ($this->helper->getPreferredCountries()) {
            $config['preferredCountries'] = explode(',', $this->helper->getPreferredCountries());
        }

        if ($this->helper->getAllowedCountries()) {
            $config['onlyCountries'] = explode(',', $this->helper->getAllowedCountries());
        }

        return $this->jsonHelper->serialize($config);
    }
}