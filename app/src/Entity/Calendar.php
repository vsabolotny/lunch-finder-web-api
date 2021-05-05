<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CalendarRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\IpTraceable\Traits\IpTraceableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass=CalendarRepository::class)
 */
class Calendar
{
    use TimestampableEntity;
    use BlameableEntity;
    use IpTraceableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Foodtruck::class, inversedBy="calendar", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $foodtruck;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, inversedBy="monday")
     */
    private $monday;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, inversedBy="tuesday")
     */
    private $tuesday;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, inversedBy="wednesday")
     */
    private $wednesday;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, inversedBy="thursday")
     */
    private $thursday;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, inversedBy="friday")
     */
    private $friday;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, inversedBy="saturday")
     */
    private $saturday;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, inversedBy="sunday")
     */
    private $sunday;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFoodtruck(): ?Foodtruck
    {
        return $this->foodtruck;
    }

    public function setFoodtruck(Foodtruck $foodtruck): self
    {
        $this->foodtruck = $foodtruck;

        return $this;
    }

    public function getMonday(): ?Location
    {
        return $this->monday;
    }

    public function setMonday(?Location $monday): self
    {
        $this->monday = $monday;

        return $this;
    }

    public function getTuesday(): ?Location
    {
        return $this->tuesday;
    }

    public function setTuesday(?Location $tuesday): self
    {
        $this->tuesday = $tuesday;

        return $this;
    }

    public function getWednesday(): ?Location
    {
        return $this->wednesday;
    }

    public function setWednesday(?Location $wednesday): self
    {
        $this->wednesday = $wednesday;

        return $this;
    }

    public function getThursday(): ?Location
    {
        return $this->thursday;
    }

    public function setThursday(?Location $thursday): self
    {
        $this->thursday = $thursday;

        return $this;
    }

    public function getFriday(): ?Location
    {
        return $this->friday;
    }

    public function setFriday(?Location $friday): self
    {
        $this->friday = $friday;

        return $this;
    }

    public function getSaturday(): ?Location
    {
        return $this->saturday;
    }

    public function setSaturday(?Location $saturday): self
    {
        $this->saturday = $saturday;

        return $this;
    }

    public function getSunday(): ?Location
    {
        return $this->sunday;
    }

    public function setSunday(?Location $sunday): self
    {
        $this->sunday = $sunday;

        return $this;
    }

    public function getLocation()
    {
        $functionName = sprintf('get%s', date('l'));
        return $this->$functionName();
    }

    #[Pure] public function __toString(): string
    {
        return sprintf('Calendar #%d', $this->getId());
    }
}
