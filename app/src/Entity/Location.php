<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\IpTraceable\Traits\IpTraceableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Location
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
     * @ORM\OneToMany(targetEntity=Event::class, mappedBy="location", orphanRemoval=true)
     */
    private $events;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\OneToMany(targetEntity=Calendar::class, mappedBy="monday")
     */
    private $monday;

    /**
     * @ORM\OneToMany(targetEntity=Calendar::class, mappedBy="tuesday")
     */
    private $tuesday;

    /**
     * @ORM\OneToMany(targetEntity=Calendar::class, mappedBy="wednesday")
     */
    private $wednesday;

    /**
     * @ORM\OneToMany(targetEntity=Calendar::class, mappedBy="thursday")
     */
    private $thursday;

    /**
     * @ORM\OneToMany(targetEntity=Calendar::class, mappedBy="friday")
     */
    private $friday;

    /**
     * @ORM\OneToMany(targetEntity=Calendar::class, mappedBy="saturday")
     */
    private $saturday;

    /**
     * @ORM\OneToMany(targetEntity=Calendar::class, mappedBy="sunday")
     */
    private $sunday;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullAddress;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->monday = new ArrayCollection();
        $this->tuesday = new ArrayCollection();
        $this->wednesday = new ArrayCollection();
        $this->thursday = new ArrayCollection();
        $this->friday = new ArrayCollection();
        $this->saturday = new ArrayCollection();
        $this->sunday = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setLocation($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getLocation() === $this) {
                $event->setLocation(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getFullAddress();
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection|Calendar[]
     */
    public function getMonday(): Collection
    {
        return $this->monday;
    }

    public function addMonday(Calendar $monday): self
    {
        if (!$this->monday->contains($monday)) {
            $this->monday[] = $monday;
            $monday->setMonday($this);
        }

        return $this;
    }

    public function removeMonday(Calendar $monday): self
    {
        if ($this->monday->removeElement($monday)) {
            // set the owning side to null (unless already changed)
            if ($monday->getMonday() === $this) {
                $monday->setMonday(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Calendar[]
     */
    public function getTuesday(): Collection
    {
        return $this->tuesday;
    }

    public function addTuesday(Calendar $tuesday): self
    {
        if (!$this->tuesday->contains($tuesday)) {
            $this->tuesday[] = $tuesday;
            $tuesday->setTuesday($this);
        }

        return $this;
    }

    public function removeTuesday(Calendar $tuesday): self
    {
        if ($this->tuesday->removeElement($tuesday)) {
            // set the owning side to null (unless already changed)
            if ($tuesday->getTuesday() === $this) {
                $tuesday->setTuesday(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Calendar[]
     */
    public function getWednesday(): Collection
    {
        return $this->wednesday;
    }

    public function addWednesday(Calendar $wednesday): self
    {
        if (!$this->wednesday->contains($wednesday)) {
            $this->wednesday[] = $wednesday;
            $wednesday->setWednesday($this);
        }

        return $this;
    }

    public function removeWednesday(Calendar $wednesday): self
    {
        if ($this->wednesday->removeElement($wednesday)) {
            // set the owning side to null (unless already changed)
            if ($wednesday->getWednesday() === $this) {
                $wednesday->setWednesday(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Calendar[]
     */
    public function getThursday(): Collection
    {
        return $this->thursday;
    }

    public function addThursday(Calendar $thursday): self
    {
        if (!$this->thursday->contains($thursday)) {
            $this->thursday[] = $thursday;
            $thursday->setThursday($this);
        }

        return $this;
    }

    public function removeThursday(Calendar $thursday): self
    {
        if ($this->thursday->removeElement($thursday)) {
            // set the owning side to null (unless already changed)
            if ($thursday->getThursday() === $this) {
                $thursday->setThursday(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Calendar[]
     */
    public function getFriday(): Collection
    {
        return $this->friday;
    }

    public function addFriday(Calendar $friday): self
    {
        if (!$this->friday->contains($friday)) {
            $this->friday[] = $friday;
            $friday->setFriday($this);
        }

        return $this;
    }

    public function removeFriday(Calendar $friday): self
    {
        if ($this->friday->removeElement($friday)) {
            // set the owning side to null (unless already changed)
            if ($friday->getFriday() === $this) {
                $friday->setFriday(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Calendar[]
     */
    public function getSaturday(): Collection
    {
        return $this->saturday;
    }

    public function addSaturday(Calendar $saturday): self
    {
        if (!$this->saturday->contains($saturday)) {
            $this->saturday[] = $saturday;
            $saturday->setSaturday($this);
        }

        return $this;
    }

    public function removeSaturday(Calendar $saturday): self
    {
        if ($this->saturday->removeElement($saturday)) {
            // set the owning side to null (unless already changed)
            if ($saturday->getSaturday() === $this) {
                $saturday->setSaturday(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Calendar[]
     */
    public function getSunday(): Collection
    {
        return $this->sunday;
    }

    public function addSunday(Calendar $sunday): self
    {
        if (!$this->sunday->contains($sunday)) {
            $this->sunday[] = $sunday;
            $sunday->setSunday($this);
        }

        return $this;
    }

    public function removeSunday(Calendar $sunday): self
    {
        if ($this->sunday->removeElement($sunday)) {
            // set the owning side to null (unless already changed)
            if ($sunday->getSunday() === $this) {
                $sunday->setSunday(null);
            }
        }

        return $this;
    }

    public function getFullAddress(): ?string
    {
        return $this->fullAddress;
    }

    public function setFullAddress(string $fullAddress): self
    {
        $this->fullAddress = $fullAddress;

        return $this;
    }
}
