<?php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;


#[ORM\Entity]
#[ORM\Table(name: 'calendrier')]
class Calendrier
{
   
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;
    #[ORM\Column(type: 'datetime', nullable: true)]
    private DateTime $dateTime;
    #[ManyToOne(targetEntity: Equipe::class)]
    #[JoinColumn(name:'equipe1_id', referencedColumnName: 'id')]
    private Equipe|null $equipe1 = null; 
    #[ManyToOne(targetEntity: Equipe::class)]
    #[JoinColumn(name:'equipe2_id', referencedColumnName: 'id')]
    private Equipe|null $equipe2 = null; 
    #[ORM\Column(type: 'integer')]
    private int $prix;
    #[ManyToOne(targetEntity: Ville::class)]
    #[JoinColumn(name:'ville_id', referencedColumnName: 'id')]
    private Ville|null $ville = null;
    #[ORM\Column(type: 'integer')]
    private int $score1;
    #[ORM\Column(type: 'integer')]
    private int $score2;



    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateTime.
     *
     * @param \DateTime|null $dateTime
     *
     * @return Calendrier
     */
    public function setDateTime(\DateTime $dateTime = null)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * Get dateTime.
     *
     * @return \DateTime|null
     */
    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }

    /**
     * Set prix.
     *
     * @param int $prix
     *
     * @return Calendrier
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix.
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set equipe1.
     *
     * @param \Equipe|null $equipe1
     *
     * @return Calendrier
     */
    public function setEquipe1(\Equipe $equipe1 = null)
    {
        $this->equipe1 = $equipe1;

        return $this;
    }

    /**
     * Get equipe1.
     *
     * @return \Equipe|null
     */
    public function getEquipe1()
    {
        return $this->equipe1;
    }

    /**
     * Set equipe2.
     *
     * @param \Equipe|null $equipe2
     *
     * @return Calendrier
     */
    public function setEquipe2(\Equipe $equipe2 = null)
    {
        $this->equipe2 = $equipe2;

        return $this;
    }

    /**
     * Get equipe2.
     *
     * @return \Equipe|null
     */
    public function getEquipe2()
    {
        return $this->equipe2;
    }

    /**
     * Set ville.
     *
     * @param \Ville|null $ville
     *
     * @return Calendrier
     */
    public function setVille(\Ville $ville = null)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville.
     *
     * @return \Ville|null
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set score1.
     *
     * @param int $score1
     *
     * @return Calendrier
     */
    public function setScore1($score1)
    {
        $this->score1 = $score1;

        return $this;
    }

    /**
     * Get score1.
     *
     * @return int
     */
    public function getScore1()
    {
        return $this->score1;
    }

    /**
     * Set score2.
     *
     * @param int $score2
     *
     * @return Calendrier
     */
    public function setScore2($score2)
    {
        $this->score2 = $score2;

        return $this;
    }

    /**
     * Get score2.
     *
     * @return int
     */
    public function getScore2()
    {
        return $this->score2;
    }
}
