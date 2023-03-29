<?php

namespace App\Entity;

use App\Repository\EducationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EducationRepository::class)]
class Education
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'education', targetEntity: User::class)]
    private Collection $user_id;

    #[ORM\OneToMany(mappedBy: 'education', targetEntity: EducationType::class)]
    private Collection $education_type_id;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $institution_title = null;

    #[ORM\Column(length: 255)]
    private ?string $degree_title = null;

    #[ORM\Column(length: 255)]
    private ?string $field_of_study_title = null;

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

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
        $this->education_type_id = new ArrayCollection();
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
            $userId->setEducation($this);
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        if ($this->user_id->removeElement($userId)) {
            // set the owning side to null (unless already changed)
            if ($userId->getEducation() === $this) {
                $userId->setEducation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EducationType>
     */
    public function getEducationTypeId(): Collection
    {
        return $this->education_type_id;
    }

    public function addEducationTypeId(EducationType $educationTypeId): self
    {
        if (!$this->education_type_id->contains($educationTypeId)) {
            $this->education_type_id->add($educationTypeId);
            $educationTypeId->setEducation($this);
        }

        return $this;
    }

    public function removeEducationTypeId(EducationType $educationTypeId): self
    {
        if ($this->education_type_id->removeElement($educationTypeId)) {
            // set the owning side to null (unless already changed)
            if ($educationTypeId->getEducation() === $this) {
                $educationTypeId->setEducation(null);
            }
        }

        return $this;
    }

    public function getInstitutionTitle(): ?string
    {
        return $this->institution_title;
    }

    public function setInstitutionTitle(?string $institution_title): self
    {
        $this->institution_title = $institution_title;

        return $this;
    }

    public function getDegreeTitle(): ?string
    {
        return $this->degree_title;
    }

    public function setDegreeTitle(string $degree_title): self
    {
        $this->degree_title = $degree_title;

        return $this;
    }

    public function getFieldOfStudyTitle(): ?string
    {
        return $this->field_of_study_title;
    }

    public function setFieldOfStudyTitle(string $field_of_study_title): self
    {
        $this->field_of_study_title = $field_of_study_title;

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
}
