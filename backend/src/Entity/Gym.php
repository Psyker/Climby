<?php

namespace App\Entity;

use App\Repository\GymRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: GymRepository::class)]
class Gym
{

    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: "doctrine.uuid_generator")]
    private Uuid $id;

    #[ORM\Column(type: 'string', length: 500)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $mp_id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $slug;

    #[ORM\Column(type: 'string', length: 500)]
    private string $address;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $phone_number;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $site_url;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private ?string $image_url;

    #[ORM\OneToMany(mappedBy: 'gym', targetEntity: Session::class)]
    private Collection $sessions;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    public function getId(): Uuid
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

    public function getMpId(): ?string
    {
        return $this->mp_id;
    }

    public function setMpId(string $mp_id): self
    {
        $this->mp_id = $mp_id;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(?string $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getSiteUrl(): ?string
    {
        return $this->site_url;
    }

    public function setSiteUrl(?string $site_url): self
    {
        $this->site_url = $site_url;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(?string $image_url): self
    {
        $this->image_url = $image_url;

        return $this;
    }

    public static function fromMPData(#[ArrayShape([
            'mp_id' => "string",
            'slug' => "string",
            'name' => "string",
            'address' => "string",
            'phone_number' => "string",
            'site_url' => "string"
        ]
    )] array $gymData): self
    {
        return (new self)
            ->setName($gymData['name'])
            ->setAddress($gymData['address'])
            ->setMpId($gymData['mp_id'])
            ->setSlug($gymData['slug'])
            ->setPhoneNumber($gymData['phone_number'])
            ->setSiteUrl($gymData['site_url']);
    }

    /**
     * @return Collection<int, Session>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
            $session->setGym($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getGym() === $this) {
                $session->setGym(null);
            }
        }

        return $this;
    }
}
