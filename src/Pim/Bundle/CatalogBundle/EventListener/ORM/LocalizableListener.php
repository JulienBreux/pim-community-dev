<?php

namespace Pim\Bundle\CatalogBundle\EventListener\ORM;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Util\ClassUtils;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Pim\Bundle\CatalogBundle\Model\Product;
use Pim\Bundle\CatalogBundle\Entity\AttributeOption;

/**
 * Aims to inject selected locale into loaded product
 *
 * @author    Nicolas Dupont <nicolas@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class LocalizableListener implements EventSubscriber
{
    /**
     * @var ContainerInterface $container
     */
    protected $container;

    /**
     * Inject service container
     *
     * @param ContainerInterface $container
     *
     * @return LocalizableListener
     */
    public function setContainer($container)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * Specifies the list of events to listen
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(
            'postLoad'
        );
    }

    /**
     * After load
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $isProduct = ($entity instanceof Product);
        $isAttributeOption = ($entity instanceof AttributeOption);

        if ($isProduct || $isAttributeOption) {
            $productManager = $this->container->get('pim_catalog.manager.product');
            $entity->setLocale($productManager->getLocale());
        }
    }
}
