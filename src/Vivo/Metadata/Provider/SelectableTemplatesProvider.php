<?php
namespace Vivo\Metadata\Provider;

/**
 * This class provide available templates for given content model class.
 */
class SelectableTemplatesProvider implements \Vivo\Metadata\MetadataValueProviderInterface
{
    /**
     * @todo use empty value instead this constant - remove constant
     * Constant is used because it's not yet posible to define non-required select in metadata
     * info.
     */
    const DEFAULT_TEMPLATE = 'DEFAULT_TEMPLATE';

    /**
     * Template configuration.
     * @var array
     */
    protected $config  = array('custom_templates' => array());

    /**
     * Constructor.
     * @param array $config Templates configuration.
     */
    public function __construct(array $config = array())
    {
        $this->config = $config;
    }

    /**
     * Returns array with template keys available for given content class.
     * @param string $entityClass
     * @return array
     */
    public function getValue($entityClass)
    {
        if (isset($this->config['custom_templates'][$entityClass])) {
            return array_combine($this->config['custom_templates'][$entityClass],
                    $this->config['custom_templates'][$entityClass]);
        } else {
            return array(self::DEFAULT_TEMPLATE => 'default');
        }
    }
}
