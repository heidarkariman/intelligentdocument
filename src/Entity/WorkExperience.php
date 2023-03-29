<?php

namespace App\Entity;

use App\Repository\WorkExperienceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkExperienceRepository::class)]
class WorkExperience
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'workExperience', targetEntity: User::class)]
    private Collection $user_id;

    #[ORM\OneToMany(mappedBy: 'workExperience', targetEntity: WorkType::class)]
    private Collection $work_type_id;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $company_title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $job_title = null;

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

    #[ORM\ManyToOne(inversedBy: 'work_expetience_id')]
    private ?WorkDetail $workDetail = null;

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
        $this->work_type_id = new ArrayCollection();
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
            $userId->setWorkExperience($this);
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        if ($this->user_id->removeElement($userId)) {
            // set the owning side to null (unless already changed)
            if ($userId->getWorkExperience() === $this) {
                $userId->setWorkExperience(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WorkType>
     */
    public function getWorkTypeId(): Collection
    {
        return $this->work_type_id;
    }

    public function addWorkTypeId(WorkType $workTypeId): self
    {
        if (!$this->work_type_id->contains($workTypeId)) {
            $this->work_type_id->add($workTypeId);
            $workTypeId->setWorkExperience($this);
        }

        return $this;
    }

    public function removeWorkTypeId(WorkType $workTypeId): self
    {
        if ($this->work_type_id->removeElement($workTypeId)) {
            // set the owning side to null (unless already changed)
            if ($workTypeId->getWorkExperience() === $this) {
                $workTypeId->setWorkExperience(null);
            }
        }

        return $this;
    }

    public function getCompanyTitle(): ?string
    {
        return $this->company_title;
    }

    public function setCompanyTitle(?string $company_title): self
    {
        $this->company_title = $company_title;

        return $this;
    }

    public function getJobTitle(): ?string
    {
        return $this->job_title;
    }

    public function setJobTitle(?string $job_title): self
    {
        $this->job_title = $job_title;

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

    public function getWorkDetail(): ?WorkDetail
    {
        return $this->workDetail;
    }

    public function setWorkDetail(?WorkDetail $workDetail): self
    {
        $this->workDetail = $workDetail;

        return $this;
    }
}
