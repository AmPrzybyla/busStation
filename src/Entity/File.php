<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FileRepository")
 */
class File
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\File(maxSize="1M", mimeTypes = {
     *          "image/png",
     *          "image/jpeg",
     *          "image/jpg",
     *          "application/pdf",
     *          "application/x-pdf",
     *          "application/doc",
     *          "application/xls",
     *          "application/ods",
     *          "application/odt",},
     *     maxSizeMessage="Max file size is 1Mb",
     *     mimeTypesMessage="suported file types: png, jpeg/jpg, pdf, doc, xls, ods, odt")
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Station", inversedBy="files")
     * @ORM\JoinColumn(nullable=false)
     */
    private $station;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Station
     */
    public function getStation()
    {
        return $this->station;
    }

    /**
     * @param Station $station
     */
    public function setStation($station): void
    {
        $this->station = $station;
    }


}
