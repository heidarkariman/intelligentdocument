<?php

namespace App\Entity;

use App\Repository\WorkTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkTypeRepository::class)]
class WorkType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'work_type_id')]
    private ?WorkExperience $workExperience = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getWorkExperience(): ?WorkExperience
    {
        return $this->workExperience;
    }

    public function setWorkExperience(?WorkExperience $workExperience): self
    {
        $this->workExperience = $workExperience;

        return $this;
    }
}
