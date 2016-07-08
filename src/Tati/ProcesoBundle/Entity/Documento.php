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
     * @ORM\ManyToOne(targetEntity="ActividadSolicitada", inversedBy="documentos", cascade={"persist"})
     * @ORM\JoinColumn(name="actividaSol_id", referencedColumnName="id", nullable=true)
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
    public function setFile($file = null)
    {
        //var_dump($file);
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
        return 'uploads/';
    }

    public function upload($nameFile = null, $carpetaRaiz, $subCarpeta)
    {

        if (null === $this->getFile()) {
            return;
        }

        // $pathTypeFile = $this->getPathTypeFile($typeFile);
        // $this->setSubDir($pathTypeFile.$subDir);

        //Si no existe el directorio se crea el directorio
        if (!file_exists($this->getUploadDir().$carpetaRaiz.'/'.$subCarpeta)) {
            mkdir($this->getUploadDir().$carpetaRaiz.'/'.$subCarpeta,0755, true);
        }


        if (is_null($nameFile))
            $nameFile = substr(time() + rand(), 0, 14);
        else{
            $nameFile = $nameFile.substr(time()+rand(), 0, 14);
        }
        //print($this->getFile());
        //$extension = $this->getFile()->guessExtension();
        $extension = "pdf";
        $path = $this->getUploadDir().$carpetaRaiz.'/'.$subCarpeta.'/'.$nameFile.'.'.$extension;
        $this->setPath($this->getUploadDir().$carpetaRaiz.'/'.$subCarpeta.'/'.$nameFile.'.'.$extension);
        $this->setName($nameFile);
        //var_dump($path);

        $respuesta = move_uploaded_file($this->getFile(), $path);
        //var_dump($respuesta);
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actividades_sol = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set usuarioSolicitante
     *
     * @param \Tati\ProcesoBundle\Entity\PerfilSolicitante $usuarioSolicitante
     * @return Documento
     */
    public function setUsuarioSolicitante(\Tati\ProcesoBundle\Entity\PerfilSolicitante $usuarioSolicitante = null)
    {
        $this->usuarioSolicitante = $usuarioSolicitante;

        return $this;
    }

    /**
     * Get usuarioSolicitante
     *
     * @return \Tati\ProcesoBundle\Entity\PerfilSolicitante 
     */
    public function getUsuarioSolicitante()
    {
        return $this->usuarioSolicitante;
    }


    /**
     * Set actividades_sol
     *
     * @param \Tati\ProcesoBundle\Entity\ActividadSolicitada $actividadesSol
     * @return Documento
     */
    public function setActividadesSol(\Tati\ProcesoBundle\Entity\ActividadSolicitada $actividadesSol = null)
    {
        $this->actividades_sol = $actividadesSol;

        return $this;
    }

    /**
     * Get actividades_sol
     *
     * @return \Tati\ProcesoBundle\Entity\ActividadSolicitada 
     */
    public function getActividadesSol()
    {
        return $this->actividades_sol;
    }
}
