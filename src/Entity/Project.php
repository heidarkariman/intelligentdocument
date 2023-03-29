<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: User::class)]
    private Collection $user_id;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: ProjectType::class)]
    private Collection $project_type_id;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $end_date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file_path = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'project_id')]
    private ?ProjectDetail $projectDetail = null;

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
        $this->project_type_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(User $userId): self
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id->add($userId);
            $userId->setProject($this);
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        if ($this->user_id->removeElement($userId)) {
            // set the owning side to null (unless already changed)
            if ($userId->getProject() === $this) {
                $userId->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProjectType>
     */
    public function getProjectTypeId(): Collection
    {
        return $this->project_type_id;
    }

    public function addProjectTypeId(ProjectType $projectTypeId): self
    {
        if (!$this->project_type_id->contains($projectTypeId)) {
            $this->project_type_id->add($projectTypeId);
            $projectTypeId->setProject($this);
        }

        return $this;
    }

    public function removeProjectTypeId(ProjectType $projectTypeId): self
    {
        if ($this->project_type_id->removeElement($projectTypeId)) {
            // set the owning side to null (unless already changed)
            if ($projectTypeId->getProject() === $this) {
                $projectTypeId->setProject(null);
            }
        }

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(?\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->file_name;
    }

    public function setFileName(?string $file_name): self
    {
        $this->file_name = $file_name;

        return $this;
    }

    public function getFilePath(): ?string
    {
        return $this->file_path;
    }

    public function setFilePath(?string $file_path): self
    {
        $this->file_path = $file_path;

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

    public function getProjectDetail(): ?ProjectDetail
    {
        return $this->projectDetail;
    }

    public function setProjectDetail(?ProjectDetail $projectDetail): self
    {
        $this->projectDetail = $projectDetail;

        return $this;
    }
}
