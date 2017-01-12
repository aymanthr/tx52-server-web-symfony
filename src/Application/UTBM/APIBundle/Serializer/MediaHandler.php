<?php

namespace Application\UTBM\APIBundle\Serializer;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\EntityManager;
use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\JsonSerializationVisitor;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\Pool;
use Symfony\Component\Routing\RouterInterface;

class MediaHandler implements SubscribingHandlerInterface
{
    /** @var \Doctrine\ORM\EntityManager */
    protected $em;

    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    protected $router;

    /**
     * @var \Sonata\MediaBundle\Provider\Pool
     */
    protected $mediaService;

    /**
     * @var array
     */
    protected $serializeProviders;

    /**
     * @param EntityManager $em
     * @param RouterInterface $router
     * @param Pool $mediaService
     * @param array $serializeProviders
     */
    public function __construct(EntityManager $em, RouterInterface $router, Pool $mediaService, $serializeProviders = array())
    {
        $this->em = $em;
        $this->router = $router;
        $this->mediaService = $mediaService;
        $this->serializeProviders = $serializeProviders;
    }

    /**
     * @return array
     */
    public static function getSubscribingMethods()
    {
        return array(
            array(
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format' => 'json',
                'type' => 'Application\Sonata\MediaBundle\Entity\Media',
                'method' => 'serializeImageToJson',
            ),
        );
    }

    /**
     * @return \Sonata\MediaBundle\Provider\Pool
     */
    private function getMediaService()
    {
        return $this->mediaService;
    }

    /**
     * @param \Sonata\MediaBundle\Model\MediaInterface $media
     * @param string                                   $format
     *
     * @return string
     */
    private function path(MediaInterface $media, $format)
    {
        $provider = $this->getMediaService()
            ->getProvider($media->getProviderName());

        $format = $provider->getFormatName($media, $format);

        return $provider->generatePublicUrl($media, $format);
    }

    /**
     * Return if the provider is allowed to be serialized
     *
     * @param type $name
     * @return type
     */
    public function serializeProvider($name)
    {
        return in_array($name, $this->serializeProviders);
    }

    /**
     * Get formats for media
     *
     * @param MediaInterface $media
     * @return array
     */
    public function getFormats(MediaInterface $media)
    {
        return $this->getMediaService()->getFormatNamesByContext($media->getContext());
    }

    /**
     * Get a url safe identifier
     *
     * @param $src
     * @return string
     */
    public function getUrlsafeId($src)
    {
        $src = substr($src, 1);

        return preg_replace('/[\/\.]/', '-', $src);
    }

    /**
     * Handles the serialization of an Image object
     *
     * @param \JMS\Serializer\JsonSerializationVisitor $visitor
     * @param \Sonata\MediaBundle\Model\MediaInterface  $media
     * @param array $type
     * @param Context $context
     * @return array
     */
    public function serializeImageToJson(JsonSerializationVisitor $visitor, MediaInterface $media, array $type, Context $context)
    {
        if (!$this->serializeProvider($media->getProviderName())) {
            return;
        }

        $formats = $context->attributes->get('image_formats')->getOrElse(array());
        $urls = array();
        $requestContext = $this->router->getContext();
        $host = $requestContext->getScheme().'://'.$requestContext->getHost();

        foreach ($formats as $format) {
            $urls[$format] = $host.$this->path($media, $format);
        }

        return array(
            'id'     => $media->getId(),
            'width'  => $media->getWidth(),
            'height' => $media->getHeight(),
            'urls'   => $urls
        );
    }
}