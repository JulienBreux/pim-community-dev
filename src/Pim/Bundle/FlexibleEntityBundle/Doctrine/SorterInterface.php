<?php

namespace Pim\Bundle\FlexibleEntityBundle\Doctrine;

use Pim\Bundle\FlexibleEntityBundle\Model\AbstractAttribute;

/**
 * Sorter interface
 *
 * @author    Nicolas Dupont <nicolas@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
interface SorterInterface
{
    /**
     * Sort by attribute value
     *
     * @param AbstractAttribute $attribute the attribute to sort on
     * @param string            $direction the direction to use
     *
     * @return SorterInterface
     */
    public function add(AbstractAttribute $attribute, $direction);
}
