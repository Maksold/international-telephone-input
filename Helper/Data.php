<?php
/**
 *
 * @category   MaxMage
 * @author     MaxMage Core Team <maxmagedev@gmail.com>
 * @date       3/14/2018
 * @copyright  Copyright © 2018 MaxMage. All rights reserved.
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @file       Data.php
 */

namespace MaxMage\InternationalTelephoneInput\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class Data extends AbstractHelper
{
    public const XML_PATH_ITI_MODULE_ENABLED      = 'internationaltelephoneinput/general/enabled';
    public const XML_PATH_ITI_INITIAL_COUNTRY     = 'internationaltelephoneinput/general/initial_country';
    public const XML_PATH_ITI_ALLOWED_COUNTRIES   = 'internationaltelephoneinput/general/allowed_countries';
    public const XML_PATH_ITI_PREFERRED_COUNTRIES = 'internationaltelephoneinput/general/preferred_countries';

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @param Context               $context
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->storeManager = $storeManager;
    }

    /**
     * @return mixed
     */
    public function isEnabled()
    {
        return $this->getConfig(self::XML_PATH_ITI_MODULE_ENABLED);
    }

    /**
     * @param $configPath
     * @return mixed
     */
    protected function getConfig($configPath)
    {
        return $this->scopeConfig->getValue($configPath, ScopeInterface::SCOPE_STORE, $this->storeManager->getStore()->getId());
    }

    /**
     * @return mixed
     */
    public function getInitialCountry()
    {
        return $this->getConfig(self::XML_PATH_ITI_INITIAL_COUNTRY);
    }

    /**
     * @return mixed
     */
    public function getAllowedCountries()
    {
        return $this->getConfig(self::XML_PATH_ITI_ALLOWED_COUNTRIES);
    }

    /**
     * @return mixed
     */
    public function getPreferredCountries()
    {
        return $this->getConfig(self::XML_PATH_ITI_PREFERRED_COUNTRIES);
    }

    /**
     * Prepare telephone field config according to the Magento default config
     *
     * @param        $addressType
     * @param string $method
     * @return array
     */
    public function telephoneFieldConfig($addressType, string $method = ''): array
    {
        return [
            'component'       => 'Magento_Ui/js/form/element/abstract',
            'config'          => [
                'customScope' => $addressType . $method,
                'customEntry' => null,
                'template'    => 'ui/form/field',
                'elementTmpl' => 'MaxMage_InternationalTelephoneInput/form/element/telephone',
                'tooltip'     => [
                    'description' => 'For delivery questions.',
                    'tooltipTpl'  => 'ui/form/element/helper/tooltip',
                ],
            ],
            'dataScope'       => $addressType . $method . '.telephone',
            'dataScopePrefix' => $addressType . $method,
            'label'           => __('Phone Number'),
            'provider'        => 'checkoutProvider',
            'sortOrder'       => 120,
            'validation'      => [
                'required-entry'        => true,
                'max_text_length'       => 255,
                'min_text_length'       => 1,
                'validate-phone-number' => true,
            ],
            'options'         => [],
            'filterBy'        => null,
            'customEntry'     => null,
            'visible'         => true,
            'focused'         => false,
        ];
    }
}
