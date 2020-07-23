<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ORM\Table(name="Product")
 * @UniqueEntity(
 *     fields={"barcode"},
 *     message="there is already such a product."
 * )
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

   /**
     * @ORM\Column(name="barcode", type="bigint", unique=true)
     */
    private $barcode;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stock", mappedBy="product", orphanRemoval=true)
     */
    private $stock;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductOwners", mappedBy="product", orphanRemoval=true)
     */

    private $productOwners;

    public function __construct()
    {
        $this->productOwners = new ArrayCollection();
        $this->stock = new ArrayCollection();

    }

    /**
     * @return Collection|Product[]
     */
    public function getProductOwners(): Collection
    {
        return $this->productOwners;
    }
 
    /**
     * @return Collection|Product[]
     */
    public function getStock(): Collection
    {
        return $this->stock;
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

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(string $barcode): self
    {
        $this->barcode = $barcode;

        return $this;
    }

    public static function findByBarcode($em, $barcode )
    {
        return $em->findOneBy(['barcode' => $barcode]);
        
    }
}
