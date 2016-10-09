<?php

namespace Acme\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\SerializedName;

//JMS\Serializer\Naming\CamelCaseNamingStrategy

/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity(repositoryClass="Acme\GameBundle\Repository\CompanyRepository")
 */
class Company
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Groups({"moderator", "admin"})
     */
    private $title;

    /**
     * Здесь могла быть связь ManyToOne
     * @ORM\Column(type="integer")
     * @Groups({"moderator", "admin"})
     */
    private $gameId;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"admin"})
     */
    private $startDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"admin"})
     */
    private $timeActive;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"admin"})
     */
    private $registeredPlayers;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"admin"})
     */
    private $registeredCodes;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"moderator", "admin"})
     */
    private $prisesGiven;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"moderator", "admin"})
     */
    private $playersLimit;

    /**
     * @ORM\Column(type="string")
     * @Groups({"moderator", "admin"})
     */
    private $state;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Company
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set gameId
     *
     * @param integer $gameId
     * @return Company
     */
    public function setGameId($gameId)
    {
        $this->gameId = $gameId;

        return $this;
    }

    /**
     * Get gameId
     *
     * @return integer 
     */
    public function getGameId()
    {
        return $this->gameId;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Company
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set timeActive
     *
     * @param \DateTime $timeActive
     * @return Company
     */
    public function setTimeActive($timeActive)
    {
        $this->timeActive = $timeActive;

        return $this;
    }

    /**
     * Get timeActive
     *
     * @return \DateTime 
     */
    public function getTimeActive()
    {
        return $this->timeActive;
    }

    /**
     * Set registeredPlayers
     *
     * @param integer $registeredPlayers
     * @return Company
     */
    public function setRegisteredPlayers($registeredPlayers)
    {
        $this->registeredPlayers = $registeredPlayers;

        return $this;
    }

    /**
     * Get registeredPlayers
     *
     * @return integer 
     */
    public function getRegisteredPlayers()
    {
        return $this->registeredPlayers;
    }

    /**
     * Set registeredCodes
     *
     * @param integer $registeredCodes
     * @return Company
     */
    public function setRegisteredCodes($registeredCodes)
    {
        $this->registeredCodes = $registeredCodes;

        return $this;
    }

    /**
     * Get registeredCodes
     *
     * @return integer 
     */
    public function getRegisteredCodes()
    {
        return $this->registeredCodes;
    }

    /**
     * Set prisesGiven
     *
     * @param integer $prisesGiven
     * @return Company
     */
    public function setPrisesGiven($prisesGiven)
    {
        $this->prisesGiven = $prisesGiven;

        return $this;
    }

    /**
     * Get prisesGiven
     *
     * @return integer 
     */
    public function getPrisesGiven()
    {
        return $this->prisesGiven;
    }

    /**
     * Set playersLimit
     *
     * @param integer $playersLimit
     * @return Company
     */
    public function setPlayersLimit($playersLimit)
    {
        $this->playersLimit = $playersLimit;

        return $this;
    }

    /**
     * Get playersLimit
     *
     * @return integer 
     */
    public function getPlayersLimit()
    {
        return $this->playersLimit;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Company
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }
}
