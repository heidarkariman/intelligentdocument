<?php

namespace App\Entity;

use App\Repository\FormRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormRepository::class)]
class Form
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'form', targetEntity: User::class)]
    private Collection $user_id;

    #[ORM\OneToMany(mappedBy: 'form', targetEntity: FormType::class)]
    private Collection $form_type_id;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file_path = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
        $this->form_type_id = new ArrayCollection();
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
            $userId->setForm($this);
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        if ($this->user_id->removeElement($userId)) {
            // set the owning side to null (unless already changed)
            if ($userId->getForm() === $this) {
                $userId->setForm(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FormType>
     */
    public function getFormTypeId(): Collection
    {
        return $this->form_type_id;
    }

    public function addFormTypeId(FormType $formTypeId): self
    {
        if (!$this->form_type_id->contains($formTypeId)) {
            $this->form_type_id->add($formTypeId);
            $formTypeId->setForm($this);
        }

        return $this;
    }

    public function removeFormTypeId(FormType $formTypeId): self
    {
        if ($this->form_type_id->removeElement($formTypeId)) {
            // set the owning side to null (unless already changed)
            if ($formTypeId->getForm() === $this) {
                $formTypeId->setForm(null);
            }
        }

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
