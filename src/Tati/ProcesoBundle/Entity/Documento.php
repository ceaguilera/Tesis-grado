<?php
namespace Tati\ProcesoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Documento
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Documento
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    public $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="documentos", cascade={"persist"})
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
    public $usuario;

    /**
     * @ORM\ManyToMany(targetEntity="ActividadSolicitada")
     * JoinTable(name="actSol_documento",
     *      joinColumns={@JoinColumn(name="documento_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="actSol_id", referencedColumnName="id")}
     *      )
     */
    public $actividades_sol;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // la ruta absoluta del directorio donde se deben
        // guardar los archivos cargados
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // se deshace del __DIR__ para no meter la pata
        // al mostrar el documento/imagen cargada en la vista.
        return 'uploads/documents';
    }

    public function upload($typeFile = 'image', $subDir = '', $nameFile = null)
    {

        if (null === $this->getFile()) {
            return;
        }

        $pathTypeFile = $this->getPathTypeFile($typeFile);
        $this->setSubDir($pathTypeFile.$subDir);

        // Si no existe el directorio se crea el directorio
        if (!file_exists($this->getUploadRootDir())) {
            mkdir($this->getUploadRootDir(),0755, true);
        }

        if (is_null($nameFile))
            $nameFile = substr(time() + rand(), 0, 14);
        else{
            $nameFile = $nameFile.substr(time()+rand(), 0, 14);
        }
        
        $extension = $this->getFile()->guessExtension();
        $path = $this->getUploadRootDir().$nameFile.'.'.$extension;


        $this->setFileName($subDir.$nameFile.'.'.$extension);
        move_uploaded_file($this->getFile(), $path);
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Documento
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Documento
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set usuario
     *
     * @param \Tati\ProcesoBundle\Entity\User $usuario
     * @return Documento
     */
    public function setUsuario(\Tati\ProcesoBundle\Entity\User $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Tati\ProcesoBundle\Entity\User 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actividades_sol = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add actividades_sol
     *
     * @param \Tati\ProcesoBundle\Entity\ActividadSolicitada $actividadesSol
     * @return Documento
     */
    public function addActividadesSol(\Tati\ProcesoBundle\Entity\ActividadSolicitada $actividadesSol)
    {
        $this->actividades_sol[] = $actividadesSol;

        return $this;
    }

    /**
     * Remove actividades_sol
     *
     * @param \Tati\ProcesoBundle\Entity\ActividadSolicitada $actividadesSol
     */
    public function removeActividadesSol(\Tati\ProcesoBundle\Entity\ActividadSolicitada $actividadesSol)
    {
        $this->actividades_sol->removeElement($actividadesSol);
    }

    /**
     * Get actividades_sol
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActividadesSol()
    {
        return $this->actividades_sol;
    }
}
