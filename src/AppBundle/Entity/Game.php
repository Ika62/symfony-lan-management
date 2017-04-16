<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity
 */
class Game
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Team
     *
     * @ORM\JoinColumn(name="team1", referencedColumnName="id")
     * @ORM\OneToOne(targetEntity="Team", mappedBy="games")
     */
    private $team1;

    /**
     * @var Team
     *
     * @ORM\JoinColumn(name="team2", referencedColumnName="id")
     * @ORM\OneToOne(targetEntity="Team", mappedBy="games")
     */
    private $team2;

    /**
     * @var Server
     *
     * @ORM\JoinColumn(name="server", referencedColumnName="id")
     * @ORM\OneToOne(targetEntity="Server", mappedBy="games")
     */
    private $server;



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
     * Set team1
     *
     * @param Team $team1
     *
     * @return Game
     */
    public function setTeam1($team1)
    {
        $this->team1 = $team1;

        return $this;
    }

    /**
     * Get team1
     *
     * @return Team
     */
    public function getTeam1()
    {
        return $this->team1;
    }

    /**
     * Set team2
     *
     * @param Team $team2
     *
     * @return Game
     */
    public function setTeam2($team2)
    {
        $this->team2 = $team2;

        return $this;
    }

    /**
     * Get team2
     *
     * @return Team
     */
    public function getTeam2()
    {
        return $this->team2;
    }

    /**
     * Set server
     *
     * @param Server $server
     *
     * @return Game
     */
    public function setServer($server)
    {
        $this->server = $server;

        return $this;
    }

    /**
     * Get server
     *
     * @return Server
     */
    public function getServer()
    {
        return $this->server;
    }

}
