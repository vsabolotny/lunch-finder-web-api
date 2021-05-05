<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\IpTraceable\Traits\IpTraceableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Foodtruck::class, mappedBy="tags", cascade={"persist"})
     */
    private $foodtrucks;

    public function __construct()
    {
        $this->foodtrucks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Foodtruck[]
     */
    public function getFoodtrucks(): Collection
    {
        return $this->foodtrucks;
    }

    public function addFoodtruck(Foodtruck $foodtruck): self
    {
        if (!$this->foodtrucks->contains($foodtruck)) {
            $this->foodtrucks[] = $foodtruck;
            $foodtruck->addTag($this);
        }

        return $this;
    }

    public function removeFoodtruck(Foodtruck $foodtruck): self
    {
        if ($this->foodtrucks->removeElement($foodtruck)) {
            $foodtruck->removeTag($this);
        }

        return $this;
    }

    #[Pure] public function __toString(): string
    {
        return $this->getName();
    }
}
