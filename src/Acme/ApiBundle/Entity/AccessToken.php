<?php
/**
 * Created by PhpStorm.
 * User: anboo
 * Date: 04.10.16
 * Time: 20:03
 */

namespace Acme\ApiBundle\Entity;


namespace Acme\ApiBundle\Entity;

use FOS\OAuthServerBundle\Entity\AccessToken as BaseAccessToken;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Table("oauth2_access_tokens")
 * @ORM\Entity
 */
class AccessToken extends BaseAccessToken
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"list"})
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"list"})
     */
    protected $client;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @Groups({"list"})
     */
    protected $user;
}
