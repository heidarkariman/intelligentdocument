<?php

namespace App\Entity;

use App\Repository\WorkDetailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkDetailRepository::class)]
class WorkDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'workDetail', targetEntity: WorkExperience::class)]
    private Collection $work_expetience_id;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    public function __construct()
    {
        $this->work_expetience_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, WorkExperience>
     */
    public function getWorkExpetienceId(): Collection
    {
        return $this->work_expetience_id;
    }

    public function addWorkExpetienceId(WorkExperience $workExpetienceId): self
    {
        if (!$this->work_expetience_id->contains($workExpetienceId)) {
            $this->work_expetience_id->add($workExpetienceId);
            $workExpetienceId->setWorkDetail($this);
        }

        return $this;
    }

    public function removeWorkExpetienceId(WorkExperience $workExpetienceId): self
    {
        if ($this->work_expetience_id->removeElement($workExpetienceId)) {
            // set the owning side to null (unless already changed)
            if ($workExpetienceId->getWorkDetail() === $this) {
                $workExpetienceId->setWorkDetail(null);
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
