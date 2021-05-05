<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FoodtruckRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\IpTraceable\Traits\IpTraceableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=FoodtruckRepository::class)
 * @Vich\Uploadable
 */
class Foodtruck
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
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="foodtrucks", cascade={"persist"})
     */
    private $tags;

    /**
     * @Vich\UploadableField(mapping="logos", fileNameProperty="logo.name", size="logo.size", mimeType="logo.mimeType", originalName="logo.originalName", dimensions="logo.dimensions")
     *
     * @var File|null
     */
    private $logoFile;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $logo;

    /**
     * @ORM\OneToOne(targetEntity=Calendar::class, mappedBy="foodtruck", cascade={"persist", "remove"})
     */
    private $calendar;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Event::class, mappedBy="foodtruck", orphanRemoval=true, cascade={"persist"})
     */
    private $events;

    public function __construct()
    {
        $this->logo = new EmbeddedFile();
        $this->tags = new ArrayCollection();
        $this->events = new ArrayCollection();
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
     * @param File|UploadedFile|null $logoFile
     *
     * @return Foodtruck
     */
    public function setLogoFile(?File $logoFile = null): self
    {
        $this->logoFile = $logoFile;
        if ($this->logoFile) {
            $this->updatedAt = new DateTime();
        }

        return $this;
    }

    public function getLogoFile(): ?File
    {
        return $this->logoFile;
    }

    public function setLogo(EmbeddedFile $logo): self
    {
        $this->logo = $logo;
        return $this;
    }

    public function getLogo(): ?EmbeddedFile
    {
        return $this->logo;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    #[Pure] public function __toString(): string
    {
        return $this->getName();
    }

    public function getCalendar(): ?Calendar
    {
        return $this->calendar;
    }

    public function setCalendar(Calendar $calendar): self
    {
        // set the owning side of the relation if necessary
        if ($calendar->getFoodtruck() !== $this) {
            $calendar->setFoodtruck($this);
        }

        $this->calendar = $calendar;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
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
            $event->setFoodtruck($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getFoodtruck() === $this) {
                $event->setFoodtruck(null);
            }
        }

        return $this;
    }
}
