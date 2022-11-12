<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
    public const LOCATION_TYPES = ['indoor', 'outdoor'];
    public const CLIMBING_TYPES = ['traditional', 'bouldering', 'speed-climbing'];

    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: "doctrine.uuid_generator")]
    private Uuid $id;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'string', length: 4)]
    private string $grade;

    #[Assert\GreaterThan(0)]
    #[ORM\Column(type: 'integer')]
    private int $seats;

    #[ORM\ManyToOne(targetEntity: Gym::class, inversedBy: 'sessions')]
    private Gym $gym;

    #[Assert\Choice(choices: Session::LOCATION_TYPES, message: 'Choose a valid location type.')]
    #[ORM\Column(type: 'string', length: 255)]
    private string $type;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'sessions')]
    private Collection $members;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $start_at;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $end_at;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $updated_at;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $created_at;

    #[Assert\Choice(choices: Session::CLIMBING_TYPES, message: 'Choose a valid discipline.')]
    #[ORM\Column(type: 'string', length: 255)]
    private string $discipline;

    #[ORM\Column(type: 'boolean', nullable: false, options: ['default' => true])]
    private bool $public;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private User $author;

    public function __construct()
    {
        $this->members = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): UUid
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

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

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getSeats(): ?int
    {
        return $this->seats;
    }

    public function setSeats(int $seats): self
    {
        $this->seats = $seats;

        return $this;
    }

    public function getGym(): ?Gym
    {
        return $this->gym;
    }

    public function setGym(?Gym $gym): self
    {
        $this->gym = $gym;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(User $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members[] = $member;
        }

        return $this;
    }

    public function removeMember(User $member): self
    {
        $this->members->removeElement($member);

        return $this;
    }

    public function getStartAt(): ?\DateTimeImmutable
    {
        return $this->start_at;
    }

    public function setStartAt(\DateTimeImmutable $start_at): self
    {
        $this->start_at = $start_at;

        return $this;
    }

    public function getEndAt(): ?\DateTimeImmutable
    {
        return $this->end_at;
    }

    public function setEndAt(?\DateTimeImmutable $end_at): self
    {
        $this->end_at = $end_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getDiscipline(): ?string
    {
        return $this->discipline;
    }

    public function setDiscipline(string $discipline): self
    {
        $this->discipline = $discipline;

        return $this;
    }

    public function isPublic(): bool
    {
        return $this->public;
    }

    public function setPublic(bool $public): Session
    {
        $this->public = $public;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }
}
